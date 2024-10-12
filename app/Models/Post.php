<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    #to associate category to the post by the foreign id 
    public function category()  {
        return $this->belongsTo(Category::class);   
    }
    public function Tags()  {
        return $this->belongsToMany(Tag::class);   
    }
    
}
