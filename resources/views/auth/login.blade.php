@extends ("common.framework")
@section("title")
Login
@endsection
@section("contents")
<div class="wrap">
    <div class="container" style="margin-top: 50px">
        <form action="/user/login" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="content-center" style="margin-top: 30px">
                <button type="submit" class="btn btn-default">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
