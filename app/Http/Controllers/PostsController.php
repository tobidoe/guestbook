<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Post;
    use App\Models\User;

    class PostsController extends Controller
    {

        //Anzeigen aller Posts
        public function showAllPosts()
        {
            $posts = Post::with('User:id,name')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('/guestbook', ['posts' => $posts]);
        }

        //Anlegen eines neuen Eintrags
        public function insertNewPost()
        {
            $post = new Post;
            $post->post = request('post_text');
            $post->user_id = Auth::id();
            $post->save();
            return redirect('/guestbook');
        }

        //Automatisches Generieren und Anlegen von Einträgen
        public function generatePosts()
        {
            $quantity = request('quantityOfPosts');
            $text = file_get_contents('http://loripsum.net/api/1/medium/plaintext');
            for ($i = 0; $i < $quantity; $i++) 3{
                $post = new Post;
                $post->post = $text;
                $post->user_id = Auth::id();
                $post->save();
            }
            return redirect('/guestbook');
        }


    }
