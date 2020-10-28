<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post','user_id', 'post_id'];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //references to itself for creating post/answer-hierarchy
    public function parent(){
        return $this->belongsTo('App\Models\Post','post_id');
    }

    //references to itself for creating post/answer-hierarchy
    public function childs(){
        return $this->hasMany('App\Models\Post');
    }
}
