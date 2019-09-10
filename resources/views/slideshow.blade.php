<html>
<head>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="{{ asset('css/flipclock.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slideshow.css') }}" rel="stylesheet">

    <script>
        let slideOrder = {{ json_encode($order) }};
    </script>
</head>

<body>

<div id="loading">
    <h1>CH TV</h1>
    <h2>Loading</h2>
</div>

<div id="slides">
    @foreach ($slides as $slide)
        <div class="slide" id="slide{{ $slide->id }}" data-duration="{{ $slide->duration }}">{!!  $slide->getHtml() !!}</div>
    @endforeach
</div>

<div id="progress-bar">
    <div class="progress"></div>
</div>


<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="{{ asset('js/slideshow.js') }}"></script>

<script src="{{ asset('js/kinetic.js') }}"></script>
<script src="{{ asset('js/jquery.final-countdown.js') }}"></script>
<script src="{{ asset('js/flipclock.js') }}"></script>

@yield('postScripts')

</body>

</html>