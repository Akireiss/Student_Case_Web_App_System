@extends('layouts.dashboard.index')
@section('content')
<div>


            <div class="flex items-center justify-between my-2">
                <h6 class="text-lg font-semibold
                  text-gray-600 dark:text-gray-300 flex-shrink-0">
                    {{-- List Of Reports --}}
                </h6>
                <div class="flex justify-end">
                    <x-link href="{{ url('admin/reports/create') }}">
                        Add
                    </x-link>
                </div>
            </div>
            <div>
                <livewire:anecdota-table />
            </div>
        </div>


</div>


@endsection
