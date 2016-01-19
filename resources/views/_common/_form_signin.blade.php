@if(!isset($user_id))
    <form name="signin" method="post" action="/login" class="singin-form" xmlns="http://www.w3.org/1999/html">
        <p><strong>Username:</strong>
            <input type="text" name="login" />
        </p>
        <p><strong>Password:</strong>
            <input type="password" name="password"/>
        </p>
        @if(session('message'))
            <?php
                $message = session('message');
                echo "<script type=\"text/javascript\">alert('$message');</script>"
            ?>
        @endif
        {{--<input type="checkbox" name="remember_me"/>--}}
        {{--Remember me<br>--}}
        <div class="button">
            <input type="submit" class="blog btn btn-success" value="Sign in"/>
        </div>
    </form>
    <form name="signup" method="get" action="/signup" class="signup-form" xmlns="http://www.w3.org/1999/html">
        <input type="submit" class="blog btn btn-default" value="Sign up"/>
    </form>
@else
    <form name="logout" method="get" action="/logout">
        <input type="submit" class="singin btn btn-warning" value="Log out"/>
    </form>
@endif