<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'slug', 'status', 'category_id', 'user_id',
    ];
    
    //Joins categories table to posts table
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    //Joins users table to posts table
    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function post(){
    //     return $this->hasMany(Post::class);
    // }
}
