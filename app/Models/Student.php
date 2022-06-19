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
        'created_at',
        'updated_at'

     ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
