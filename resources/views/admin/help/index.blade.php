@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
            Users Manual
        </h2>
        @if (auth()->user()->role == 1)
        <x-bread :breadcrumbs="[
            ['url' => url('admin/dashboard'), 'label' => 'Admin'],
            ['url' => url('help'), 'label' => 'Settings'],
            ['url' => url('help'), 'label' => 'Users Manual'],
        ]"/>
        @endif
        @if (auth()->user()->role == 2)
        <x-bread :breadcrumbs="[
            ['url' => url('adviser/dashboard'), 'label' => 'Adviser'],
            ['url' => url('help'), 'label' => 'Settings'],
            ['url' => url('help'), 'label' => 'Users Manual'],
        ]"/>
        @endif

        @if (auth()->user()->role == 0)
        <x-bread :breadcrumbs="[
            ['url' => url('home'), 'label' => 'Users'],
            ['url' => url('help'), 'label' => 'Help'],
            ['url' => url('help'), 'label' => 'Users Manual'],
        ]"/>

        @endif

        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
            Ongoing...
        </h6>

        <x-modal/>

@endsection
