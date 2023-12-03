@extends('layouts.dashboard.index')

@section('content')

<h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
    Report Student
</h2>
<x-bread :breadcrumbs="[
    ['url' => url('home'), 'label' => 'User'],
    ['url' => url('home'), 'label' => 'Report Student'],
]"/>

<livewire:student.report/>

@endsection
