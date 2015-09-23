<?php isset($tab)? "" : ($tab = ""); ?>
<nav class="container main-nav">
    <ul class="nav nav-tabs">
        <li role="presentation" class="@if($tab == "problem")  active @endif" ><a href="/contest/{{ $id }}">Problems</a></li>
        <li role="presentation" class="@if($tab == "status") active @endif"><a href="/contest/{{ $id }}/status">Status</a></li>
        <li role="presentation" class="@if($tab == "ranklist") active @endif"><a href="/contest/{{ $id }}/ranklist">Rank List</a></li>
    </ul>
</nav>