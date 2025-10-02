<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     public function Tasks()
    {
        return $this->belongsToMany(Task::class, "category_task");
    }
}


