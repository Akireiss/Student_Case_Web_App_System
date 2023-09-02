<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CZCMNHS</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
    <script src="{{ asset('assets/js/validation.js') }}"></script>
{{--
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" /> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    @livewireStyles
</head>
<body>
