<div class="global-nav">
    <div class="container nav">
        <span>Gemini Online Judge</span>
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
<?php isset($tab)? "" : ($tab = ""); ?>
<nav class="container main-nav">
    <ul class="nav nav-tabs">
        <li role="presentation" class="@if($tab == "problem")  active @endif" ><a href="/">Problems</a></li>
        <li role="presentation" class="@if($tab == "status") active @endif"><a href="/status">Status</a></li>
    </ul>
</nav>