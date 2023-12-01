@extends('layouts.dashboard.index')

@section('content')
<div>
    <div class="flex justify-end mt-4 space-x-2">
    @if (request()->routeIs('admin.settings.students.filtered.male'))
    <x-link href="{{ url('admin/settings/students') }}">
        Back To Defult

    </x-link>
    @endif
    @if (request()->routeIs('admin.settings.students.filtered.female'))
    <x-link href="{{ url('admin/settings/students') }}">
      Back To Defult
    </x-link>
    @endif
    @if (request()->routeIs('admin.settings.students.filtered.active'))
    <x-link href="{{ url('admin/settings/students') }}">
       Back To Defult
    </x-link>
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
