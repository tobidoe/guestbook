{{--creates a template in which the individual posts are embedded--}}
<div class="post" id="{{$post->id}}" style="margin-left:{{$post->nestingDepth*30}}px">
    <p class="post_header">
        Eintrag von {{$post->user->name}}
        am {{$post->created_at}}

        {{--        includes "edited on" date if post is edited--}}
        @if ($post->updated_at != $post->created_at)
            , geändert am {{$post->updated_at}}
        @endif
        :
    </p>

    <p class="post_body" id="body{{$post->id}}">{{$post->body}} </p>
    <p class="post_footer">
        <a href="javascript:showFormAnswer({{$post->id}})">Antworten</a>


        {{--        includes edit and delete hrefs if post was created by currently active user--}}
        @if (auth()->user()->is($post->user))
            <a href="javascript:showFormEditPost({{$post->id}})">Ändern</a>
            <a href="/guestbook/delete?post_id={{$post->id}}"> Löschen</a>
        @endif

    </p>
</div>

