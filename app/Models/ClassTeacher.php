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
        'section_id'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('teacher_id', 'like', '%'.$search.'%');
            });
        });
    }

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function class() {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
