@extends('layouts.dashboard.index')
@section('content')
  {{-- Form --}}
  <x-form title="Grade: ">
    <x-slot name="actions">

        <x-link href="{{ url('admin/settings/classrooms') }}">
            Back
        </x-link>
    </x-slot>

    <x-slot name="slot">

        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
            Anecdotal Reports
        </h6>
        <!-- Personal information form fields -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    {{-- Label --}}
                    <x-label>Grade Level</x-label>
                    <x-input value="Grade: " disabled />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label for="section">Section</x-label>
                    <x-input value="" disabled />

                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Adviser</x-label>
                    <x-input value="" disabled/>
                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Status</x-label>
                    <x-input value="" disabled/>
                </div>
            </div>
        </div>

    </x-slot>
</x-form>
@endsection
