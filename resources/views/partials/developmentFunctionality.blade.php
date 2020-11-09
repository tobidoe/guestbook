<h3>Entwickleroptionen:</h3>

{{--    adds a form for autogeneration of posts--}}
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

{{--    adds a form for deletion of all posts--}}
<div class="deletePosts">
    <form action="/guestbook/deleteAllPosts" method="post"
          onsubmit="return confirm('Sollen wirklich alle Posts gelöscht werden?');">
        @csrf
        @method('delete')
        <label for="quantityOfPosts">Löschen <u>aller</u> Posts:</label>
        <input type="submit" id="deletePosts"
               placeholder="Anzahl"
               name="deletePosts" value="Löschen">
    </form>
</div>

<hr>
<br>
<br>
