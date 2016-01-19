@extends('layouts.default')
@section('content')
    <div class="content-class">
        <h2 class="text-center">Users list:</h2>
        @if(isset($users))
            @foreach($users as $user)
                <p>
                    <strong>
                        Nickname: <a href="/users/{{$user->user_id}}">{{$user->login}}</a>
                    </strong>
                </p>
                <p>
                    <strong>
                        Name: {{$user->name}}
                    </strong>
                </p>
                <p>
                    <strong>
                        Surname: {{$user->surname}}
                    </strong>
                </p>
                <hr />
            @endforeach
        @endif
    </div>
@stop