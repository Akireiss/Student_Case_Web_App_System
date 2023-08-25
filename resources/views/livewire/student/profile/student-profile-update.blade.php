<div>
    <x-form title="">

        <x-slot name="actions">
            <x-link a href="{{ url('student/form') }}">Back</x-link>
        </x-slot>
        <x-slot name="slot">
            <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 ">
                Personal Information
            </h6>

            <form wire:submit.prevent="updateProfile">
                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="w-full px-4">
                        <div x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
                            <x-label for="studentName">
                                First Name
                            </x-label>
                            <div class="relative">
                                <x-input wire:model.debounce.300ms="studentName" @focus="isOpen = true"
                                    @click.away="isOpen = false" @keydown.escape="isOpen = false"
                                    @keydown="isOpen = true" type="text" id="studentName" name="studentName"
                                    placeholder="Start typing to search." />
                                <x-error fieldName="studentName" />
                                <x-error fieldName="studentId" />

                                <span x-show="studentName !== ''" @click="studentName = ''; isOpen = false"
                                    class="absolute right-3 top-2 cursor-pointer text-red-600 font-bold">
                                    &times;
                                </span>
                                @if ($studentName && count($students) > 0)
                                    <ul class="bg-white border border-gray-300 mt-2 rounded-md w-full max-h-48 overflow-auto absolute z-10"
                                        x-show="isOpen">
                                        @foreach ($students as $student)
                                            <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                                                wire:click="selectStudent('{{ $student->id }}', '{{ $student->first_name }}')"
                                                x-on:click="isOpen = false">
                                                {{ $student->first_name }} {{ $student->last_name }}
                                            </li>
                                        @endforeach
                                    @elseif ($studentName)
                                        <span class="text-red-500 text-sm">
                                            No Student Found
                                        </span>
                                    </ul>
                                @endif
                            </div>
                            <input type="hidden" name="studentId" wire:model="studentId">
                        </div>
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Last Name
                        </x-label>
                        <x-input wire:model="last_name" readonly />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Middle Name
                        </x-label>
                        <x-input wire:model="middle_name" />
                        <x-error fieldName="m_name" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Suffix
                        </x-label>
                        <x-input wire:model="suffix" />
                        <x-error fieldName="suffix" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Nickname
                        </x-label>
                        <x-input wire:model="nickname" />
                        <x-error fieldName="nickname" />

                    </div>




                    <div class="w-full px-4">

                        <div class="relative mb-3">
                            <x-label>
                                Age
                            </x-label>
                            <x-input wire:model="age" type="number" />
                            <x-error fieldName="age" />

                        </div>

                    </div>

                    <div class="w-full px-4">

                        <div class="relative mb-3">
                            <x-label>
                                Sex
                            </x-label>
                            <x-select wire:model="sex">
                                <option>Male</option>
                                <option>Female</option>
                            </x-select>
                            <x-error fieldName="sex" />

                        </div>

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Birthdate
                        </x-label>
                        <x-input wire:model="birthdate" type="date" />
                        <x-error fieldName="birthdate" />
                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contact Number
                        </x-label>
                        <x-input wire:model="contact" />
                        <x-error fieldName="contact" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Birth Order
                        </x-label>
                        <x-select wire:model="birth_order">
                            <option>Eldest</option>
                            <option>Middle</option>
                            <option>Youngest</option>
                        </x-select>
                        <x-error fieldName="birth_order" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Number of Siblings
                        </x-label>
                        <x-input wire:model="number_of_siblings" />
                        <x-error fieldName="number_of_siblings" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Religion
                        </x-label>
                        <x-input wire:model="religion" />
                        <x-error fieldName="religion" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            4Ps Receipient:
                        </x-label>
                        <x-select wire:model="four_ps">
                            <option>Yes</option>
                            <option>No</option>
                        </x-select>
                        <x-error fieldName="four_ps" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Mother Tongue
                        </x-label>
                        <x-input wire:model="mother_tongue" />
                        <x-error fieldName="mother_tongue" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of birth
                        </x-label>
                        <x-input wire:model="birth_place" />
                        <x-error fieldName="birth_place" />


                    </div>

                </x-grid>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
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
                        <x-error fieldName="selectedCity" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>Municipality</x-label>
                        <x-select wire:model="selectedMunicipality">
                            @foreach ($municipalities as $municipality)
                                <option value="{{ $municipality->id }}">{{ $municipality->municipality }}</option>
                            @endforeach
                        </x-select>
                        <x-error fieldName="selectedMunicipality" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>Barangay</x-label>
                        <x-select wire:model="selectedBarangay">
                            @foreach ($barangays as $barangay)
                                <option value="{{ $barangay->id }}">
                                    {{ $barangay->barangay }}</option>
                            @endforeach
                        </x-select>
                        <x-error fieldName="selectedBarangay" />

                    </div>
                </x-grid>


                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Family Background
                </h6>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Father
                </h6>



                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="hidden">
                        <x-input wire:model="father_type" value="0" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input wire:model="father_name" />
                        <x-error fieldName="father_name" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input wire:model="father_age" type="number" />
                        <x-error fieldName="father_age" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input wire:model="father_occupation" />
                        <x-error fieldName="father_occupation" />

                    </div>

                    <div x-data="{ phoneNumber: '' }" class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input wire:model="father_contact" type="number" />
                        <x-error fieldName="father_contact" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input wire:model="father_office_contact" />
                        <x-error fieldName="father_office_contact" />

                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input type="number" wire:model="father_monthly_income" />
                        <x-error fieldName="father_monthly_income" />

                    </div>
                </x-grid>


                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input wire:model="father_birth_place" />
                        <x-error fieldName="father_birth_place" />

                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input wire:model="father_work_address" />
                        <x-error fieldName="father_work_address" />

                    </div>
                </x-grid>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Mother
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="hidden">

                        <x-input wire:model="mother_type" disabled value="1" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input wire:model="mother_name" />
                        <x-error fieldName="mother_name" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input wire:model="mother_age" type="number" />
                        <x-error fieldName="mother_age" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input wire:model="mother_occupation" />
                        <x-error fieldName="mother_occupation" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contaact No.
                        </x-label>
                        <x-input wire:model="mother_contact" />
                        <x-error fieldName="mother_contact" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input wire:model="mother_office_contact" />
                        <x-error fieldName="mother_office_contact" />

                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input type="number" wire:model="mother_monthly_income" />
                        <x-error fieldName="mother_monthly_income" />

                    </div>

                </x-grid>

                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input wire:model="mother_birth_place" />
                        <x-error fieldName="mother_birth_place" />

                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input wire:model="mother_work_address" />
                        <x-error fieldName="mother_work_address" />

                    </div>
                </x-grid>

                <div>

                    <div class="flex justify-between items-center mb-4">
                        <h6 class=" px-4 text-sm font-bold uppercase">
                            Siblings' Information
                        </h6>

                        <x-button wire:click="addSibling">Add</x-button>
                    </div>


                        @foreach($siblings as $index => $sibling)
                         <div class="flex justify-end px-4 ">
                        <button class="text-red-500 text-sm underline" wire:click="removeSibling({{ $index }})">
                            Remove
                        </button>
                    </div>
                    <x-grid columns="3" gap="4" px="0" mt="0">

                             <div class="relative mb-3 px-4">
                                    <x-label>
                                        Sibling's Name
                                    </x-label>
                                    <x-input type="text" wire:model="siblings.{{ $index }}.name" />
                                </div>
                             <div class="relative mb-3 px-4">
                                    <x-label>
                                        Sibling's Age
                                    </x-label>
                                    <x-input type="text" wire:model="siblings.{{ $index }}.age" />
                                </div>
                             <div class="relative mb-3 px-4">
                                    <x-label>
                                        Grade/Section
                                    </x-label>
                                    <x-input type="text" wire:model="siblings.{{ $index }}.gradeSection" />
                                </div>

                    </x-grid>
                        @endforeach


                </div>






                <div x-data="{ selected: @entangle('living_with') }">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        You are currently living with:
                        <x-error fieldName="living_with" />
                    </h6>
                    <x-grid columns="4" gap="4" px="4" mt="2">
                        @foreach (['both-parents', 'father-only', 'mother-only', 'na'] as $option)
                            <div class="relative mb-3">
                                <input type="radio" name="living-with" wire:model="living_with"
                                    value="{{ $option }}"
                                    x-bind:checked="selected === '{{ $option }}'" />
                                <x-label class="inline-block" for="living-with"
                                    value="{{ ucfirst(str_replace('-', ' ', $option)) }}" />
                            </div>
                        @endforeach
                    </x-grid>
                </div>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                    Parent are currently:
                    <x-error fieldName="living_with" />
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach (['Living Together', 'Separated', 'Legally Separated', 'With another partner', 'Father is OFW', 'Mother is OFW'] as $status)
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="{{ $status }}" />
                            <x-label class="inline-block">{{ $status }}</x-label>
                        </div>
                    @endforeach
                </x-grid>


                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Guardian's Name
                        </x-label>
                        <x-input wire:model="guardian_name" />
                        <x-error fieldName="guardian_name" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Relationship with the guardian
                        </x-label>
                        <x-input wire:model="relationship" />
                        <x-error fieldName="relationship" />

                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input wire:model="guardian_contact" />
                        <x-error fieldName="guardian_contact" />

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input type="number" wire:model="guardian_age" />
                        <x-error fieldName="guardian_age" />

                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Addresss
                        </x-label>
                        <x-input wire:model="guardian_address" />
                        <x-error fieldName="guardian_address" />

                    </div>

                </x-grid>


                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                    Educational Background
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                    @foreach ($education as $i => $edu)
                        <div class="w-full px-4">
                            <h6 class="text-sm my-1 font-bold uppercase text-gray-500">
                                Grade {{ $edu['grade_level'] }}
                            </h6>
                            <div class="relative mb-3">
                                <x-label for="school_name">Name of school</x-label>
                                <x-input wire:model="education.{{ $i }}.school_name" id="name" class="w-full" />
                            </div>
                            <div class="relative mb-3">
                                <x-label for="section">Section</x-label>
                                <x-input wire:model="education.{{ $i }}.grade_section" id="section" class="w-full" />
                            </div>
                            <div class="relative mb-3">
                                <x-label for="school_year">School Year</x-label>
                                <x-input wire:model="education.{{ $i }}.school_year" id="school_year" class="w-full" />
                            </div>
                        </div>
                    @endforeach
                </x-grid>




                <div class="flex justify-between items-center mb-1 px-4">
                    <h6 class="text-sm font-bold uppercase">
                        Name some of you award
                    </h6>

                    <x-button wire:click="addReward">Add</x-button>
                </div>


                    @foreach($rewards as $index => $reward)
                     <div class="flex justify-end px-4 ">
                    <button class="text-red-500 text-sm underline" wire:click="removeAward({{ $index }})">
                        Remove
                    </button>
                </div>
                <x-grid columns="2" gap="4" px="0" mt="0">

                         <div class="relative mb-3 px-4">
                                <x-label>
                                    Reward Name
                                </x-label>
                                <x-input type="text" wire:model="rewards.{{ $index }}.name" />
                            </div>
                         <div class="relative mb-3 px-4">
                                <x-label>
                                    Year
                                </x-label>
                                <x-input type="text" wire:model="rewards.{{ $index }}.year" />
                            </div>
                </x-grid>
                    @endforeach

                    <div class="flex justify-end px-4">
                        <x-button wire:click="saveAwards">Update</x-button>
                    </div>






                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What is your favorite subject/s:
                        </x-label>
                        <x-input wire:model="favorite_subject" />
                        <x-error fieldName="favorite_subject" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What subject do you find difficult
                        </x-label>
                        <x-input wire:model="difficult_subject" />
                        <x-error fieldName="difficult_subject" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What school organizations are you afiliated?
                        </x-label>
                        <x-input wire:model="school_organization" />
                        <x-error fieldName="school_organization" />

                    </div>
                </x-grid>

                <div x-data="{ plans: @entangle('plans') }">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        What do you plan to do after graduating Senior High School?
                        <x-error fieldName="plans" />

                    </h6>
                    <x-grid columns="3" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <input type="radio" wire:model="plans" value="Go to College" />
                            <x-label class="inline-block">Go to College</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" wire:model="plans" value="Work as a skilled worker" />
                            <x-label class="inline-block">Work as a skilled worker</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" wire:model="plans" value="Pursue TESDA certificates" />
                            <x-label class="inline-block">Pursue TESDA certificates</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" wire:model="plans" value="Engage in Business" />
                            <x-label class="inline-block">Engage in Business</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" wire:model="plans" value="Work to help parents" />
                            <x-label class="inline-block">Work to help parents</x-label>
                        </div>
                        <div class="relative mb-3 px-4">
                            <input type="radio" wire:model="plans" value="Undecided" />
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
                        <x-input wire:model="height" type="number" />
                        <x-error fieldName="height" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Weight
                        </x-label>
                        <x-input wire:model="weight" type="number" />
                        <x-error fieldName="weight" />

                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            BMI
                        </x-label>
                        <x-input wire:model="bmi" type="number" />
                        <x-error fieldName="bmi" />

                    </div>
                </x-grid>


                    <div x-data="{
                        hasDisability: @entangle('hasDisability'),
                        hasFoodAllergy: @entangle('hasFoodAllergy')
                    }">

                <x-grid columns="2" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a disability?
                            </x-label>
                            <x-select x-on:change="hasDisability === 'Yes' ? $refs.disabilityInput.focus() : null"
                                wire:model="hasDisability">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </x-select>
                            <x-error fieldName="hasDisability" />

                        </div>

                        <div class="relative mb-3 px-4" x-show="hasDisability === 'Yes'">
                            <x-label>
                                If yes, what is it?
                            </x-label>
                            <x-input x-ref="disabilityInput" wire:model="disability" />
                            <x-error fieldName="disability" />

                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a food allergy?
                            </x-label>
                            <x-select x-on:change="hasFoodAllergy === 'Yes' ? $refs.foodAllergyInput.focus() : null"
                                wire:model="hasFoodAllergy">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </x-select>
                            <x-error fieldName="hasFoodAllergy" />
                        </div>

                        <div class="relative mb-3 px-4" x-show="hasFoodAllergy === 'Yes'">
                            <x-label>
                                If yes, what is your food allergy?
                            </x-label>
                            <x-input x-ref="foodAllergyInput" wire:model="foodAllergy" />
                            <x-error fieldName="foodAllergy" />
                        </div>


                    </x-grid>
                    </div>


                    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                        Medicine taken in
                    </h6>

                    <x-grid columns="3" gap="4" px="0" mt="0">
                        @for ($i = 1; $i <= 3; $i++)

                            <div class="relative mb-3 px-4">
                                <x-label for="medicine_{{ $i }}">
                                    {{ $i }}
                                </x-label>
                                <x-input wire:model="medicines.{{ $i - 1 }}" id="medicine_{{ $i }}" />
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
                                <x-input wire:model="vitamins.{{ $i - 1 }}" id="vitamin_{{ $i }}" />
                            </div>
                        @endfor
                    </x-grid>

                    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                        Accidents experienced
                    </h6>

                    <x-grid columns="3" gap="4" px="0" mt="0">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="relative mb-3 px-4">
                                <x-label for="accident_{{ $i }}">
                                    {{ $i }}
                                </x-label>
                                <x-input wire:model="accidents.{{ $i -1 }}" id="accidents_{{ $i }}" />
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
                            <x-input wire:model="operations.{{ $i -1  }}"
                                id="operations_{{ $i }}" />
                        </div>
                    @endfor
                </x-grid>

                <div class="flex justify-end items-center">
                    <x-text-alert />
                    <div wire:loading wire:target="update" class="mx-4">
                        Loading..
                    </div>
                    <x-button type="submit"
                     wire:loading.attr="disabled" >Update</x-button>
                </div>

            </form>
        </x-slot>
    </x-form>
</div>
<div>

</div>


</div>
