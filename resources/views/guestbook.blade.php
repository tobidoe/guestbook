<?php

    use App\Models\Post;
    use App\Models\User;

    $users = User::all();
    $posts = Post::all();


    foreach ($posts as $posts) {
        echo getUserName($posts->user_id).": <br>";
        echo "$posts->post  <br>";
    }



function getUserName($uid){
        $user = User::where('id', $uid)
            ->first();
        return $user->name;
}


