<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded=[];

     
    public function profile()
    {
        return $this->belongsTo(User::class);
    }
}


 
