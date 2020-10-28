<?php require(app_path() . '/helpers.php'); ?>

{{--  comment: extract this to a layout  --}}

@extends('layouts.main')

@section('content')




        <h3>Entwickleroptionen:</h3>

        <div class="m-4 p-4 bg-red-200  rounded-lg shadow-md">
            <h4 class="font-bold text-lg py-2">Titel</h4>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deserunt dolores est eum exercitationem illo ipsa quam quis similique tempore!
        </div>

{{--        adds a form for autogeneration of posts--}}
        <div class="generatePosts">
            <form action="/guestbook/generatePosts" method="put">
                @csrf
                <label for="quantityOfPosts">Automatisches Anlegen von Posts (max. 50):</label>
                <input type="number" id="quantityOfPosts"
                       placeholder="Anzahl"
                       name="quantityOfPosts"
                       min="1" max="50"
                       required>

                <input type="submit" value="Anlegen">
            </form>
        </div>


        <br>

{{--        adds a form for deletion of all posts--}}
        <div class="deletePosts">
            <form action="/guestbook/deleteAllPosts" method="post"
                  onsubmit="return confirm('Sollen wirklich alle Posts gelöscht werden?');">
                @csrf
                @method('delete') {{--                required for REST verbs in Routes--}}
                <label for="quantityOfPosts">Löschen <u>aller</u> Posts:</label>
                <input type="submit" id="deletePosts"
                       placeholder="Anzahl"
                       name="deletePosts" value="Löschen">
            </form>
        </div>


        <hr>
        <br>
        <br>


        <h1>Gästebuch</h1>

{{--        adds a form for adding a new post--}}
        <div class="newPost">
            <form action="/guestbook/newPost" method="post">
                @csrf
                <label for="post">Lege einen neuen Eintrag an:</label>
                <br>
                <textarea id="post" name="post"
                          placeholder="Bis zu 800 Zeichen"
                          rows="10" cols="50"
                          minlength="5"
                          maxlength="800"
                          required></textarea>
                <br>
                <input type="submit" value="Eintrag anlegen">
            </form>
        </div>


        <br>
        <br>
@foreach($posts as $post)
    <div class="m-4 p-2 rounded bg-green-100 shadow-md">
        Beitrag von {{$post->user->name}}
        <div>
            {{$post->post}}
        </div>
        @foreach($post->childs as $childPost)

        @endforeach
    </div>
@endforeach

{{--        displays posts, structure depending on post/answer hierarchy and nesting depth--}}
        <?php showNestedPosts(); ?>

@endsection


