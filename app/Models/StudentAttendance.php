<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table = 'student_attendance';
    protected $guarded = [];

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

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
