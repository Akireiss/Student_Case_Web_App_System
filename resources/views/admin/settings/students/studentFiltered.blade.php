@extends('layouts.dashboard.index')

@section('content')
<div>
    <div class="flex justify-end mt-4 space-x-2">
    @if (request()->routeIs('admin.settings.students.filtered.male'))
    <a class="hover:bg-gray-100 border border-gray-300 p-2 bg-gray-50  rounded-md shadow-sm text-gray-800 flex items-center"  href="{{ url('admin/settings/students') }}">
        Default <span class="ml-1">
            <svg xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>

        </span>
    </a>
    @endif
    @if (request()->routeIs('admin.settings.students.filtered.female'))
    <a class="hover:bg-gray-100 border border-gray-300 p-2 bg-gray-50  rounded-md shadow-sm text-gray-800 flex items-center"  href="{{ url('admin/settings/students') }}">
        Default <span class="ml-1">
            <svg xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>

        </span>
    </a>
    @endif
    @if (request()->routeIs('admin.settings.students.filtered.active'))
    <a class="hover:bg-gray-100 border border-gray-300 p-2 bg-gray-50  rounded-md shadow-sm text-gray-800 flex items-center"  href="{{ url('admin/settings/students') }}">
        Default <span class="ml-1">
            <svg xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>

        </span>
    </a>
    @endif

    </div>

    @if (request()->routeIs('admin.settings.students.filtered.male'))
    <livewire:admin.student.filtered-student-table.male-students-table />
    @endif
    {{-- Female --}}
    @if (request()->routeIs('admin.settings.students.filtered.female'))
    {{-- <livewire:student-table /> --}}
    <livewire:admin.student.filtered-student-table.female-students-table />

    @endif
    @if (request()->routeIs('admin.settings.students.filtered.active'))
    {{-- <livewire:student-table /> --}}
    <livewire:admin.student.filtered-student-table.active-students-table />

    @endif
</div>

@endsection
