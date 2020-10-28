<?php

//comment Never use helper functions unless you exactly know what you are doing
// If you feel the need to build a helper function, then probably you miss something

    use App\Models\Post;
    use Illuminate\Support\Collection;

    //displays posts, structure depending on post/answer hierarchy and nesting depth
    function showNestedPosts()
    {

        $posts = Post::with('User:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($posts as $post) {

            //displays only posts that aren´t answers to posts
            if (!isset($post->post_id)) {
                showPost($post);

                //displays associated answer(s)
                if ($post->childs()->get()->isNotEmpty()) {    //todo: unnecessary expensive because of two queries?
                    //comment: YES it is expensive. Use prop-calls (i.e. $post->childs instead of $post->childs() )
                    // and/or eager loading instead
                    showChilds($post->childs()->get());
                }
            }
        }
    }


    //displays answers
    function showChilds($childs)
    {
        static $nestingDepth = 0; //nesting depth of answer, required for styling
        $nestingDepth++;
        foreach ($childs as $child) {
            showPost($child, $nestingDepth);

            //recursive call as long as there are associated answers
            if ($child->childs()->get()->isNotEmpty()) {
                showChilds($child->childs()->get());
            }
        }
        $nestingDepth--;

    }



//comment: e.g. if your function is responsible for displaying something (like showing post)
// you should use a (blade)-template instead.

    //echoes post in correspondending html structure
    function showPost($post, $nestingDepth = 0)
    {

        //includes inline style for indentation based on nesting depth
        echo '
                <div class="post" id="' . $post->id . '" style="margin-left:'. $nestingDepth*30 .'px" >
                    <p class="post_header">
                        Eintrag von ' . $post->user->name . '
                        am '.$post->created_at;

        //echoes "edited on" date if post is edited
        if ($post->updated_at != $post->created_at) {
            echo ', geändert am ' . $post->updated_at;
        }

        echo '
               :
                </p>
                <p class="post_body" id="post' . $post->id . '">' . $post->post . ' </p>
                <p class="post_footer">
                    <a href="javascript:showFormAnswer(' . $post->id . ')" >Antworten</a>';


        //echoes edit and delete hrefs if post was created by currently active user
        //comment: Again its better to use auth()->user()->is($post->user)
        if ($post->user_id == Auth::id()) {
            echo '
                    <a href="javascript:showFormEditPost(' . $post->id . ')" >Ändern</a>
                           <a href = "/guestbook/deletePost?post_id=' . $post->id . '"> Löschen</a >';
        }

        echo '
                </p>
            </div>
            ';
    }


