@extends('layouts.dashboard.index')
@section('content')
<div>




    <div>
        <h6 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
            {{-- List Of Reports --}}
        </h6>
        <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
            Reports
        </h2>
        <x-bread :breadcrumbs="[
            ['url' => url('admin/dashboard'), 'label' => 'Admin'],
            ['url' => url('admin/reports'), 'label' => 'Reports'],
        ]"/>
        @if (request()->routeIs('admin.reports'))

        <div class="flex mb-2 items-center">
            <div>

            </div>

            <h6 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
                {{-- List Of Reports --}}
            </h6>

            <div class="ml-auto">
                <x-link href="{{ url('admin/reports/create') }}">
                    Add
                </x-link>
            </div>
        </div>


        @endif

        @if (!request()->routeIs('admin.reports'))
            <div class="flex justify-end">
                <a class="hover:bg-gray-100 border border-gray-300 p-2 bg-gray-50  rounded-md shadow-sm text-gray-800 flex items-center" href="{{ url('admin/reports') }}">
                    Default <span class="ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>

                    </span>
                </a>
            </div>
        @endif
    </div>


            <div>
                {{-- AllCases --}}
                @if (request()->routeIs('admin.reports'))
                <livewire:anecdota-table/>
                @endif
                {{-- Pending --}}
                @if (request()->routeIs('admin.reports.pending'))
                <livewire:admin.student-tables.pending-cases-table/>
                @endif
                {{-- Ongoing --}}
                @if (request()->routeIs('admin.reports.ongoing'))
                <livewire:admin.student-tables.ongoing-cases-table/>
                @endif
                {{-- Resolved --}}
                @if (request()->routeIs('admin.reports.resolved'))
                <livewire:admin.student-tables.resolved-cases-table/>
                @endif
                {{-- Male and female --}}
                @if (request()->routeIs('admin.reports.male'))
                <livewire:admin.student-tables.male-cases-table/>
                @endif

                @if (request()->routeIs('admin.reports.female'))
                <livewire:admin.student-tables.female-cases-table/>
                @endif

            </div>
        </div>


</div>


@endsection
