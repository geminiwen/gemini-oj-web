<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" >
    <title>@yield("title") - Online Judge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/static/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/static/main/css/global.css" />
    @yield("stylesheet")
</head>
<body>
@include("common.nav")
@yield("contents")
<script type="text/javascript" src="/static/assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/static/assets/js/bootstrap.min.js"></script>
@yield("scripts")
</body>
</html>