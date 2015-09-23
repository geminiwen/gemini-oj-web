@extends("common.framework")
<?php $tab = "contest"; ?>
@section("title")
    Contests
@endsection

@section("stylesheet")
@endsection

@section("contents")
    @include("common.tab")
    <div class="wrapper">
        <div class="container">
            <h3>Problems</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td width="10%">#</td>
                    <td>Title</td>
                    <td>Start Time</td>
                </thead>
                <tbody>
                @forelse($contests as $contest)
                    <tr>
                        <td>{{ $contest->id }}</td>
                        <td>
                            <a href="/contest/{{ $contest->id }}">{{ $contest->title }}</a>
                        </td>
                        <td>
                            {{ $contest->start_time }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" align="center">Empty</td></tr>
                @endforelse
                </tbody>
            </table>
            <nav class="content-center">
                {!! $contests->render() !!}
            </nav>
        </div>
    </div>
@endsection