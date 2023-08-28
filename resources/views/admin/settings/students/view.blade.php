@extends('layouts.dashboard.index')

@section('content')

<x-form title="Student">
    <x-slot name="actions">
        <x-link href="{{ url('admin/settings/students') }}">
            Back
        </x-link>
    </x-slot>

        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
            Student Information
        </h6>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>First Name</x-label>
                    <x-input type="text" name="first_name"
                    value="{{ $students->first_name }}"
                    disabled />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Middle Name</x-label>
                    <x-input type="text" name="middle_name"  disabled
                    value="{{ $students->middle_name }}"
                    />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Last Name</x-label>
                    <x-input type="text" name="last_name" value="{{ $students->last_name }}"
                     disabled />
                </div>
            </div>



            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Learners Reference Number</x-label>
                    <x-input type="number" name="lrn" value="{{ $students->lrn }}"
                    disabled />
                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Classroom</x-label>
                    <x-input disabled value="Grade: {{ $students->classroom->grade_level }} {{ $students->classroom->section }}"/>
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Status</x-label>
                    <x-input disabled value="{{ $students->getStatusTextAttribute() }}"/>
                </div>
            </div>
        </div>
</x-form>
@endsection
