@extends('layouts.dashboard.index')

@section('content')
<h6 class="text-xl font-bold text-left ">
    Grade:  {{ auth()->user()->classroom->grade_level }}  {{ auth()->user()->classroom->section }} Students
 </h6>
 <div>
     <livewire:adviser.student-table/>
 </div>

@endsection
