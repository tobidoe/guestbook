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

Route::get('/', function () {
    return view('landingPage');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Anzeigen aller Posts
Route::get('/guestbook', 'App\Http\Controllers\PostsController@showAllPosts')
    ->middleware('auth');

//Anlegen eines neuen Eintrags
    Route::post('/guestbook/newPost', 'App\Http\Controllers\PostsController@insertNewPost')
        ->middleware('auth');

//Automatisches Anlegen von Einträgen
    Route::get('/guestbook/generatePosts', 'App\Http\Controllers\PostsController@generatePosts')
        ->middleware('auth');


3
