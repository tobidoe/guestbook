
//replaces post with form for editing current post
function showFormEditPost(post_id) {

    var html_form_filler = '<div class="newPost">'+  //todo: is there a better place to put these kind of html constructs?
        '<form action="/guestbook/edit" method="post">'+
            '<input type="hidden" name="_token" value="'+document.head.querySelector("[id~=csrf-token][content]").content+'">'+  //todo: is there a better way to query the csrf-token?
            '<input type="hidden" name="post_id" value="'+post_id+'">'+
            '<label for="body">Ändere deinen Eintrag:</label>'+
            '<br>'+
                '<textarea id="body" name="body"'+
                          'placeholder="Bis zu 800 Zeichen"'+
                          'rows="10" cols="50"'+
                          'required '+
                          'minlength="5"'+
                          'maxlength="800">'+document.querySelector("#body"+post_id).innerHTML+'</textarea>'+
                '<br>'+
                    '<input type="submit" value="Eintrag ändern">  '+
                    '<a href="/guestbook">Änderung abbrechen</a>'+
        '</form>'+

    '</div>';


    document.getElementById(post_id).innerHTML=html_form_filler;

}

//appends a form for creating an answer to current post
function showFormAnswer(post_id) {

    var html_form_filler = '<div class="newPost">'+  //todo: is there a better place to put these kind of html constructs?
        '<form action="/guestbook/newPost" method="post">'+
            '<input type="hidden" name="_token" value="'+document.head.querySelector("[id~=csrf-token][content]").content+'">'+  //todo: is there a better way to query the csrf-token?
            '<input type="hidden" name="post_id" value="'+post_id+'">'+
            '<label for="body">Antworte auf diesen Eintrag:</label>'+
            '<br>'+
                '<textarea id="body" name="body"'+
                          'placeholder="Bis zu 800 Zeichen"'+
                          'rows="10" cols="50"'+
                          'required '+
                          'minlength="5"'+
                          'maxlength="800"></textarea>'+
                '<br>'+
                    '<input type="submit" value="Antworten">  '+
                    '<a href="/guestbook">Abbrechen</a>'+
        '</form>'+

    '</div>';


    var node = document.createElement("div");
    node.innerHTML = html_form_filler;
    document.getElementById(post_id).appendChild(node);

}




