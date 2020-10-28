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


    //comment: All the routes use the same middleware -> use route grouping


    //display posts
    Route::get('/guestbook', 'App\Http\Controllers\PostsController@showAllPosts')
        ->middleware('auth');

    //inserts new post
    Route::post('/guestbook/newPost', 'App\Http\Controllers\PostsController@insertNewPost')
        ->middleware('auth');

    //generates new posts
    Route::get('/guestbook/generatePosts', 'App\Http\Controllers\PostsController@generatePosts')
        ->middleware('auth');

    //deletes all Posts
    Route::delete('/guestbook/deleteAllPosts', 'App\Http\Controllers\PostsController@deleteAllPosts')
        ->middleware('auth');

    //deletes post
    Route::get('/guestbook/deletePost', 'App\Http\Controllers\PostsController@deletePost')
        ->middleware('auth');

    //edits post
    Route::post('/guestbook/editPost', 'App\Http\Controllers\PostsController@editPost')
        ->middleware('auth');
