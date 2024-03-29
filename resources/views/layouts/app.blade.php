<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a6e7161fb1.js" crossorigin="anonymous"></script>

    <link href="{{ asset('css/sharedtodo.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        @component('components.header')
        @endcomponent
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('/js/sharedtodo.js') }}"></script>
</body>

</html>