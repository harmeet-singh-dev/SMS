<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisation_id',
        'user_id',
        'gender',
        'dob',
        'spouse_name',
        'blood_group',
        'religion',
        'description',
        'phone',
        'address',
        'city',
        'pincode',
        'department_id',
        'state',
        'country',
        'father_name',
        'mother_name',
        'photo',
        'created_at',
        'updated_at'
        
     ];
}
