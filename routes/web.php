<?php

    use Illuminate\Support\Facades\Route;


    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    //root
    Route::get('/', function () {
        return view('landingPage');
    });

    //dashboard
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware('auth')->group(function () {


        //display posts
        Route::get('/guestbook', 'App\Http\Controllers\PostsController@index');

        //inserts new post
        Route::post('/guestbook/newPost', 'App\Http\Controllers\PostsController@create');

        //edits post
        Route::post('/guestbook/edit', 'App\Http\Controllers\PostsController@edit');

        //deletes post
        Route::get('/guestbook/delete', 'App\Http\Controllers\PostsController@delete');



        //generates new posts
        Route::get('/guestbook/generatePosts', 'App\Http\Controllers\PostsController@generatePosts');

        //deletes all Posts
        Route::delete('/guestbook/deleteAllPosts', 'App\Http\Controllers\PostsController@deleteAllPosts');




    });



