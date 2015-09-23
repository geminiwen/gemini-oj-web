@extends("common.framework")
<?php $tab = "status" ?>
@section("stylesheet")
    <link rel="stylesheet" href="/static/main/css/status/index.css"/>
@endsection

@section("title")
    Status
@endsection

@section("contents")
    @include("common.contest_tab")
    <div class="wrapper">
        <div class="container">
            <h3>Status</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td width="7%">#</td>
                    <td width="12%">Problem Id</td>
                    <td width="12%">User</td>
                    <td width="12%">Status</td>
                    <td width="12%">Language</td>
                    <td width="12%">Time Used</td>
                    <td width="12%">Memory Used</td>
                    <td>Submit Time</td>
                </tr>
                </thead>
                <tbody>
                @forelse($statusList as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td><a href="/problem/{{ $status->problem->id}}">{{ $status->problem->id }}</a></td>
                        <td>{{ $status->user->username }}</td>
                        <td>
                            @if($status->result == -2)
                                <span class="waiting">Waiting..</span>
                            @elseif ($status->result == -1)
                                <span class="running">Running..</span>
                            @elseif ($status->result == 0)
                                <span class="accept">Accept</span>
                            @elseif ($status->result == 1)
                                <span class="presentation-error">Presentation Error</span>
                            @elseif ($status->result == 2)
                                <span class="time-limit-exceeded">Time Limit Exceeded</span>
                            @elseif ($status->result == 3)
                                <span class="memory-limit-exceeded">Memory Limit Exceeded</span>
                            @elseif ($status->result == 4)
                                <span class="wrong-answer">Wrong Answer</span>
                            @elseif ($status->result == 5)
                                <span class="runtime-error">Runtime Error</span>
                            @elseif ($status->result == 6)
                                <span class="output-limit-exceeded">Output Limit Exceeded</span>
                            @elseif ($status->result == 7)
                                <span class="compile-error">Compile Error</span>
                            @else
                                <span class="system-error">System Error</span>
                            @endif
                        </td>
                        <td>{{ $status->language }}</td>
                        <td>{{ $status->time_used }} MS</td>
                        <td>{{ $status->memory_used }} KB</td>
                        <td>{{ $status->create_time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" align="center">Empty</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <nav class="content-center">
                {!! $statusList->render() !!}
            </nav>
        </div>
    </div>
@endsection