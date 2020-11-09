@foreach($posts as $post)
    @include('singlePost',['post'=>$post])
{{--    @each('partials.nestedPostsRecursive', $post, 'allChildren_withUser')--}}

    @isset($post->allChildren_withUser)
                @include('partials.nestedPostsRecursive', ['posts'=>$post->allChildren_withUser])
    @endisset
@endforeach
