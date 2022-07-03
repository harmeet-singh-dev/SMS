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
        'end_break'];

}
