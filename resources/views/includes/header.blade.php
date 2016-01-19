<div class="navbar">
    <div class="logo text-center">
        My Blog
    </div>
    <ul class="nav">
        <li><a href="/">Home</a></li>
        <li><a href="/">About</a></li>
        <li><a href="/comments">Comments</a></li>
        <li><a href="/users">Users</a></li>
    </ul>
    <div class="signin">
        @if(isset($user_id))
            <p>
                Hello, {{\App\User::whereId($user_id)->get()->first()->name}}
                {{\App\User::whereId($user_id)->get()->first()->surname}}
            </p>
        <p>
            You logged in as:
            {{\App\User::whereId($user_id)->get()->first()->login}}
        </p>
        @endif
        @include('_common._form_signin')
    </div>
</div>
