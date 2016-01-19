@foreach($posts as $post)
    {{ $post->test }}
    {!! $post->test !!}
    <br>
@endforeach

{{ $posts->render() }}

<form action="/posts" method="post">
    <input type="text" name="test" />
    <input type="submit" />
</form>