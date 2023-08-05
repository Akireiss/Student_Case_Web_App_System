@extends('layouts.dashboard.index')
@section('content')

<x-alert/>
<div class="flex items-center justify-between my-6">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
Classrooms
    </h4>
    <div class="flex-grow flex justify-end">
        <x-link href="{{ url('admin/settings/classroom/create') }}">
        Add
        </x-link>
    </div>
  </div>



<div>
    <livewire:classroom-table/>
</div>

@endsection
