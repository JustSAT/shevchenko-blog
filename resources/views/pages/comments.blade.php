@extends('layouts.default')
@section('content')

    <div class="content-class">
        @foreach($comments as $comment)
            <div class="comment">
                <div class="comments-border">
                     <a href="/posts/{{$comment->post_id}}"><?php $post = \App\Post::where(['id' => $comment->post_id])->get()->first(); echo $post->title;?></a>
                </div>
                <div class="comment-content">
                    {{$comment->content}}
                </div>
                <div class="comment-info clearfix">
                    <strong class="login pull-left">
                        Author: <a href="/users/{{$comment->user_id}}">{{\App\User::whereId($comment->user_id)->get()->first()->login}}</a>
                    </strong>
                    <strong class="date pull-right">
                        Created at: {{$comment->created_at}}
                    </strong>
                </div>
            </div>
            <hr/>
        @endforeach
    </div>
@stop