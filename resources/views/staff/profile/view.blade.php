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
                        <x-input disabled value="{{ date('F d Y', strtotime($profile->birthdate)) }}" />

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
                        <x-input disabled value="{{ $profile->no_of_siblings}}" />
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
                        <x-input disabled value="4ps" />
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


                    @foreach ($profile->family as $familyMember)
                    @if ($familyMember->type === 'father')

                    <input type="hidden" value="father">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input disabled
                        value="{{ $familyMember->parent_name ?? 'No Data' }}"
                        />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_age ?? 'No Data' }}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_occupation ?? 'No Data' }}" />
                    </div>

                    <div x-data="{ phoneNumber: '' }" class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_contact ?? 'No Data' }}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input disabled vavalue="{{ $familyMember->parent_office_contact ?? 'No Data' }}" />
                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_monthly_income ?? 'No Data' }}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input disabled
                        value="{{ $familyMember->parent_birthplace ?? 'No Data' }}"
                         />
                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input disabled
                        value="{{ $familyMember->parent_work_address ?? 'No Data' }}"
                         />
                    </div>
                    @endif
                    @endforeach
                </x-grid>




                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Mother
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach ($profile->family as $familyMember)
                    @if ($familyMember->type === 'mother')

                    <input type="hidden" value="mother">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input disabled
                        value="{{ $familyMember->parent_name ?? 'No Data' }}"
                        />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_age ?? 'No Data' }}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_occupation ?? 'No Data' }}" />
                    </div>

                    <div x-data="{ phoneNumber: '' }" class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_contact ?? 'No Data' }}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input disabled vavalue="{{ $familyMember->parent_office_contact ?? 'No Data' }}" />
                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input disabled value="{{ $familyMember->parent_monthly_income ?? 'No Data' }}" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input disabled
                        value="{{ $familyMember->parent_birthplace ?? 'No Data' }}"
                         />
                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input disabled
                        value="{{ $familyMember->parent_work_address ?? 'No Data' }}"
                         />
                    </div>

                    @endif
                    @endforeach
                </x-grid>



                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        Siblings Information
                    </h6>

                    @if($profile->siblings->isNotEmpty())
                        @foreach($profile->siblings as $sibling)
                            <x-grid columns="3" gap="4" px="0" mt="0">
                                <div class="relative mb-3 px-4">
                                    <x-label for="name">
                                        Name
                                    </x-label>
                                    <x-input disabled :value="$sibling->sibling_name" />
                                </div>
                                <div class="relative mb-3 px-4">
                                    <x-label for="age">
                                        Age
                                    </x-label>
                                    <x-input disabled :value="$sibling->sibling_age" type="number" />
                                </div>
                                <div class="relative mb-3 px-4">
                                    <x-label for="grade_section">
                                        Grade and Section
                                    </x-label>
                                    <x-input disabled :value="$sibling->sibling_grade_section" />
                                </div>
                            </x-grid>
                        @endforeach
                    @else
                        <p>No sibling information found.</p>
                    @endif
                </div>





                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        You are currently living with:
                    </h6>
                    <x-grid columns="1 md:grid-cols-4" gap="4" px="0" mt="0">

                        <div class="relative mb-3 px-4">
                            <x-checkbox checked/>
                                <x-label class="inline-block"
                                for="living-with">{{ $profile->living_with }}</x-label>
                        </div>
                    </x-grid>
                </div>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                    Parent status are currently: (check which applies below)
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach($profile->parent_status as $status)
                        <div class="relative mb-3 px-4">
                            <input type="checkbox"
                            name="status[]" value="{{ $status->id }}"
                             {{ $status->parent_status ? 'checked' : '' }}>
                            <x-label class="inline-block">
                                {{ $status->parent_status }}
                            </x-label>
                        </div>
                    @endforeach
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
                        <x-input disabled value="{{ $profile->guardian_addresss}}" />
                    </div>

                </x-grid>



                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        Educational Background
                    </h6>

                    @if($profile->education->isNotEmpty())
                        @foreach($profile->education as $education)
                            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                                Grade Level: {{ $education->calculateGradeLevel() }}
                            </h6>

                            <x-grid columns="3" gap="4" px="0" mt="0">
                                <div class="relative mb-3 px-4">
                                    <x-label for="name">Name of school</x-label>
                                    <x-input disabled :value="$education->school_name" id="name" />
                                </div>

                                <div class="relative mb-3 px-4">
                                    <x-label for="section">Section</x-label>
                                    <x-input disabled :value="$education->grade_section" id="section" />
                                </div>

                                <div class="relative mb-3 px-4">
                                    <x-label for="school_year">School Year</x-label>
                                    <x-input disabled :value="$education->school_year" id="school_year" />
                                </div>
                            </x-grid>
                        @endforeach
                    @else
                        <p>No educational background found.</p>
                    @endif
                </div>



                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        Awards
                    </h6>

                    @if($profile->awards->isNotEmpty())
                        @foreach($profile->awards as $award)
                            <x-grid columns="2" gap="4" px="0" mt="0">
                                <div class="relative mb-3 px-4">
                                    <x-label>
                                        Name of Award
                                    </x-label>
                                    <x-input disabled :value="$award->award_name" />
                                </div>

                                <div class="relative mb-3 px-4">
                                    <x-label>
                                        Year Achieved
                                    </x-label>
                                    <x-input disabled :value="$award->award_year" type="number" />
                                </div>
                            </x-grid>
                        @endforeach
                    @else
                        <p>No awards found.</p>
                    @endif
                </div>




                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What is your favorite subject/s:
                        </x-label>
                        <x-input disabled value="{{ $profile->favorite_subject}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What subject do you find difficult
                        </x-label>
                        <x-input disabled value="{{ $profile->difficult_subject}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What school organizations are you afiliated?
                        </x-label>
                        <x-input disabled value="{{ $profile->school_organization}}" />
                    </div>
                </x-grid>

                <div>
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        What do you plan to do after graduating Senior High School?
                    </h6>
                    <x-grid columns="3" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <input type="checkbox" checked/>
                            <x-label class="inline-block">{{ $profile->graduation_plan}}</x-label>
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
                        <x-input disabled value="{{ $profile->height}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Weight
                        </x-label>
                        <x-input disabled value="{{ $profile->weight}}" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            BMI
                        </x-label>
                        <x-input disabled value="{{ $profile->bmi}}" />
                    </div>


                    <div>
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a disability?
                            </x-label>
                            <x-input disabled value="{{ $profile->disability}}" />
                        </div>



                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a food allergy?
                            </x-label>
                            <x-input disabled value="{{ $profile->food_allergy}}" />
                        </div>


                    </div>

                </x-grid>

                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                    Medicine taken in
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach($profile->medicines as $medicine)
                        <div class="relative mb-3 px-4">
                            <x-label for="medicine_{{ $loop->index + 1 }}">
                                {{ $loop->index + 1 }}
                            </x-label>
                            <x-input disabled :value="$medicine->medicine" />
                        </div>
                    @endforeach

                    @for ($i = count($profile->medicines) + 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="medicine_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled />
                        </div>
                    @endfor
                </x-grid>


                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                    Vitamins taken in
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach($profile->vitamins as $vitamin)
                        <div class="relative mb-3 px-4">
                            <x-label for="vitamin_{{ $loop->index + 1 }}">
                                {{ $loop->index + 1 }}
                            </x-label>
                            <x-input disabled :value="$vitamin->vitamins" />
                        </div>
                    @endforeach

                    @for ($i = count($profile->vitamins) + 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="vitamin_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled />
                        </div>
                    @endfor
                </x-grid>


                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                    Accidents experienced
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach($profile->accidents as $accident)
                        <div class="relative mb-3 px-4">
                            <x-label for="accident_{{ $loop->index + 1 }}">
                                {{ $loop->index + 1 }}
                            </x-label>
                            <x-input disabled :value="$accident->accidents" />
                        </div>
                    @endforeach

                    @for ($i = count($profile->accidents) + 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="accident_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled />
                        </div>
                    @endfor
                </x-grid>



                <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                    Operations experienced
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach($profile->operations as $operation)
                        <div class="relative mb-3 px-4">
                            <x-label for="operation_{{ $loop->index + 1 }}">
                                {{ $loop->index + 1 }}
                            </x-label>
                            <x-input disabled :value="$operation->operations" />
                        </div>
                    @endforeach

                    @for ($i = count($profile->operations) + 1; $i <= 3; $i++)
                        <div class="relative mb-3 px-4">
                            <x-label for="operation_{{ $i }}">
                                {{ $i }}
                            </x-label>
                            <x-input disabled />
                        </div>
                    @endfor
                </x-grid>


            </x-slot>
        </x-form>
    </div>
@endsection
