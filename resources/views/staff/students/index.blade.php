@extends('layouts.dashboard.index')

@section('content')
<div>
    Table: Grade:  {{ auth()->user()->classroom->grade_level }}  {{ auth()->user()->classroom->section }} Students
 </div>
 <div>
     <livewire:adviser.student-table/>
 </div>

@endsection
