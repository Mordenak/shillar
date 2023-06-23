<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shilla Resurrection - A Shilla recreation</title>
        <meta name="description" content="An attempt to recreate the early 2000s browser game called Shilla.">

        <script data-ad-client="ca-pub-1551312053760874" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #333;
                color: #a4b2a9;
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

            .content {
                text-align: center;
            }

            .content a {
                color: #55ff8b;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #55ff8b;
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
                    Contact
                </div>
                <div>
                    Don't.
                </div>

                <div style="margin-top: 4rem;display:grid;grid-template-columns: 1fr 3fr 1fr;">

                </div>

                <div>
                    <a href="{{ url('news') }}">News</a> | <a href="{{ url('info') }}">Info</a> | <a href="{{ url('about') }}">About</a> | <a href="{{ url('/') }}">Home</a>
                </div>

            </div>
        </div>
    </body>
</html>
