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
@foreach ($blocks as $block)
    @if($block instanceof \App\NotionModels\Paragraph)
        <p>{!! nl2br(htmlspecialchars($block->plainText())) !!}</p>
    @elseif ($block instanceof \App\NotionModels\Code)
        <pre>
            <code class="language-{{ $block->language }}">{{ $block->plainText() }}</code>
        </pre>
    @endif
@endforeach
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
