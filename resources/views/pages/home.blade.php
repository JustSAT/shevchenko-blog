@extends('layouts.default')
@section('content')
    @if(isset($user_id))
        <div class="button-section clearfix">
            <form id="newpost-form" name="newPost" method="get" action="/newpost">
                <input type="submit" class="btn btn-success pull-right" value="Add new"/>
            </form>
        </div>
    @endif
    <div class="posts">
        @if($posts->count() > 0)
            @foreach($posts as $post)
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
                        <a href="/posts/{{$post->id}}">{{$post->title}}</a>
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
            @endforeach
        @else
            <div class="content-class">
                Blog is empty
            </div>
        @endif

    {!! $posts->render() !!}
    </div>

@stop
