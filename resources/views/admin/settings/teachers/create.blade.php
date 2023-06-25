@extends('layouts.dashboard.index')
@section('content')
    <x-form title="Add Employee">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/teachers') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form action="{{ url('admin/settings/employee/store') }}" method="POST">

                @csrf

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Add New Employee
                </h6>

                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Employee Name</x-label>
                            <x-input type="text" name="employees" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Employee Number</x-label>
                            <x-input type="text" name="refference_number" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Status</x-label>
                            <x-select name="status">
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </x-select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button type="submit">Add</x-button>
                </div>
            </form>


            <!-- Add any additional sections or form fields here -->
        </x-slot>
    </x-form>
@endsection
