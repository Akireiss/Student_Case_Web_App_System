@extends('layouts.dashboard.index')
@section('content')
<x-form title="Generate Report">
    <x-slot name="actions">
    </x-slot>

    <x-slot name="slot">

        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
            Report Information
        </h6>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Grade Level</x-label>
                    <x-input />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label for="section">Section</x-label>
                    <x-input />

                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Adviser</x-label>
                    <x-input />
                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Status</x-label>
                    <x-input />
                </div>
            </div>
        </div>

    </x-slot>
</x-form>










@endsection
