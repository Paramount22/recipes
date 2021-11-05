<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{body_class()}}">
    <div id="app">
        <div class="calendar">
            <div class="container">
                <i class="fas fa-calendar-alt mr-1"></i> @include('_partials.date')
            </div>

        </div>

        @include('layouts.navigation')
        <main class="py-4 container">
            <flash-success text="{{session('success')}}"></flash-success>
            <flash-warning text="{{session('warning')}}"></flash-warning>
            @yield('content')
        </main>

        <back-to-top></back-to-top>
    </div>

<footer>
    <p>Online recipes</p>
</footer>

    <script src="https://cdn.tiny.cloud/1/bxijhemwxy1rzpsjqk4ippn0csux1b2v7up5dzz6tkbfxyb3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#procedure',
        });
        /*tinymce.init({
            selector: '#comments-form',
        });*/
    </script>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>

