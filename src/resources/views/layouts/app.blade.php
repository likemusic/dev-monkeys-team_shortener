<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Url Shortener - DevsMonkeys Team (Test task)</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        h1 span {
            display: block;
            font-weight: normal;
            font-size: smaller;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .bottom {
            position: absolute;
            bottom: 2em;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links {
            margin-top: 5em;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        table {
            margin: 3em auto;
            border: 1px solid;
            border-collapse: collapse;
        }

        th {
            border: 1px solid;
        }

        td {
            border: 1px solid;
        }

        .try-again {
            font-size: 24px;
            font-weight: 600;
        }

        .short-info th {
            text-align: right;
        }

        .short-info td {
            text-align: left;
        }

        .last-visitors th {
            text-align: center;
        }

        .last-visitors td {
            text-align: center;
        }

        .alert {
            margin: 1em;
        }
        .alert-danger {
            background-color: lightpink;
            padding: 0.5em;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
