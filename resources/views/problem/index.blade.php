@extends("common.framework")
<?php $tab = "problem" ?>

@section("stylesheet")
    <link rel="stylesheet" href="/static/main/css/problem/index.css" />
@endsection

@section("title")
    Problem
@endsection

@section("contents")
    <div class="wrapper">
        <div class="container">
            <h3>Problems</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td width="10%">#</td>
                    <td>Title</td>
                    <td width="20%">Difficulty Rate</td></tr>
                </thead>
                <tbody>
                @forelse($problems as $problem)
                <tr>
                    <td>{{ $problem->id }}</td>
                    <td>
                        <a href="/problem/{{ $problem->id }}">{{ $problem->title }}</a>
                    </td>
                    <td>
                        @if($problem->submit == 0)
                            No submits
                        @else
                            {{ sprintf("%d", $problem->accept * 100 / $problem->submit) }} %
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" align="center">Empty</td></tr>
                @endforelse
                </tbody>
            </table>
            <nav class="content-center">
                {!! $problems->render() !!}
{{--                {{ pagenav(page, pageSize, total, "/?page=#page#") }}--}}
            </nav>
        </div>
    </div>
@endsection