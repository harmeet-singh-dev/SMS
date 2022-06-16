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
         'name',
         'organisation_id'
         
    ];
}
