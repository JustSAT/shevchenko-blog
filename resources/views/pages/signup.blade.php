@extends('layouts.default')
@section('content')
    <div class="content-class">
        <form name="signup" method="post" action="/signup" class="singin-form" xmlns="http://www.w3.org/1999/html">
            <p><strong>Username:</strong>
                <input type="text" name="login" />
            </p>
            <p><strong>Password:</strong>
                <input type="password" name="password"/>
            </p>
            <p><strong>Submit password:</strong>
                <input type="password" name="passwordSubmit"/>
            </p>
            <p><strong>Name:</strong>
                <input type="text" name="name" />
            </p>
            <p><strong>Surname:</strong>
                <input type="text" name="surname" />
            </p>
            @if(isset($messageSignup))
                <p class="text-error">{{$messageSignup}}</p>
            @endif
            {{--<input type="checkbox" name="remember_me"/>--}}
            {{--Remember me<br>--}}
            <div class="button signup-button">
                <input type="submit" class="btn btn-success" value="Sign in"/>
            </div>
        </form>
        </div>
@stop
