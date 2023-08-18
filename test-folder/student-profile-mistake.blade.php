<div>

    <x-form title="Student Profile">

        @if (auth()->user()->role == 2)
            {
            <x-slot name="actions">
                <x-link href="{{ url('adviser/students-profile') }}">
                    Back
                </x-link>
            </x-slot>
            }
        @endif

        @if (auth()->user()->role == 1)
            {
            <x-slot name="actions">
                <x-link href="{{ url('admin/student-profile') }}">
                    Back
                </x-link>
            </x-slot>
            }
        @endif

        <x-slot name="slot">
            <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 ">
                Personal Information
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">


                <div class="relative mb-3 px-4">
                    <x-label>
                        First Name
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->student->first_name }}" />
                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                        Last Name
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->student->last_name }}" />
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Middle Name
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->m_name }}" wire:model="m_name" />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Suffix
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->suffix }}" />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Nickname
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->nickname }}" />
                </div>




                <div class="w-full px-4">

                    <div class="relative mb-3">
                        <x-label>
                            Age
                        </x-label>
                        <x-input wire:model="" value="{{ $profile->age }}" />
                    </div>

                </div>

                <div class="w-full px-4">

                    <div class="relative mb-3">
                        <x-label>
                            Sex
                        </x-label>
                        <x-select>
                            <option value="Male" {{ $profile->sex === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $profile->sex === 'Female' ? 'selected' : '' }}>Female</option>
                        </x-select>
                    </div>
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Birthdate
                    </x-label>
                    <x-input wire:model="" type="date" value="{{ $profile->birthdate }}"/>
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Contact Number
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->contact }}" />
                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                        Birth Order
                    </x-label>
                    <x-select>
                        <option value="Eldest" {{ $profile->birth_order === 'Eldest' ? 'selected' : '' }}>Eldest</option>
                        <option value="Middle" {{ $profile->birth_order === 'Middle' ? 'selected' : '' }}>Middle</option>
                        <option value="Youngest" {{ $profile->birth_order === 'Youngest' ? 'selected' : '' }}>Youngest</option>
                    </x-select>
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Number of Siblings
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->no_of_siblings }}" />
                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                        Religion
                    </x-label>
                    <x-input wire:model="" value="{{ $profile->religion }}" />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        4Ps Recipient:
                    </x-label>
                    <x-select>
                        <option value="Yes" {{ $profile->four_ps === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $profile->four_ps === 'No' ? 'selected' : '' }}>No</option>
                    </x-select>
                    <x-error fieldName="four_ps" />
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>Mother Tongue</x-label>
                    <x-input  wire:model="mother_tongue" />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>Place of Birth</x-label>
                    <x-input  wire:model="birth_place" />
                </div>


            </x-grid>


            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                Address
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>Province</x-label>
                    <x-select wire:model="selectedCity">
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->province }}</option>
                        @endforeach
                    </x-select>

                </div>

                <div class="relative mb-3 px-4">
                    <x-label>Municipality</x-label>
                    <x-select wire:model="selectedMunicipality">
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->id }}">{{ $municipality->municipality }}</option>
                        @endforeach
                    </x-select>

                </div>

                <div class="relative mb-3 px-4">
                    <x-label>Barangay</x-label>
                    <x-select wire:model="selectedBarangay">
                        @foreach ($barangays as $barangay)
                            <option value="{{ $barangay->id }}">
                                {{ $barangay->barangay }}</option>
                        @endforeach
                    </x-select>

                </div>
            </x-grid>

            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Family Background
            </h6>



            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Father
            </h6>

            <x-grid columns="3" gap="4" px="0" mt="0">
                @if ($profile->family)
                    @foreach ($profile->family as $familyMember)
                        @if ($familyMember->type === 0)
                            <input type="hidden" value="father">

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Name
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_name ?? 'No Data' }}" />
                            </div>



                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Age
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_age ?? 'No Data' }}" />
                            </div>


                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Occupation
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_occupation ?? 'No Data' }}" />
                            </div>

                            <div x-data="{ phoneNumber: '' }" class="relative mb-3 px-4">
                                <x-label>
                                    Contact No.
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_contact ?? 'No Data' }}" />
                            </div>


                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Office Contact No.
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_office_contact ?? 'No Data' }}" />
                            </div>
                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Monthly Income
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_monthly_income ?? 'No Data' }}" />
                            </div>


                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Place of Birth
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_birth_place ?? 'No Data' }}" />
                            </div>
                            <div class="relative mb-3 px-4">
                                Place of Work

                                <x-input wire:model="" value="{{ $familyMember->parent_work_address ?? 'No Data' }}" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <!-- Handle case when there are no parents -->
                    <p>No parents found.</p>
                @endif
            </x-grid>








            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Mother
            </h6>

            <x-grid columns="3" gap="4" px="0" mt="0">
                @if ($profile->family)
                    @foreach ($profile->family as $familyMember)
                        @if ($familyMember->type === 1)
                            <input type="hidden" value="mother">

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Name
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_name ?? 'No Data' }}" />
                            </div>



                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Age
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_age ?? 'No Data' }}" />
                            </div>


                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Occupation
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_occupation ?? 'No Data' }}" />
                            </div>

                            <div x-data="{ phoneNumber: '' }" class="relative mb-3 px-4">
                                <x-label>
                                    Contact No.
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_contact ?? 'No Data' }}" />
                            </div>


                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Office Contact No.
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_office_contact ?? 'No Data' }}" />
                            </div>
                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Monthly Income
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_monthly_income ?? 'No Data' }}" />
                            </div>


                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Place of Birth
                                </x-label>
                                <x-input wire:model="" value="{{ $familyMember->parent_birth_place ?? 'No Data' }}" />
                            </div>
                            <div class="relative mb-3 px-4">
                                Place of Work

                                <x-input wire:model="" value="{{ $familyMember->parent_work_address ?? 'No Data' }}" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <!-- Handle case when there are no parents -->
                    <p>No parents found.</p>
                @endif
            </x-grid>




            <div>
                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                    Siblings Information
                </h6>

                @if ($profile->siblings->isNotEmpty())
                    @foreach ($profile->siblings as $sibling)
                        <x-grid columns="3" gap="4" px="0" mt="0">
                            <div class="relative mb-3 px-4">
                                <x-label for="name">
                                    Name
                                </x-label>
                                <x-input wire:model="" :value="$sibling->sibling_name" />
                            </div>
                            <div class="relative mb-3 px-4">
                                <x-label for="age">
                                    Age
                                </x-label>
                                <x-input wire:model="" :value="$sibling->sibling_age" type="number" />
                            </div>
                            <div class="relative mb-3 px-4">
                                <x-label for="grade_section">
                                    Grade and Section
                                </x-label>
                                <x-input wire:model="" :value="$sibling->sibling_grade_section" />
                            </div>
                        </x-grid>
                    @endforeach
                @else
                    <div class="px-4">
                        <x-input wire:model="" placeholder="No Data" />
                @endif
            </div>
</div>

<div class="px-4">
    <div x-data="{ livingWith: '{{ $profile->living_with }}' }">
        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
            You are currently living with:
            <x-error fieldName="living_with" />
        </h6>
        <x-grid columns="4" gap="4" px="4" mt="2">
            @foreach(['both-parents', 'father-only', 'mother-only', 'na'] as $arrangement)
                <div class="relative mb-3">
                    <input type="radio" name="living-with" wire:model="living_with" value="{{ $arrangement }}"
                        x-bind:checked="livingWith === '{{ $arrangement }}'" />
                    <label class="inline-block" for="living-with">{{ ucwords(str_replace('-', ' ', $arrangement)) }}</label>
                </div>
            @endforeach
        </x-grid>
    </div>




    <div>
        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
            Parent Status: check which applies
        </h6>

        <x-grid columns="4" gap="4" px="4" mt="2">
            @foreach(['Living Together', 'Separated', 'Legally Separated', 'With another partner', 'Father is OFW', 'Mother is OFW'] as $status)
                <div class="relative mb-3">
                    <input type="checkbox"
                        name="parent_status[]"
                        wire:model="parentStatuses"
                        value="{{ $status }}"
                        {{ in_array($status, $parentStatuses)}}
                    />
                    <label class="inline-block" for="{{ $status }}">{{ $status }}</label>
                </div>
            @endforeach
        </x-grid>
    </div>


<h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
    Guardian Information
</h6>
<x-grid columns="3" gap="4" px="0" mt="0">

    <div class="relative mb-3 px-4">
        <x-label>
            Guardian's Name
        </x-label>
        <x-input wire:model="" value="{{ $profile->guardian_name }}" />
    </div>


    <div class="relative mb-3 px-4">
        <x-label>
            Relationship with the guardian
        </x-label>
        <x-input wire:model="" value="{{ $profile->guardian_relationship }}" />
    </div>




    <div class="relative mb-3 px-4">
        <x-label>
            Contact No.
        </x-label>
        <x-input wire:model="" value="{{ $profile->guardian_contact }}" />
    </div>


    <div class="relative mb-3 px-4">
        <x-label>
            Age
        </x-label>
        <x-input wire:model="" value="{{ $profile->guardian_age }}" type="number" />
    </div>



    <div class="relative mb-3 px-4">
        <x-label>
            Addresss
        </x-label>
        <x-input wire:model="" value="{{ $profile->guardian_address }}" />
    </div>

</x-grid>



<div>

    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
        Educational Background
    </h6>

    @if ($profile->education->isNotEmpty())
        @php
            $sortedEducation = $profile->education->sortBy('school_year');
            $baseGrade = 7;
        @endphp

        @foreach ($sortedEducation as $education)
            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                Grade Level: {{ $baseGrade }}
            </h6>

            <x-grid columns="3" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-label for="name">Name of school</x-label>
                    <x-input wire:model="" :value="$education->school_name" id="name" />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label for="section">Section</x-label>
                    <x-input wire:model="" :value="$education->grade_section" id="section" />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label for="school_year">School Year</x-label>
                    <x-input wire:model="" :value="$education->school_year" id="school_year" />
                </div>
            </x-grid>

            @php
                $baseGrade++;
            @endphp
        @endforeach
    @else
        <div class="px-4">
            <x-input wire:model="" value="No Data" />
        </div>
    @endif



    <div>
        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
            Awards
        </h6>

        @if ($profile->awards->isNotEmpty())
            @foreach ($profile->awards as $award)
                <x-grid columns="2" gap="4" px="0" mt="0">
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name of Award
                        </x-label>
                        <x-input wire:model="" :value="$award->award_name" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Year Achieved
                        </x-label>
                        <x-input wire:model="" :value="$award->award_year" type="number" />
                    </div>
                </x-grid>
            @endforeach
        @else
            <div class="px-4 py-2">
                <x-input wire:model="" value="No Data" />
            </div>
        @endif
    </div>




    <x-grid columns="3" gap="4" px="0" mt="0">

        <div class="relative mb-3 px-4">
            <x-label>
                What is your favorite subject/s:
            </x-label>
            <x-input wire:model="" value="{{ $profile->favorite_subject }}" />
        </div>

        <div class="relative mb-3 px-4">
            <x-label>
                What subject do you find difficult
            </x-label>
            <x-input wire:model="" value="{{ $profile->difficult_subject }}" />
        </div>

        <div class="relative mb-3 px-4">
            <x-label>
                What school organizations are you afiliated?
            </x-label>
            <x-input wire:model="" value="{{ $profile->school_organization }}" />
        </div>
    </x-grid>

    <div>
        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
            What do you plan to do after graduating Senior High School?
        </h6>
        <x-grid columns="3" gap="4" px="0" mt="0">
            <div class="relative mb-3 px-4">
                <input type="checkbox" checked />
                <x-label class="inline-block">{{ $profile->graduation_plan }}</x-label>
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
            <x-input wire:model="" value="{{ $profile->height }}" />
        </div>

        <div class="relative mb-3 px-4">
            <x-label>
                Weight
            </x-label>
            <x-input wire:model="" value="{{ $profile->weight }}" />
        </div>

        <div class="relative mb-3 px-4">
            <x-label>
                BMI
            </x-label>
            <x-input wire:model="" value="{{ $profile->bmi }}" />
        </div>

        <div class="relative mb-3 px-4">
            <x-label>
                Disability
            </x-label>
            <p class="text-sm text-gray-600">If you have a disability, please type it here.</p>
            <x-input wire:model="" value="{{ $profile->disability }}" />
        </div>


        <div class="relative mb-3 px-4">
            <x-label>
                Food Allergy
                </x-label>
            <p class="text-sm text-gray-600">If you have a food allergy, please type it here.</p>
            <x-input wire:model="" value="{{ $profile->food_allergy }}" />
        </div>
    </x-grid>



    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
        Medicine taken in
    </h6>
    <x-grid columns="3" gap="4" px="0" mt="0">
        @if ($profile->medicines->isEmpty())
            <div class="px-4 py-2">
                <x-input wire:model="" value="No Data" />
            </div>
        @else
            @foreach ($profile->medicines as $medicine)
                <div class="relative mb-3 px-4">
                    <x-input wire:model="" value="{{ $medicine->medicine }}" />
                </div>
            @endforeach
        @endif
    </x-grid>





    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
        Vitamins taken in
    </h6>

    <x-grid columns="3" gap="4" px="0" mt="0">
        @if ($profile->vitamins->isNotEmpty())
            @foreach ($profile->vitamins as $vitamin)
                <div class="relative mb-3 px-4">
                    <x-input wire:model="" :value="$vitamin->vitamins" />
                </div>
            @endforeach
        @else
            <div class="px-4 py-2">
                <x-input wire:model="" value="No Data" />
            </div>
        @endif
    </x-grid>


    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
        Accidents experienced
    </h6>

    <x-grid columns="3" gap="4" px="0" mt="0">
        @if ($profile->accidents->isNotEmpty())
            @foreach ($profile->accidents as $accident)
                <div class="relative mb-3 px-4">
                    <x-input wire:model="" value="{{ $accident->accidents }}" />
                </div>
            @endforeach
        @else
            <div class="px-4 py-2">
                <x-input wire:model="" value="No Data" />
            </div>
        @endif
    </x-grid>



    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
        Operations experienced
    </h6>

    <x-grid columns="3" gap="4" px="0" mt="0">
        @if ($profile->operations->isNotEmpty())
            @foreach ($profile->operations as $operation)
                <div class="relative mb-3 px-4">
                    <x-input wire:model="" value="{{ $operation->operations }}" />
                </div>
            @endforeach
        @else
            <div class="px-4 py-2">
                <x-input wire:model="" value="No Data" />
            </div>
        @endif
    </x-grid>



    </x-slot>
    </x-form>




</div>
</div>
