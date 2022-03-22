<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@foreach ($pages as $page)
    <h2><a href="/articles/{{ $page['id'] }}">{{ $page['name'] }}</a></h2>
    <p>{{ $page['description'] }}</p>
    <ul>
        @foreach($page['tags'] as $tag)
            <p>{{ $tag['name'] }}</p>
        @endforeach
    </ul>
@endforeach
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
