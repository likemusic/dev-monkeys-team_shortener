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
            }

            th {
                text-align: right;
            }

            td {
                text-align: left;
            }

            .try-again {
                font-size: 24px;
                font-weight: 600;
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
                <div class="title m-b-md">
                    Url Shortener
                </div>

                @isset($shortUrl)
                    <div class="short-info">
                        <table>
                            <caption>Urls</caption>
                            <tr>
                                <th>Source:</th>
                                <td><code>{{ $sourceUrl }}</code> <a href="{{ $sourceUrl }}">GO</a></td>
                            </tr>
                            <tr>
                                <th>Short:</th>
                                <td><code>{{ $shortUrl }}</code> <a href="{{ $shortUrl }}">GO</a></td>
                            </tr>
                            <tr>
                                <th>Stat:</th>
                                <td><code>{{ $statUrl }}</code> <a href="{{ $statUrl }}">GO</a></td>
                            </tr>
                        </table>
                    </div>

                    <div class="try-again">
                        Want's more? Try again!
                    </div>
                @endisset

                <div class="form">
                    <form action="" method="POST">
                        @csrf
                        <label>Url: <input name="url" placeholder="https://devsmonkeys.com/" type="url"/></label>
                        <button type="submit">Short It!</button>
                    </form>
                </div>


                <div class="links">
                    {{--<a href="https://laravel.com/docs">Docs</a>--}}
                    <a href="https://devsmonkeys.com/">DevsMonkeys Website</a>
                    <a href="https://github.com/likemusic/dev-monkeys-team_shortener">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
