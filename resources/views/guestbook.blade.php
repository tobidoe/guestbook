<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Titel</title>

    </head>
    <body>


        <div class="generatePosts">
            <h3>Entwickleroptionen:</h3>
            <form action="/guestbook/generatePosts" method="put">
                Automatisches Anlegen von Posts (max. 50):<br>
                <input type="number" id="quantityOfPosts"
                       placeholder="Anzahl"
                       name="quantityOfPosts" min="1" max="50">

                <input type="submit" value="Anlegen">
            </form>
        </div>
        <hr>
        <br>
        <br>
        <h1>Gästebuch</h1>

        <div class="newPost">
            <form action="/guestbook/newPost" method="post">
                @csrf
                <label for="post_text">Lege einen neuen Eintrag an:</label>
                <br>
                <textarea id="post_text" name="post_text"
                          placeholder="Bis zu 800 Zeichen"
                          rows="10" cols="50"
                          minlength="5"
                          maxlength="800"></textarea>
                <br>
                <input type="submit" value="Eintrag anlegen">
            </form>
        </div>
        <br>
        <br>



        <div class="posts">
            @foreach($posts as $post)
                <p id="post">
                    Eintrag von {{$post->user->name}}
                    am {{$post->created_at}}: <br> {{$post->post}}
                </p>
            @endforeach


        </div>


    </body>
</html>


