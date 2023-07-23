<div>

    <x-form title="Add Student Profile">

        <x-slot name="actions">
            <x-link href="{{ url('admin/student-profile') }}">
                Back
            </x-link>
        </x-slot>
        <x-slot name="slot">
            <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 ">
                Personal Information
            </h6>

            <form wire:submit="save">
                <x-grid columns="3" gap="4" px="0" mt="0">


                    <div class="w-full px-4">
                        <div x-data="{ open: false, selected: '' }" class="relative">
                            <div class="relative">
                                <x-label>
                                    Full Name
                                </x-label>
                                <x-input x-on:input.debounce.300ms="open = true" x-model="selected"
                                    wire:model.debounce.100ms="student_id" type="text" id="input"
                                    placeholder="Type to search..." :value="$student_id" required />


                            </div>
                            <div x-show="open && selected.length >= 3" x-on:click.away="open = false"
                                class="absolute z-50 w-full mt-2 bg-white rounded-md shadow-lg max-h-60 overflow-y-auto">
                                @if ($searchResults && $searchResults->count() > 0)
                                    <ul
                                        class="rounded-md py-1 text-base leading-6 shadow-xs overflow-au text-black to focus:outline-none sm:text-sm sm:leading-5">
                                        @foreach ($searchResults as $result)
                                            <li x-on:click="selected = '{{ $result['first_name'] }} {{ $result['last_name'] }}'; open = false; $wire.selectResult('{{ $result['first_name'] }}')"
                                                class="cursor-pointer text-black select-none relative py-2 pl-3 pr-9 {{ $selectedResult == $result['first_name'] ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                                                <span x-text="selected === '{{ $result['first_name'] }}' ? '✓' : ''"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-600"></span>
                                                {{ $result['first_name'] }} {{ $result['last_name'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="p-3">No results found.</div>
                                @endif
                            </div>
                        </div>


                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Middle Name
                        </x-label>
                        <x-input wire:model="" wire:model="m_name" />
                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            Suffix
                        </x-label>
                        <x-input wire:model="suffix" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Nickname
                        </x-label>
                        <x-input wire:model="nickname" />
                    </div>




                    <div class="w-full px-4">

                        <div class="relative mb-3">
                            <x-label>
                                Age
                            </x-label>
                            <x-input wire:model="age" />
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
                        </div>

                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Birthdate
                        </x-label>
                        <x-input type="date" wire:model="birthdate" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contaact Number
                        </x-label>
                        <x-input wire:model="contact" />
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
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Number of Siblings
                        </x-label>
                        <x-input wire:model="number_of_siblings" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Religion
                        </x-label>
                        <x-input wire:model="religion" />
                    </div>





                    <div class="relative mb-3 px-4">
                        <x-label>
                            Mother Tongue
                        </x-label>
                        <x-input wire:model="mother_tongue" />
                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            4Ps Receipient:
                        </x-label>
                        <x-select wire:model="four_ps">
                            <option>Yes</option>
                            <option>No</option>
                        </x-select>
                    </div>

                </x-grid>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Place of Birth
                </h6>

                <x-input wire:model="birth_place" />

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

                    <div class="relative mb-3 px-4 hidden ">
                        <x-label>
                            Type
                        </x-label>
                        <x-input wire:model="father_type" value="father" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input wire:model="father_name" />
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input wire:model="father__age" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input wire:model="father_occupation" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contaact No.
                        </x-label>
                        <x-input wire:model="father_contact" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input wire:model="father_office_contact" />
                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input wire:model="father_monthly_income" />
                    </div>

                </x-grid>


                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input wire:model="father_birth_place" />
                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input wire:model="father_work_place" />
                    </div>
                </x-grid>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Mother
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4 hidden">
                        <x-label>
                            Type
                        </x-label>
                        <x-input wire:model="mother_type" value="mother"  />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-input wire:model="mother_name" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input wire:model="mother_age" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Occupation
                        </x-label>
                        <x-input wire:model="mother_occupation" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contaact No.
                        </x-label>
                        <x-input wire:model="mother_contact" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Office Contact No.
                        </x-label>
                        <x-input wire:model="mother_office_contact" />
                    </div>
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Monthly Income
                        </x-label>
                        <x-input wire:model="mother_monthly_income" />
                    </div>

                </x-grid>

                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Place of Birth
                        </x-label>
                        <x-input wire:model="mother_birth_place" />
                    </div>
                    <div class="relative mb-3 px-4">
                        Place of Work

                        <x-input wire:model="mother_work_place" />
                    </div>
                </x-grid>


                <div x-data="{ siblings: @entangle('siblings') }">
                    <div class="flex items-center justify-between mt-4 mx-4">
                        <h6 class="text-sm font-bold uppercase">
                            List down the names of Siblings that are studying at CZCMNHS?
                        </h6>
                        <div class="relative mb-3 px-4">
                            <x-buttontype  @click="siblings.push({ name: '', age: '', gradeSection: '' })">
                                Add Sibling
                            </x-buttontype>

                            <x-buttontype  @click="siblings.pop()" >
                                Remove
                            </x-buttontype>
                        </div>
                    </div>

                    <template x-for="(sibling, index) in siblings" :key="index">
                        <x-grid columns="3" gap="4" px="0" mt="0">
                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Name
                                </x-label>
                                <x-input x-model="sibling.name" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Age
                                </x-label>
                                <x-input x-model="sibling.age" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Grade and Section
                                </x-label>
                                <x-input x-model="sibling.gradeSection" />
                            </div>
                        </x-grid>
                    </template>
                </div>




                <div x-data="{ livingWith: @entangle('living_with') }">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        You are currently living with:
                    </h6>
                    <x-grid columns="1 md:grid-cols-4" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-checkbox name="living-with" wire:model="living_with" value="both-parents"
                                x-bind:checked="livingWith === 'both-parents'" />
                            <x-label class="inline-block" for="living-with" value="Both Parents" />
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox name="living-with" wire:model="living_with" value="father-only"
                                x-bind:checked="livingWith === 'father-only'" />
                            <x-label class="inline-block" for="living-with" value="Father Only" />
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox name="living-with" wire:model="living_with" value="mother-only"
                                x-bind:checked="livingWith === 'mother-only'" />
                            <x-label class="inline-block" for="living-with" value="Mother Only" />
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox name="living-with" wire:model="living_with" value="na"
                                x-bind:checked="livingWith === 'na'" />
                            <x-label class="inline-block" for="living-with" value="N/A" />
                        </div>
                    </x-grid>
                </div>



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                    Parent are currently: (check which applies below)
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block" wire:model="parent_statuses" value="Living together">Living
                            together
                        </x-label>
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block" wire:model="parent_statuses" value="Separated">Separated
                        </x-label>
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block" wire:model="parent_statuses" value="Legally Separated">Legally
                            Separated</x-label>
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block" wire:model="parent_statuses" value="With another partner">With
                            another partner</x-label>
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block" wire:model="parent_statuses" value="Father is OFW">Father is
                            OFW
                        </x-label>
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-checkbox />
                        <x-label class="inline-block" wire:model="parent_statuses" value="Mother is OFW">Mother is
                            OFW
                        </x-label>
                    </div>


                </x-grid>




                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Guardian's Name
                        </x-label>
                        <x-input wire:model="guardian_name" />
                    </div>





                    <div class="relative mb-3 px-4">
                        <x-label>
                            Relationship with the guardian
                        </x-label>
                        <x-input wire:model="relationship" />
                    </div>




                    <div class="relative mb-3 px-4">
                        <x-label>
                            Contact No.
                        </x-label>
                        <x-input wire:model="guardian_contact" />
                    </div>


                    <div class="relative mb-3 px-4">
                        <x-label>
                            Age
                        </x-label>
                        <x-input wire:model="guardian_age" />
                    </div>

                </x-grid>


                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                    Address
                </h6>

                <x-input wire:model="guardian_address" />



                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                    Educational Background
                </h6>

                <!-- Repeat the structure for each grade level -->
                @for ($gradeLevel = 7; $gradeLevel <= 12; $gradeLevel++)
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                        Grade {{ $gradeLevel }}
                    </h6>
                    <x-grid columns="3" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-label for="name_{{ $gradeLevel }}">Name of school</x-label>
                            <x-input wire:model="education.{{ $gradeLevel }}.name"
                                id="name_{{ $gradeLevel }}" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label for="section_{{ $gradeLevel }}">Section</x-label>
                            <x-input wire:model="education.{{ $gradeLevel }}.section"
                                id="section_{{ $gradeLevel }}" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label for="school_year_{{ $gradeLevel }}">School Year</x-label>
                            <x-input wire:model="education.{{ $gradeLevel }}.school_year"
                                id="school_year_{{ $gradeLevel }}" />
                        </div>
                    </x-grid>
                @endfor



                <div x-data="{ rewards: @entangle('rewards') }">
                    <div class="flex items-center justify-between mt-4 mx-4">
                        <h6 class="text-sm font-bold uppercase">
                            Name some of your Academic and Extra-Curricular Awards
                        </h6>
                        <div class="relative mb-3 px-4">
                            <x-buttontype  @click="rewards.push({ name: '', age: '' })">
                                Add Award
                            </x-buttontype>
                            <x-buttontype  @click="rewards.pop()" >
                                Remove
                            </x-buttontype>
                        </div>
                    </div>

                    <template x-for="(reward, index) in rewards" :key="index">
                        <x-grid columns="2" gap="4" px="0" mt="0"
                            x-show="index === 0 || rewards.length > 1">
                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Name of Award
                                </x-label>
                                <x-input x-model="reward.name" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label>
                                    Year Achieved
                                </x-label>
                                <x-input x-model="reward.age" />
                            </div>
                        </x-grid>
                    </template>
                </div>


                <x-grid columns="3" gap="4" px="0" mt="0">

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What is your favorite subject/s:
                        </x-label>
                        <x-input wire:model="favorite_subject" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What subject do you find difficult
                        </x-label>
                        <x-input wire:model="difficult_subject" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            What school organizations are you afiliated?
                        </x-label>
                        <x-input wire:model="school_organization" />
                    </div>
                </x-grid>

                <div x-data="{ plans: @entangle('plans') }">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        What do you plan to do after graduating Senior High School?
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
                        <x-input wire:model="height" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Weight
                        </x-label>
                        <x-input wire:model="weight" />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            BMI
                        </x-label>
                        <x-input wire:model="bmi" />
                    </div>


                    <div x-data="{ hasDisability: @entangle('hasDisability'), hasFoodAllergy: @entangle('hasFoodAllergy') }">
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a disability?
                            </x-label>
                            <x-select x-on:change="hasDisability === 'Yes' ? $refs.disabilityInput.focus() : null"
                                wire:model="hasDisability">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </x-select>
                        </div>

                        <div class="relative mb-3 px-4" x-show="hasDisability === 'Yes'">
                            <x-label>
                                If yes, what is it?
                            </x-label>
                            <x-input x-ref="disabilityInput" wire:model="disability" />
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
                        </div>

                        <div class="relative mb-3 px-4" x-show="hasFoodAllergy === 'Yes'">
                            <x-label>
                                If yes, what is your food allergy?
                            </x-label>
                            <x-input x-ref="foodAllergyInput" wire:model="foodAllergy" />
                        </div>
                    </div>




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
                            <x-input wire:model="vitamins.{{ $i }}" id="vitamin_{{ $i }}" />
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
                            <x-input wire:model="accidents.{{ $i }}"
                                id="accidents_{{ $i }}" />
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
                            <x-input wire:model="operations.{{ $i }}"
                                id="operations_{{ $i }}" />
                        </div>
                    @endfor
                </x-grid>

                <div class="flex justify-end">
                    <x-button> Submit</x-button>
                </div>

            </form>
        </x-slot>
    </x-form>
</div>
