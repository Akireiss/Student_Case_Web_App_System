@extends('layouts.dashboard.index')
@section('content')
    <div>

        <x-form title="Student Profile">

            <x-slot name="actions">
                <x-link href="{{ url('adviser/students-profile') }}">
                    Back
                </x-link>
            </x-slot>
            <x-slot name="slot">
                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 ">
                    Personal Information
                </h6>


                <x-grid columns="3" gap="4" px="0" mt="0">


                    <div class="relative mb-3 px-4">
                        <x-label>
                            First Name
                        </x-label>
                        <x-input disabled value="{{ $profile->student->first_name}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Last Name
                        </x-label>
                        <x-input disabled  value="{{ $profile->student->last_name}}"/>
                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            Middle Name
                        </x-label>
                        <x-input disabled value="{{ $profile->m_name}}"/>
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Suffix
                        </x-label>
                        <x-input disabled  value="{{ $profile->suffix}}"/>
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Nickname
                        </x-label>
                        <x-input disabled value="{{ $profile->nickname}}" />
                    </div>




                    <div class="w-full px-4">

                        <div class="relative mb-3">
                            <x-label>
                                Age
                            </x-label>
                            <x-input disabled value="{{ $profile->age}}" />
                        </div>

                    </div>

                    <div class="w-full px-4">

                        <div class="relative mb-3">
                            <x-label>
                                Sex
                            </x-label>
                            <x-input disabled value="{{ $profile->sex}}" type="date" />
                        </div>

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Birthdate
                        </x-label>
                        <x-input disabled value="{{ $profile->birthdate}}" type="date" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contact Number
                        </x-label>
                        <x-input disabled value="{{ $profile->contact}}" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Birth Order
                        </x-label>
                        <x-input disabled value="{{ $profile->birth_order}}" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Number of Siblings
                        </x-label>
                        <x-input disabled value="{{ $profile->number_of_siblings}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Religion
                        </x-label>
                        <x-input disabled value="{{ $profile->religion}}" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            4Ps Receipient:
                        </x-label>
                        <x-input disabled value="{{ $profile->4ps}}" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Mother Tongue
                        </x-label>
                        <x-input disabled value="{{ $profile->mother_tongue}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of birth
                        </x-label>
                        <x-input disabled value="{{ $profile->place_of_birth}}" />

                    </div>

                </x-grid>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                    Address
                </h6>


                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>Province</x-label>
                        <x-input disabled value="{{ $profile->province->province}}" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>Municipality</x-label>
                        <x-input disabled value="{{ $profile->municipal->municipality}}" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>Barangay</x-label>
                        <x-input disabled value="{{ $profile->barangay->barangay}}" />

                    </div>
                </x-grid>


                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Family Background
                </h6>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Father
                </h6>



                <x-grid columns="3" gap="4" px="0" mt="0">


                    <input type="hidden" value="father">



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input disabled value="" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div x-data="{ phoneNumber: '' }" class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                </x-grid>


                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                </x-grid>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Mother
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">

                    <input type="hidden" value="mother">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contaact No.
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                </x-grid>

                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                </x-grid>


                {{-- //need loop here --}}
                <div>

                    <template x-for="(sibling, index) in siblings" :key="index">
                        <x-grid columns="3" gap="4" px="0" mt="0">
                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Name
                                </x-label>
                                <x-input disabled value="{{ $profile->}}" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Age
                                </x-label>
                                <x-input disabled value="{{ $profile->}}" type="number" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Grade and Section
                                </x-label>
                                <x-input disabled value="{{ $profile->}}" />
                            </div>
                        </x-grid>
                    </template>
                </div>





                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        You are currently living with:
                    </h6>
                    <x-grid columns="1 md:grid-cols-4" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-checkbox
                                name="living-with
                                    />
                                <x-label class="inline-block"
                                for="living-with" value="Both Parents" />
                        </div>
                    </x-grid>
                </div>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                    Parent are currently: (check which applies below)
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block">
                            together
                        </x-label>
                    </div>

                </x-grid>




                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Guardian's Name
                        </x-label>
                        <x-input disabled value="{{ $profile->guardian_name}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Relationship with the guardian
                        </x-label>
                        <x-input disabled value="{{ $profile->guardian_relationship}}" />
                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input disabled value="{{ $profile->guardian_contact}}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input disabled value="{{ $profile->guardian_age}}" type="number" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Addresss
                        </x-label>
                        <x-input disabled value="{{ $profile->guardian_address}}" />
                    </div>

                </x-grid>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Educational Background
                </h6>


                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Grade
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                    <div class="relative mb-3 px-4">
                        <x-label for="name">Name of school</x-label>
                        <x-input disabled value="{{ $profile->}}" id="name" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label for="section">Section</x-label>
                        <x-input disabled value="{{ $profile->}}" id="section" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label for="school_year">School Year</x-label>
                        <x-input disabled value="{{ $profile->}}" id="school_year" />
                    </div>
                </x-grid>



                <div>

                    <template>
                        <x-grid columns="2" gap="4" px="0" mt="0"
                            x-show="index === 0 || rewards.length > 1">
                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Name of Award
                                </x-label>
                                <x-input disabled value="{{ $profile->}}" x-model="reward.name" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Year Achieved
                                </x-label>
                                <x-input disabled value="{{ $profile->}}" x-model="reward.year" type="number" />
                            </div>
                        </x-grid>
                    </template>
                </div>


                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What is your favorite subject/s:
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What subject do you find difficult
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What school organizations are you afiliated?
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>
                </x-grid>

                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        What do you plan to do after graduating Senior High School?
                    </h6>
                    <x-grid columns="3" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <input type="radio" />
                            <x-label class="inline-block">Go to College</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" />
                            <x-label class="inline-block">Work as a skilled worker</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" />
                            <x-label class="inline-block">Pursue TESDA certificates</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" />
                            <x-label class="inline-block">Engage in Business</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" />
                            <x-label class="inline-block">Work to help parents</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" />
                            <x-label class="inline-block">Undecided</x-label>
                        </div>
                    </x-grid>
                </div>




                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-5 ">
                    Additional Information
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Height
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Weight
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            BMI
                        </x-label>
                        <x-input disabled value="{{ $profile->}}" />
                    </div>


                    <div>
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a disability?
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                If yes, what is it?
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a food allergy?
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                If yes, what is your food allergy?
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" />
                        </div>
                    </div>




                </x-grid>

                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                    Medicine taken in
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="medicine_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" />
                        </div>
                    @endfor
                </x-grid>



                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                    Vitamins taken in
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="vitamin_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" />
                        </div>
                    @endfor
                </x-grid>

                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500 ">
                    Accidents experienced
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="accident_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" id="accidents_{{ $i }}" />
                        </div>
                    @endfor
                </x-grid>


                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500 ">
                    Operations experienced
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="operation_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled value="{{ $profile->}}" id="operations_{{ $i }}" />
                        </div>
                    @endfor
                </x-grid>

            </x-slot>
        </x-form>
    </div>
@endsection
