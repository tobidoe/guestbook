{{--extends basic html template--}}
@extends('layouts.master')

@section('title','Gästebuch')


@section('content')


    {{--    includes development functionality: generate Posts and delete all posts--}}
    @include('partials.developmentFunctionality')


    <h1>Gästebuch</h1>

    {{--    adds a form for adding a new post--}}
    <div class="newPost">
        <form action="/guestbook/newPost" method="post">
            @csrf
            <label for="body">Lege einen neuen Eintrag an:</label>
            <br>
            <textarea id="body" name="body"
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


    {{--includes posts with indentation based on nesting depth--}}
    @include('partials.nestedPostsRecursive')


@endsection









