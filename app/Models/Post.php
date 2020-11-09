<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use function PHPUnit\Framework\isEmpty;

    class Post extends Model
    {
        use HasFactory;

        protected $fillable = ['body', 'post_id'];
        public static $snakeAttributes = false;


        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        //references to itself for creating post/answer-hierarchy
        public function parent()
        {
            return $this->belongsTo('App\Models\Post', 'post_id');
        }

        //references to itself for creating post/answer-hierarchy
        public function children()
        {
            return $this->hasMany('App\Models\Post');
        }


        //references to itself for creating post/answer-hierarchy
        public function allChildren_withUser()
        {
            return $this->hasMany('App\Models\Post')->with('user','allChildren_withUser');
        }

    }
