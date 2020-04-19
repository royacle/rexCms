<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id'
    ];
     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'array',
    ];

    //Joins users table to categories table
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Joins posts table to categories table
    public function post(){
        return $this->hasMany(Post::class, 'users', 'id');
    }
}
