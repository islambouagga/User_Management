<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .fa {
                padding: 20px;
                font-size: 30px;
                width: 50px;
                text-align: center;
                text-decoration: none;
                margin: 5px 2px;
                border-radius: 50%;
            }

            .fa:hover {
                opacity: 0.7;
            }

            .fa-facebook {
                background: #3B5998;
                color: white;
            }

            .fa-twitter {
                background: #55ACEE;
                color: white;
            }

            .fa-google {
                background: #dd4b39;
                color: white;
            }

            .fa-linkedin {
                background: #007bb5;
                color: white;
            }

            .fa-youtube {
                background: #bb0000;
                color: white;
            }

            .fa-instagram {
                background: #D20167;
                color: white;
            }

            .fa-pinterest {
                background: #cb2027;
                color: white;
            }

            .fa-snapchat-ghost {
                background: #fffc00;
                color: white;
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            }

            .fa-skype {
                background: #00aff0;
                color: white;
            }

            .fa-android {
                background: #a4c639;
                color: white;
            }

            .fa-dribbble {
                background: #ea4c89;
                color: white;
            }

            .fa-vimeo {
                background: #45bbff;
                color: white;
            }

            .fa-tumblr {
                background: #2c4762;
                color: white;
            }

            .fa-vine {
                background: #00b489;
                color: white;
            }

            .fa-foursquare {
                background: #45bbff;
                color: white;
            }

            .fa-stumbleupon {
                background: #eb4924;
                color: white;
            }

            .fa-flickr {
                background: #f40083;
                color: white;
            }

            .fa-yahoo {
                background: #430297;
                color: white;
            }

            .fa-soundcloud {
                background: #ff5500;
                color: white;
            }

            .fa-reddit {
                background: #ff5700;
                color: white;
            }

            .fa-rss {
                background: #ff6600;
                color: white;
            }
            .fa-github{
                background: black;
                color: white;
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
                    Mohamed Bachir BOUAGGA
                </div>


                    <a href="https://www.facebook.com/mohamed.bouagga.1" class="fa fa-facebook"></a>
                    <a href="https://www.instagram.com/islambouagga/" class="fa fa-instagram"></a>
                    <a href="https://twitter.com/islamslam1" class="fa fa-twitter"></a>
                    <a href="https://www.linkedin.com/in/mohammed-bachir-bouagga-13328714b/" class="fa fa-linkedin"></a>
                    <a href="https://www.github.com/islambouagga/" class="fa fa-github"></a>

            </div>
        </div>
    </body>
</html>
