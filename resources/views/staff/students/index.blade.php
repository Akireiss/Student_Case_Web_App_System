@extends('layouts.dashboard.index')

@section('content')

<h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
    Students
</h2>
<x-bread :breadcrumbs="[
    ['url' => url('adviser/dashboard'), 'label' => 'Adviser'],
    ['url' => url('adviser/students'), 'label' => 'Students'],
]"/>
<div class="flex justify-between items-center">
<div>

</div>
    <div>
        <x-link href="{{ url('adviser/students/' . auth()->user()->classroom->id) }}">Reffer</x-link>

    </div>
</div>

    <div>
     <livewire:adviser.student-table/>
 </div>

@endsection
