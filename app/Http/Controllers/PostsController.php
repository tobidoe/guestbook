<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Post;
    use App\Models\User;

    class PostsController extends Controller
    {

        //displays posts
        public function showAllPosts()
        {
            $posts = Post::with('User:id,name')  //todo: delete because posts are queried by helper functions?
            ->orderBy('created_at', 'desc')
                ->get();
            return view('/guestbook', ['posts' => $posts]);  //todo: delete second parameter?
        }

        //inserts new post into database
        public function insertNewPost(Request $request)
        {

            echo auth()->user()->posts()->create($request->except('_token'));
            return redirect('/guestbook');
        }

        //generates posts and inserts them into database
        public function generatePosts()
        {
            Post::factory()->count(request('quantityOfPosts'))->create();
            return redirect('/guestbook');
        }


        //deletes all posts
        public function deleteAllPosts()  //wtf, too expensive by far xD; todo: replacing all "$post = Post::first();" with a foreach at least!
        {
            $post = Post::first();


            //traverses collection(s) of answers and deletes the most nested answers first to preserve consistency of database
            function deleteAllPostsRecursive($post)
            {
                if ($post == null) {
                    return;
                }

                //recursive call if post is not the most depth nested in his branch
                if ($post->childs()->get()->isNotEmpty()) {
                    deleteAllPostsRecursive($post->childs()->first());
                }
                $post->delete();
                $post = Post::first();
                deleteAllPostsRecursive($post);
            }


            deleteAllPostsRecursive($post);
            return redirect('/guestbook');
        }


        //deletes Post if it hasn´t been answered too, replaces content if it has (to preserve consistency of nested structure)
        //todo: add server-side check if post was created by active user to prevent html injection
        public function deletePost()
        {
            $post = Post::find(request('post_id'));
            if ($post->childs()->get()->isNotEmpty()) {
                $post->post = '-Inhalt wurde gelöscht-';
                $post->save();
            } else {
                $post->delete();
            }
            return redirect('/guestbook');
        }

        //edits Post
        //todo: add server-side check if post was created by active user to prevent html injection
        public
        function editPost()
        {
            $post = Post::find(request('post_id'));
            $post->post = request('post');
            $post->save();
            return redirect('/guestbook');
        }


    }
