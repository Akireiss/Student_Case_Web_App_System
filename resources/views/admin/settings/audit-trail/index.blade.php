@extends('layouts.dashboard.index')
@section('content')


<div class="flex items-center justify-between my-2">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
{{-- Audit Trail --}}
    </h4>
    <div class="flex-grow flex justify-end">

    </div>
  </div>
<div>
    <livewire:activity-table/>
</div>
@endsection
