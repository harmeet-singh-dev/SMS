<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisation_id',
        'teacher_id',
        'class_id',
        'department_id',
        'section_id'];

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function class(){
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('teacher', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%'.$search.'%')
                        ->orWhere('last_name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                })->orWhereHas('class', function ($query) use ($search) {
                    $query->where('class_name', 'like', '%'.$search.'%');
                })->orWhereHas('section', function ($query) use ($search) {
                    $query->where('section_name', 'like', '%'.$search.'%');
                })->orWhereHas('department', function ($query) use ($search) {
                    $query->where('department_name', 'like', '%'.$search.'%');
                });

            });
        });
    }

}
