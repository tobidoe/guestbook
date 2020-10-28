<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Post;
    use App\Models\User;

    class PostsController extends Controller
    {

        //comment: Lets use restful method names (index, show, edit, update, destroy, etc...)

        //displays posts
        public function showAllPosts()
        {
            $posts = Post::with('User:id,name')  //todo: delete because posts are queried by helper functions? comment: Noooooo! Never use helper functions
            ->orderBy('created_at', 'desc')
                ->get();

            //comment: view doesn't need slashes. It uses dot-syntax
            return view('/guestbook', ['posts' => $posts]);  //todo: delete second parameter?
        }

        //inserts new post into database
        public function insertNewPost(Request $request)
        {
            //comment: Never use echo. What is the result of ->create(...), anyways ?
            echo auth()->user()->posts()->create($request->except('_token'));
            //comment: Use redirect()->back() instead
            return redirect('/guestbook');
        }

        //generates posts and inserts them into database
        public function generatePosts()
        {
            //comment: The maximum of 50 is never validated
            Post::factory()->count(request('quantityOfPosts'))->create();

            //comment: redirect()->back();
            return redirect('/guestbook');
        }


        //deletes all posts
        public function deleteAllPosts()  //wtf, too expensive by far xD; todo: replacing all "$post = Post::first();" with a foreach at least!
        {
            $post = Post::first();


            //comment: Try to avoid declaring ad-hoc subfunctions
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

            //comment: try instead Post::delete() (not sure if this works, though)
            // or Post::all()->each->delete()


            //comment: redirect()->back();
            return redirect('/guestbook');
        }


        //deletes Post if it hasn´t been answered too, replaces content if it has (to preserve consistency of nested structure)
        //todo: add server-side check if post was created by active user to prevent html injection comment: Oh yeah! this is really important
        public function deletePost()
        {
            //comment: Use Route model binding here
            $post = Post::find(request('post_id'));
            //comment: Better $post->childs->isNotEmpty()
            if ($post->childs()->get()->isNotEmpty()) {
                $post->post = '-Inhalt wurde gelöscht-';
                $post->save();
            } else {
                $post->delete();
            }
            //comment: Why not leveraging the sql constraints?

            //comment: redirect()->back();
            return redirect('/guestbook');
        }

        //edits Post
        //todo: add server-side check if post was created by active user to prevent html injection
        public function editPost()
        {
            //comment: 1. Lets use Route model binding here
            // 2. use fillable prop accordingly: $post->update($request->all())
            $post = Post::find(request('post_id'));
            $post->post = request('post');
            $post->save();
            //comment: redirect()->back();
            return redirect('/guestbook');
        }


    }
