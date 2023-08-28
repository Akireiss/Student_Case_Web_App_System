@extends('layouts.dashboard.index')
@section('content')
<div>
    <x-form title="Teacher Information">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/teachers') }}">
                Back
            </x-link>
        </x-slot>
            <x-slot name="slot">


                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Teacher Information
                    </h6>

                    <!-- Personal information form fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Employee Name</x-label>
                                <x-input type="text" name="employees"
                                       disabled value="{{ $employee->employees }}"
                                />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Employee Number</x-label>
                                <x-input type="text" name="refference_number"
                               disabled value="{{ $employee->refference_number }}"
                                />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Status</x-label>
                               <x-input type="text"  disabled value="{{ $employee->refference_number }}" />

                            </div>
                        </div>
                    </div>



            </x-slot>
    </x-form>


</div>


@endsection
