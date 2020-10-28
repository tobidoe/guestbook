<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EditPost</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}"/>

    </head>
    <body>


        <h3>Entwickleroptiooonen:</h3>


        <div class="editPost">
            <form action="/guestbook/newPost" method="post">
                @csrf
                <label for="post">Lege einen neuen Eintrag an:</label>
                <br>
                <textarea id="post" name="post"
                          placeholder="Bis zu 800 Zeichen"
                          rows="10" cols="50"
                          minlength="5"
                          maxlength="800"></textarea>
                <br>
                <input type="submit" value="Eintrag anlegen">
            </form>
        </div>




    </body>
</html>


