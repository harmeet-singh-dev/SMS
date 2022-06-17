<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //table permission
    protected $table = 'permission';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
