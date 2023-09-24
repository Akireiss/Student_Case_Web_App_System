@extends('layouts.dashboard.index')
@section('content')
<div>
    <h6 class="text-xl font-bold text-left my-2 ">
       {{-- Report History --}}
    </h6>
    <div>
        <livewire:adviser.report-history-table/>
    </div>
</div>
@endsection

