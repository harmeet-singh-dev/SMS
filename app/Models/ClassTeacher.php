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
}
