<?php isset($tab)? "" : ($tab = ""); ?>
<nav class="container main-nav">
    <ul class="nav nav-tabs">
        <li role="presentation" class="@if($tab == "problem")  active @endif" ><a href="/">Problems</a></li>
        <li role="presentation" class="@if($tab == "status") active @endif"><a href="/status">Status</a></li>
        <li role="presentation" class="@if($tab == "contest") active @endif"><a href="/contest">Contest</a></li>
    </ul>
</nav>