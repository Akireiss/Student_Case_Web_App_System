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

            @can('admin-access')
            <div class="flex flex-col items-center">
                <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">Download the guide by clicking here.</h2>

            <x-link class="bg-red-500 hover:bg-red-600" href="{{ route('admin.download.pdf') }}">Download PDF</x-link>
        </div>
            @endcan


            @can('adviser-access')
            <div class="flex flex-col items-center">
                <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">Download the guide by clicking here.</h2>
<x-link   class="bg-red-500 hover:bg-red-600" href="{{ route('adviser.download.pdf') }}">Download PDF</x-link>
            </div>
@endcan

@can('user-access')
<div class="flex flex-col items-center">
    <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">Download the guide by clicking here.</h2>
<x-link  class="bg-red-500 hover:bg-red-600" href="{{ route('user.download.pdf') }}">Download PDF</x-link>
</div>
@endcan



@endsection
