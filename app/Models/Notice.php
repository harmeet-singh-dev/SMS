<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
     protected $fillable = [
        'id',
        'organisation_id',
        'title',
        'description',
        'posted_by',
        'time',
        'teacher',
        'student',
    
    
    ];
}
