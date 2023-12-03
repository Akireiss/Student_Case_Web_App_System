@extends('layouts.dashboard.index')
@section('content')
<div>

    <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
        Report History
       </h2>

       @if (auth()->user()->role == 2)

       <x-bread :breadcrumbs="[
           ['url' => url('adviser/dashboard'), 'label' => 'Adviser'],
           ['url' => url('adviser/report/history'), 'label' => 'Report History'],
       ]"/>
       @endif
       @if (auth()->user()->role == 1)
       <x-bread :breadcrumbs="[
        ['url' => url('admin/dashboard'), 'label' => 'Admin'],
        ['url' => url('admin/settings/report/history'), 'label' => 'Report History'],
    ]"/>
       @endif

       @if (auth()->user()->role == 0)
       <x-bread :breadcrumbs="[
        ['url' => url('home'), 'label' => 'User'],
        ['url' => url('report/history'), 'label' => 'Report History'],
    ]"/>
       @endif




<div class="flex items-center justify-between mb-2">
    <h6 class="text-xl font-bold text-left mb-2 ">
       {{-- Report History --}}
    </h6>
</div>

    <div>
        <livewire:adviser.report-history-table/>
    </div>
</div>
@endsection

