<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CH TV</title>


    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/file-upload.css') }}" rel="stylesheet">

    <base href="{{ env('APP_URL') }}admin/">

    <script>
        let url = '{{ env('APP_URL') }}admin/';
    </script>
</head>

<body cz-shortcut-listen="true">
<header class="page-header">

    <!-- Title Bar -->
    <div class="title-bar hide-for-large" data-responsive-toggle="nav-menu" data-hide-for="large" style="display: none;">
        <div class="row collapse">
            <div class="small-6 medium-5 bg-left column">
                <a class="logo-small hide-for-large" href="https://ch.tudelft.nl/">
                    <img src="https://ch.tudelft.nl/wp-content/themes/rechallenge/assets/images/ch-logo.png" alt="W.I.S.V. 'Christiaan Huygens'" class="logo-small">
                </a>
            </div>
            <div class="small-6 medium-7 bg-right column">
                <div class="float-right">
                    <a class="login-button button alert" href="https://ch.tudelft.nl/portal" data-open="login-form" aria-controls="login-form" aria-haspopup="true" tabindex="0">Login</a>
                    <button class="wisv-menu-icon hamburger hamburger--collapse" type="button" data-toggle="">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Top Bar -->
    <div class="wisv-header left">

        <div class="wisv-header right">
            <div class="center row">

                <nav class="top-bar" id="nav-menu">
                    <div class="top-bar-left show-for-large">
                        <div class="logo-wrapper">
                            <div class="logo">
                                <a href="https://ch.tudelft.nl/">
                                    <img src="https://ch.tudelft.nl/wp-content/themes/rechallenge/assets/images/ch-logo.png" width="300" height="110" alt="W.I.S.V. 'Christiaan Huygens'">
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    </div>


    <!-- Page title -->
    <div class="page-title" style="background-image:url({{URL::asset('images/header.jpg')}})">
        <div class="row">
            <div class="col">
                <h1>@yield('title')</h1>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <main class="col p-5" role="main">
            <div class="row mb-5">
                <div class="col">
                    <h1>@yield('title')</h1>
                </div>
                <div class="col text-right">
                    @yield('button')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @if (!empty($errors))
                        @foreach($errors as $error)
                            <div class="alert alert-info w-100" role="alert">
                                <span class="sr-only">{{ strtoupper($error->type) }}:</span>
                                <strong>{{ $error->type }}:</strong> {{ $error->message }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div id="container">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script
        src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" integrity="sha256-9YAuB2VnFZNJ+lKfpaQ3dKQT9/C0j3VUla76hHbiVF8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>


{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="{{ asset('js/file-upload.js') }}" defer></script>
<script src="{{ asset('js/admin.js') }}" defer></script>


@yield('postScripts')

</body>
</html>