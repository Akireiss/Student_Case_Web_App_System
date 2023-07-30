@extends('layouts.dashboard.index')
@section('content')


<div class="flex items-center justify-between my-6">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
      Students Profile
    </h4>
    <div class="flex-grow flex justify-end">
      <x-link  href="{{ url('admin/student-profile/add')}}">
        Add
      </x-link>
    </div>
  </div>

<div>
    <livewire:student-profile-table/>
  </div>

@endsection


















