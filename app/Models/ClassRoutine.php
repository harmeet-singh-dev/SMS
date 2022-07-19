<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisation_id',
        'class_name',
        'section_name',
        'subject_name',
        'teacher_name',
        'start_time',
        'end_time',
        'date',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'start_break',
        'end_break'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('teacher_name', 'like', '%'.$search.'%');
            });
        });
    }

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_name');
    }

    public function class() {
        return $this->belongsTo(Classes::class, 'class_name');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'section_name');
    }
}
