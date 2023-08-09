@extends('layouts.dashboard.index')

@section('content')
<h6 class="text-xl font-bold text-left ">
    Students
 </h6>
 <div>
     <livewire:adviser.student-table/>
 </div>

@endsection
