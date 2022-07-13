<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes'; //tablename
    protected $primaryKey = 'id'; //primary key
    protected $fillable = [
        'class_name',
        'organisation_id'

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('class_name', 'like', '%'.$search.'%');
            });
        });
    }
}
