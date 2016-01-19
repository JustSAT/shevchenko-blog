@extends('layouts.default')
@section('content')
    <div class="content-class">
        @if(isset($user))
            <h1 class="text-center">{{$user->login}}'s profile</h1>
            <p><strong>Name: </strong>{{$user->name}}</p>
            <hr />
            <p><strong>Surname: </strong>{{$user->surname}}</p>
            <hr />
            <p><strong>Registration date: </strong>{{$user->created_at}}</p>
            <hr />
            <p><strong>Total posts: </strong>{{\App\Post::where(['user_id' => $user->id])->get()->count()}}</p>
            <hr />
            <p><strong>Total comments: </strong>{{\App\Comment::where(['user_id' => $user->id])->get()->count()}}</p>
        @endif
    </div>
@stop