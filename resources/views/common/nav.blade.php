<div class="global-nav">
    <div class="container nav">
        <a href="/" style="text-decoration: none"><span>Gemini Online Judge</span></a>
        <div class="pull-right user-info">
            @if ($user = Auth::user())
                Welcome, <a href="/user/logout">{{ $user->username }}</a>
            @else
                <a href="/user/login">Login</a>
                <span>·</span>
                <a href="/user/register">Register</a>
            @endif
        </div>
    </div>
</div>