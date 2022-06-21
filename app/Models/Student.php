<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

     protected $fillable = [
        'unique_id',
        'organisation_id',
        'user_id',
        'gender',
        'dob',
        'roll',
        'blood_group',
        'religion',
        'class',
        'section',
        'admission',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'father_name',
        'mother_name',
        'photo',
        'pincode',
        'created_at',
        'updated_at'

     ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('unique_id', 'like', '%'.$search.'%')
                    ->orWhere('roll', 'like', '%'.$search.'%')
                    ->orWhere('father_name', 'like', '%'.$search.'%')
                    ->orWhere('mother_name', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('address', 'like', '%'.$search.'%')
                    ->orWhere('city', 'like', '%'.$search.'%')
                    ->orWhere('state', 'like', '%'.$search.'%')
                    ->orWhere('country', 'like', '%'.$search.'%')
                    ->orWhere('pincode', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('first_name', 'like', '%'.$search.'%')
                            ->orWhere('last_name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                    });
            });
        });
    }
}
