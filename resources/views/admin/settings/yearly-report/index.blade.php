@extends('layouts.dashboard.index')
@section('content')


@if($yearlyReport->type === 0)
<x-form title="Full Info: {{ $yearlyReport->getTypeTextAttribute() }}">
    <x-slot name="actions">
    </x-slot>

    <x-slot name="slot">

        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
            {{  $yearlyReport->category}}
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
@elseif ($yearlyReport->type === 1 || $yearlyReport->type === 2 || $yearlyReport->type === 3)
<x-form title="">
    <x-slot name="actions">

    </x-slot>

    <x-slot name="slot">

            <h6 class="text-sm mt-3 mb-3 px-4 font-bold uppercase">
                {{  $yearlyReport->category}}
            </h6>



            @if($yearlyReport->type === 1)
            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Completion Rate
            </h6>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Completters</x-label>
                        <x-input disabled value="{{ $decodedData['Completters'] }}" />
                    </div>
                </div>


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label for="section">Enrollment</x-label>
                        <x-input disabled value="{{ $decodedData['Enrollment'] }}"/>

                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Percent Cr</x-label>
                        <x-input disabled value="{{ $decodedData['Percent Cr'] }}"/>
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Year Level</x-label>
                        <x-input required value="{{ $yearlyReport->school_year }}" />

                    </div>
                </div>
            </div>
            @endif




            @if($yearlyReport->type === 2)

            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Promotion Rate
            </h6>
            <!-- Personal information form fields -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Promotes</x-label>
                        <x-input disabled value="{{ $decodedData['Promotes'] }}"/>
                    </div>
                </div>



                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label for="section">Enrollment</x-label>
                        <x-input disabled value="{{ $decodedData['Enrollment'] }}" />

                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Percent PR</x-label>
                        <x-input disabled value="{{ $decodedData['Percent PR'] }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Year Level</x-label>
                        <x-input disabled value="{{ $yearlyReport->school_year }}" />


                    </div>
                </div>
            </div>
            @endif




            @if($yearlyReport->type === 3)

            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Drop Out Rate
            </h6>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Drop Out</x-label>
                        <x-input disabled value="{{ $decodedData['Drop Out'] }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label for="section">Enrollment</x-label>
                        <x-input disabled value="{{ $decodedData['Enrollment'] }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Percent Dr</x-label>
                        <x-input disabled value="{{ $decodedData['Percent Dr'] }}" />
                    </div>
                </div>


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>School Year</x-label>
                        <x-input required value="{{ $yearlyReport->school_year }}" />

                    </div>
                </div>
            </div>

    @endif



    </x-slot>
</x-form>
@endif









@endsection
