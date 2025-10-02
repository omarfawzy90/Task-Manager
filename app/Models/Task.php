<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $guarded = [];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_task");
    }
    
     public function favoritebyuser()
    {
        return $this->belongsToMany(User::class,'favorites');
    }
}

