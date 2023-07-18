<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <title>CZCMNHS</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <main class="">
        @yield('content')
    </main>
    <x-footer />

    </div>

</body>

</html>
