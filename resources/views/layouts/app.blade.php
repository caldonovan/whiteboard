<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- All very messy at the moment! This is purely for development and testing and will be optimised for production! -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Material Design Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    <!-- Roboto Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
    <!-- TinyMCE editor JS -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- MaterialDB JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>

    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">

    <script>
        tinymce.init({
            selector:'#editor',
            menubar: false,
            invalid_elements: 'script, h1, h2'
        });
    </script>

    <style>

        body {
            background-color: #fff;
        }

        .navbar {
            font-weight: 400;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Roboto', serif;
            font-weight: 500;
            text-rendering: geometricPrecision;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            color: rgba(0,0,0,0.87);
        }

        a, a:hover {
            text-decoration: none;
            color: black;
        }

        .card {
            border-radius: 2px;
        }

        .card-dark, .card-dark:hover {
            text-decoration: none;
            background-color: #263238;
            color: #f5f5f5;
        }

        .btn {
            border-radius: 2px;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
        }

        .btn-sm {
            padding: 0;
        }

        /* css to animate the posts on mouse over */
        .hvr-grow {
            -webkit-transform: perspective(1px) translateZ(0);
            transform: perspective(1px) translateZ(0);
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: transform;
            transition-property: transform;
        }
        .hvr-grow:hover, .hvr-grow:focus, .hvr-grow:active {
            -webkit-transform: scale(1.01);
            transform: scale(1.01);
        }
    </style>
</head>
<body>
    <div>
        <main>
            @include('inc.navbar')
            @include('inc.messages')
            <div class="container mt-5 p-0" id="app">
                @yield('content')
            </div>
        </main>
    </div>
    @routes
    <script src="{{ asset('js/app.js') }}"></script>    
</body>
</html>