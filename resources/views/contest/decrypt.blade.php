@extends("common.framework")
<?php $tab = "contest"; ?>

@section("stylesheet")
    <link rel="stylesheet" href="/static/main/css/contest/decrypt.css" />
@endsection

@section("title")
    Contests
@endsection

@section("contents")
    <div class="wrapper">
        <div class="container content-center">
            <form action="/contest/{{ $id }}/decrypt" method="POST">
                {!! csrf_field() !!}
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" >
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection