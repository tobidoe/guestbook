<?php require(app_path() . '/helpers.php'); ?>

    <!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}"> {{--        is queried by javascript functions in script.js--}}
        <title>Titel</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}"/>
        <script src="/js/script.js"></script>

    </head>

    <body>

        <h3>Entwickleroptionen:</h3>

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


{{--        displays posts, structure depending on post/answer hierarchy and nesting depth--}}
        <?php showNestedPosts(); ?>

    </body>
</html>


