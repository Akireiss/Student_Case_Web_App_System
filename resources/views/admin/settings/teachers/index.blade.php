@extends('layouts.dashboard.index')
@section('content')

<x-alert/>
<div class="flex items-center justify-between my-6">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
     Employees
    </h4>
    <div class="flex-grow flex justify-end">

        <x-link href="{{ url('admin/settings/teacher/create') }}">
            Add
              </x-link>
    </div>
  </div>



  <div>
    <livewire:employee-table/>
  </div>



@endsection
