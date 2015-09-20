@extends("common.framework")

@section("stylesheet")
<link rel="stylesheet" href="/static/assets/css/codemirror.css" />
<link rel="stylesheet" href="/static/main/css/problem/submit.css" />
@endsection

@section("scripts")
<script type="text/javascript" src="/static/assets/js/codemirror.js"></script>
<script type="text/javascript" src="/static/assets/js/clike.js"></script>
<script type="text/javascript" src="/static/assets/js/javascript.js"></script>
<script type="text/javascript">
    $(function () {
        var code = document.getElementById("code");
        var editor = CodeMirror.fromTextArea(code, {
            lineNumbers: true,
            matchBrackets: true,
            mode: "text/x-csrc"
        });

        $("#language").on("change", function () {
            var value = $(this).val();
            switch (value) {
                case "c": {
                    editor.setOption("mode", "text/x-csrc");
                    break;
                }
                case "cpp": {
                    editor.setOption("mode", "text/x-c++src");
                    break;
                }
                case "javascript": {
                    editor.setOption("mode", "text/javascript");
                    break;
                }
                case "java": {
                    editor.setOption("mode", "text/x-java");
                    break;
                }
            }
        });
    });

</script>
@endsection

@section("title")
{{ $problem->title }}
@endsection

@section("contents")
<form action="/problem/{{ $problem->id }}/submit" method="post">
    <div class="container">
        <div class="content-center h1">{{ $problem->title }}</div>
        <div class="language-container">
            <label for="language">Language</label>
            <select id="language" name="language">
                <option value="c">C</option>
                <option value="cpp">C++</option>
                <option value="javascript">javascript</option>
                <option value="java">java</option>
            </select>
        </div>
        <textarea name="code" id="code" class="text-code"></textarea>
        <div class="content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! csrf_field() !!}
</form>
@endsection