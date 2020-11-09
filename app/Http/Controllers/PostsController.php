<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Post;
    use App\Classes\NestingDepthCounter;
    use Illuminate\Support\Facades\DB;

    class PostsController extends Controller
    {


        //displays posts
        public function index()
        {
            $posts = Post::whereNull('post_id')
                ->with('allChildren_withUser')
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->get();

            //adds current nesting depth to each post
            $posts = NestingDepthCounter::addNestingDepths($posts);

            return view('guestbook', ['posts' => $posts]);
        }


        //inserts new post into database
        public function create(Request $request)
        {
            auth()->user()->posts()->create($request->except('_token'));
            return redirect()->back();
        }


        //edits posts body
        public function edit(Request $request)
        {
            //checks if the post to edit is users own post
            //return Post::find($request->post_id)->user()->first();
            if (auth()->user() != Post::find($request->post_id)->user) { //todo: use model binding / prevent code injection (here and on similar expressions)
                return 'Du kannst nur deine eigenen Posts ändern';
            }

            $post = Post::find(request('post_id'));
            $post->body = request('body');
            $post->save();

            return redirect()->back();
        }


        //deletes posts body if post has answers, deletes post otherwise
        public function delete(Request $request)
        {
            //checks if the post to delete is users own post
            if (auth()->user() != Post::find($request->post_id)->user) {
                return 'Du kannst nur deine eigenen Posts löschen';
            }

            //todo: use Route model binding (here and on similar expressions)
            $post = Post::find(request('post_id'));

            //deletes posts body if ist has answers
            if ($post->children->isNotEmpty()) {
                $post->body = '-Inhalt wurde gelöscht-';
                $post->save();
            }

            else {
                $post->delete();
            }

            return redirect()->back();
        }


        //generates posts and inserts them into database
        public function generatePosts()
        {
            if (request('quantityOfPosts') > 50) {
                return 'Du kannst maximal 50 Posts generieren lassen';
            }
            Post::factory()->count(request('quantityOfPosts'))->create();
            return redirect()->back();
        }


        //deletes all posts
        public function deleteAllPosts()
        {
            DB::table('posts')->truncate();
            return redirect()->back();
        }

    }
