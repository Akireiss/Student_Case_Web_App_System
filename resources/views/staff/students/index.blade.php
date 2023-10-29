@extends('layouts.dashboard.index')

@section('content')
<div class="flex justify-between items-center">

    <div>
        Table: Grade: {{ auth()->user()->classroom->grade_level }} {{ auth()->user()->classroom->section }} Students
    </div>
    <div>
        <x-link href="{{ url('adviser/students/reffer') }}">Reffer</x-link>
    </div>
</div>

    <div>
     <livewire:adviser.student-table/>
 </div>

@endsection
