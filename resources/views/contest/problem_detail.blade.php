@extends("common.framework")


@section("stylesheet")
<link rel="stylesheet" href="/static/main/css/problem/index.css" />
@endsection

@section("title")
Problem {{ $problem->title }}
@endsection

@section("contents")
<div class="container">
    <div class="problem-title" >
        <div class="center-block h1 title"> {{ $problem->title }} </div>
        <table class="center problem-spec">
            <tbody>
            <tr>
                <td>Time Limit: {{ $problem->time_limit }}MS</td>
                <td>Memory Limit: {{ $problem->memory_limit }}KB</td>
            </tr>
            <tr>
                <td>Total: {{ $problem->submit }}</td>
                <td>Accept: {{ $problem->accept }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="problem-detail">
        <section>
            <aside>Description</aside>
            <div class="panel-content">{!! $problem->description !!}</div>
        </section>
        <section>
            <aside>Input</aside>
            <div class="panel-content">{!! $problem->input !!}</div>
        </section>
        <section>
            <aside>Output</aside>
            <div class="panel-content">{!! $problem->output !!}</div>
        </section>
        <section>
            <aside>Sample Input</aside>
            <pre class="panel-content">{!! $problem->sample_input !!}</pre>
        </section>
        <section>
            <aside>Sample Output</aside>
            <pre class="panel-content">{!! $problem->sample_output !!}</pre>
        </section>
        <div class="content-center submit-area">
            <button type="button" class="btn btn-primary" onclick="location.href='/contest/{{ $id }}/problem/{{ $problem->id }}/submit'">Submit</button>
            <button type="button" class="btn btn-default" onclick="location.href='/contest/{{ $id }}/problem/{{ $problem->id }}/status'">Status</button>
        </div>
    </div>
</div>
@endsection