@extends("common.framework")
<?php $tab = "ranklist"; ?>
@section("stylesheet")
    <link rel="stylesheet" href="/static/main/css/contest/ranklist.css"/>
@endsection

@section("title")
    RankList
@endsection


@section("contents")
    @include("common.contest_tab")
    <div class="wrapper">
        <div class="container">
            <h3>RankList</h3>
            <table class="table" border="0" align="center" cellspacing="2">
                <thead>
                <tr valign="middle">
                    <td class="title">User</td>
                    @foreach($problems as $problem)
                        <td align="center"><a href="/contest/{{ $id }}/problem/{{ $problem->id }}">{{  $problem->id  }}</a></td>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($rankList as $rank)
                    <tr>
                        <td class="title">{{ $rank['user']->username }}</td>
                        @foreach($problems as $problem)
                            <?php $resolved = FALSE; ?>
                            @foreach($rank['problem'] as $rankProblem)
                                @if($rankProblem->problem_id == $problem->id)
                                    <?php
                                        if ($rankProblem->is_first) {
                                            $resolveStyle = "first";
                                        } else if ($rankProblem->time_used != NULL) {
                                            $resolveStyle = "resolved";
                                        } else if ($rankProblem->attempt > 0) {
                                            $resolveStyle = "attempted";
                                        } else {
                                            $resolveStyle = "normal";
                                        }
                                    ?>
                                    <td align="center" class="result {{ $resolveStyle }}">
                                        @if($rankProblem->time_used != NULL)
                                            {{ date("H:i:s", $rankProblem->time_used) }}
                                        @endif
                                        @if($rankProblem->attempt > 0)
                                            <div>(-{{ $rankProblem->attempt }})</div>
                                        @endif
                                    </td>
                                    <?php $resolved = TRUE; ?>
                                    @break
                                @endif
                            @endforeach
                            @unless($resolved)
                                <td></td>
                            @endunless
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection