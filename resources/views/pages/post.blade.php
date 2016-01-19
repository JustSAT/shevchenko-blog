@extends('layouts.default')
@section('content')
    <div class="posts">
        <div class="post">
            @if($post->user_id == $user_id)
                <form action="/posts/delete/{{$post->id}}" method="post">
                    <button  type="submit" class="btn btn-danger pull-right">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                </form>
            @endif
            <h1>
                {{$post->title}}
            </h1>
            <div class="post-content">
                {{$post->content}}
            </div>
            <div class="post-info">
                <strong class="login pull-left">
                    Author: <a href="/users/{{$post->user_id}}">{{\App\User::whereId($post->user_id)->get()->first()->login}}</a>
                </strong>
                <strong class="date pull-right">
                    Created at: {{$post->created_at}}
                </strong>
            </div>
        </div>
        <h2 class="text-center">Commentaries:</h2>
        <div class="comments">
            <div class="comments-content">
                @if(isset($comments) and $comments->count() > 0)
                    @foreach($comments as $comment)
                        <div class="comment">
                            @if($comment->user_id == $user_id)
                                <form action="/comments/delete/{{$comment->id}}" method="post">
                                    <button  type="submit" class="btn btn-danger pull-right btn-xs">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <input type="hidden" value="{{$comment->id}}" name="comment_id">
                                </form>
                            @endif
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
                    @endforeach
                @else
                    Comments are empty
                @endif
            </div>
            @include('_common._form_new_comment')
        </div>

    </div>

@stop
