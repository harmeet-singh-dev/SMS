<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;

    protected $guarded = [];

    const FEE_INTERVAL = [
        'monthly' => 'Monthly',
        '2_months' => '2 months',
        'quarterly' => 'Quarterly',
        'half_yearly' => 'Half Yearly',
        'yearly' => 'Yearly',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'.$search.'%')
                    ->orWhere('father_name', 'like', '%'.$search.'%')
                    ->orWhereHas('class', function ($query) use ($search) {
                        $query->where('class_name', 'like', '%'.$search.'%');
                    })->orWhereHas('section', function ($query) use ($search) {
                        $query->where('section_name', 'like', '%'.$search.'%');
                    })->orWhereHas('student', function ($query) use ($search) {
                        $query->where('first_name', 'like', '%'.$search.'%');
                    });

            });
        });
    }


}
