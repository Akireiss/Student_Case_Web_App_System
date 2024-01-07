<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CZCMNHS</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}


    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

@include('components.nav')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-5 mt-20">

    <div class="flex flex-col justify-center items-center space-y-4 md:text-left text-center md:px-44 ">
        <p class="text-lg md:text-xl uppercase tracking-wider text-gray-600 font-semibold">CASTOR Z. CONCEPCION MEMORIAL NATIONAL HIGH SCHOOL</p>
        <h1 class="text-left lg:text-4xl font-extrabold leading-tight  text-gray-700
        hover:text-gray-700">
            A Happy School,dsadsadasdsa
            Sustaining Excellence.
        </h1>
    </div>

    <div class="md:py-24 ">
        <img class="w-full md:w-1/2" src="{{ asset('assets/image/main.svg') }}" alt="School Image" />
    </div>
</div>


  @include('components.footer')

