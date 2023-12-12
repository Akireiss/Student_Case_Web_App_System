@extends('layouts.dashboard.index')
@section('content')

@if ($anecdotalRecords->isNotEmpty())



            <div class="w-full mx-auto mt-6">
                <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

                    <div class="flex justify-end">
                        <x-return onclick="window.history.back()">Back</x-return>
                    </div>
                        <div class="flex-auto px-6 py-2 lg:px-10  pt-0">
                        <h6 class="text-sm my-1  font-bold uppercase mb-1 ">
                            Recent Cases
                        </h6>

                        <h6 class="text-sm my-1  font-bold uppercase mb-2">
                            Student Name: {{ $students->first_name }} {{ $students->middle_name }} {{ $students->last_name }}
                        </h6>


                        @foreach ($anecdotalRecords as $anecdotal)
                        <x-grid columns="4" gap="4" px="0" mt="0">


                                <div class="relative mb-3">
                                    <x-label>
                                        Offense
                                    </x-label>
                                    <x-input type="text" name="offenses"
                                        value="{{ $anecdotal->offenses->offenses }}"
                                        disabled />
                                </div>
                                <div class="relative mb-3">
                                    <x-label>
                                        Gravity
                                    </x-label>
                                    <x-input type="text" name="offenses"
                                        value="{{ $anecdotal->getGravityTextAttribute() }}"
                                        disabled />
                                </div>
                                <div class="relative mb-3">
                                    <x-label>
                                        Case Status
                                    </x-label>
                                    <x-input type="text" name="offenses"
                                        value="{{ $anecdotal->student->getStatusTextAttribute() }}"
                                        disabled />
                                </div>
                                <div class="relative mb-3">
                                    <x-label>
                                        Date
                                    </x-label>
                                    <x-input type="text" name="offenses"
                                        value="{{ $anecdotal->created_at->format('F j, Y') }}"
                                        disabled />
                                </div>

                            </x-grid>
                            <hr>
                            @endforeach
                    </div>
                </div>
            </div>

            @else

            <div class="flex justify-center items-center mx-4 ">
                <p class="font-medium text-md text-gray-600 ">
                   No cases found
                </p>
            </div>
            @endif




@endsection


