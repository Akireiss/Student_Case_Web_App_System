@extends('layouts.dashboard.index')
@section('content')

    <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
       {{-- Students Profile --}}
    </h2>
    <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
        Students Profile
    </h2>
    <x-bread :breadcrumbs="[
        ['url' => url('admin/dashboard'), 'label' => 'Admin'],
        ['url' => url('admin/student-profile'), 'label' => 'Students Profile'],
    ]"/>
    <div class="flex mb-2 items-center">
        <div>

        </div>
        <div class="ml-auto">

        <x-link href="{{ url('admin/student-profile/add')}}">
            Add
        </x-link>
        </div>
</div>


<div>
    <livewire:student-profile-table/>
</div>
@endsection

















