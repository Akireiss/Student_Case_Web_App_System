<div>


    <div x-data="{ showTable: true, showForm: false }">
        <div x-show="showTable">
            <div class="flex items-center justify-between my-2">
                <h6 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
                    {{-- List Of Students --}}
                </h6>
                <div class="flex justify-end  mt-4">
                    <x-button x-on:click="showTable = false; showForm = true">
                        Add
                    </x-button>
                </div>
            </div>
            <div>
                <livewire:yearly-report-table/>
            </div>
        </div>


        <div x-cloak x-show="showForm">
            <div>



    <div class="flex justify-end space-x-2">


        <div x-data="{ open: false }" class="relative inline-block text-left">
            <x-buttontype @click="open = !open">
                {{ $selectedOption }}
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" class="w-4 h-4 ml-2">
                    <path d="M19 9l-7 7-7-7"></path>
                </svg>
            </x-buttontype>
            <ul x-show="open" @click.away="open = false"
                class="absolute z-50 mt-2 py-2 bg-white border border-gray-300 rounded-lg shadow-lg w-full">
                <li><a href="#" wire:click="$set('selectedOption', 'High School')"
                        class="block px-4 py-2 text-gray-800
                 hover:bg-gray-500 hover:text-white">High
                        School</a></li>
                <li><a href="#" wire:click="$set('selectedOption', 'Senior High')"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-500 hover:text-white">Senior High</a></li>
            </ul>
        </div>
        <x-button x-on:click="showForm = false; showTable = true">
            Back
        </x-button>


    </div>


    <div class="flex justify-between items-center">
        {{-- <h6 class="text-lg font-bold text-left ">
            Report
        </h6> --}}

    </div>

    <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

        <form wire:submit.prevent="saveReport">
            @forelse($groupedClassrooms as $gradeLevel => $classroom)
                <div class="w-full">

                    <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
                        Grade: {{ $gradeLevel }}
                    </h6>


                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="w-full px-4 hidden">
                            <div class="relative mb-3">
                                {{-- Label --}}
                                <x-label>Grade Level</x-label>
                                <x-input disabled value="{{ $gradeLevel }}" />
                            </div>
                        </div>
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Male</x-label>
                                <x-input disabled
                                    wire:model="{{ $selectedOption === 'High School'
                                        ? 'groupedClassrooms.' . $gradeLevel . '.total_hs_male'
                                        : 'groupedClassrooms.' . $gradeLevel . '.total_sh_male' }}" />
                            </div>
                        </div>
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Female</x-label>
                                <x-input disabled
                                    wire:model="{{ $selectedOption === 'High School'
                                        ? 'groupedClassrooms.' . $gradeLevel . '.total_hs_female'
                                        : 'groupedClassrooms.' . $gradeLevel . '.total_sh_female' }}" />
                            </div>
                        </div>
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Total</x-label>
                                <x-input disabled
                                    wire:model="{{ $selectedOption === 'High School'
                                        ? 'groupedClassrooms.' . $gradeLevel . '.total_students'
                                        : 'groupedClassrooms.' . $gradeLevel . '.total_students' }}" />
                            </div>
                        </div>
                    </div>
                </div>


            @empty
                <div>
                    <p>
                        No Classroom found
                    </p>
                </div>
            @endforelse


            <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
                Other Information
            </h6>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Category</x-label>
                        <x-input disabled wire:model="selectedOption" />
                    </div>
                </div>
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label> School Year</x-label>
                        <x-input wire:model="yearLevel" required />
                        <x-error fieldName="yearLevel" />

                    </div>
                </div>

            </div>

            <div class="flex justify-end items-center mx-4">
                <div id="messageContainer">
                    @if (session()->has('success'))
                        <span class="text-green-500 mx-4">
                            {{ session('success') }}
                        </span>
                    @endif
                </div>
                <div wire:loading wire:target="saveReport" class="mx-4">
                    Loading..
                </div>
                <x-button type="submit" wire:loading.attr="disabled">Save Report</x-button>
            </div>

        </form>

    </div>


    @if ($selectedOption === 'Senior High')
        <x-form title="">
            <x-slot name="actions">

            </x-slot>

            <x-slot name="slot">
                <form wire:submit.prevent="save">
                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Completion Rate
                    </h6>
                    <!-- Personal information form fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Completters</x-label>
                                <x-input wire:model="ShTotalStudents" disabled />
                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Enrollment</x-label>
                                <x-input wire:model="ShTotalEnrollment" disabled />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Percent Cr</x-label>
                                <x-input disabled wire:model="ShCompletionPercent" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Year Level</x-label>
                                <x-input wire:model="ShCrYear" required />
                                <x-error fieldName="ShCrYear" />
                            </div>
                        </div>
                    </div>





                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Promotion Rate
                    </h6>
                    <!-- Personal information form fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Promotes</x-label>
                                <x-input disabled wire:model="ShTotalPromotion" />
                            </div>
                        </div>



                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Enrollment</x-label>
                                <x-input wire:model="ShTotalEnrollment" disabled />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Percent PR</x-label>
                                <x-input disabled wire:model="ShPromotionPercent" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Year Level</x-label>
                                <x-input wire:model="ShPrYear" required />
                                <x-error fieldName="ShPrYear" />

                            </div>
                        </div>
                    </div>





                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Drop Out Rate
                    </h6>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Drop Out</x-label>
                                <x-input wire:model="ShTotalDropOut" disabled />
                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Enrollment</x-label>
                                <x-input wire:model="ShTotalEnrollment" disabled />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Percent Dr</x-label>
                                <x-input disabled wire:model="ShDropOutRate" />
                            </div>
                        </div>



                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Year Level</x-label>
                                <x-input wire:model="ShDrYear" required />
                                <x-error fieldName="ShDrYear" />

                            </div>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Category</x-label>
                            <x-input disabled wire:model="selectedOption" />
                        </div>
                    </div>


                    <div class="flex justify-end items-center mx-4">
                        <x-text-alert />
                        <div wire:loading wire:target="save" class="mx-4">
                            Loading...
                        </div>
                        <x-button type="submit" wire:loading.attr="disabled">Save </x-button>
                    </div>

                </form>
            </x-slot>
        </x-form>
    @elseif ($selectedOption === 'High School')
        <x-form title="">
            <x-slot name="actions">

            </x-slot>

            <x-slot name="slot">
                <form wire:submit.prevent="saveReportHs">
                    {{-- <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Completion Rate
                    </h6> --}}
                    {{--
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Completters</x-label>
                                <x-input wire:model="totalStudents" disabled />
                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Enrollment</x-label>
                                <x-input wire:model="totalEnrollment" disabled />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Percent Cr</x-label>
                                <x-input disabled wire:model="completionPercent" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Year Level</x-label>
                                <x-input wire:model="CrYear" />
                            </div>
                        </div>
                    </div>
 --}}




                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Promotion Rate
                    </h6>
                    <!-- Personal information form fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Promotes</x-label>
                                <x-input disabled wire:model="HsTotalPromotion" />
                            </div>
                        </div>



                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Enrollment</x-label>
                                <x-input wire:model="HsTotalEnrollment" disabled />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Percent PR</x-label>
                                <x-input disabled wire:model="HsPromotionPercent" />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Year Level</x-label>
                                <x-input wire:model="HsPrYear" required/>
                                <x-error fieldName="HsPrYear" />
                            </div>
                        </div>
                    </div>





                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Drop Out Rate
                    </h6>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Drop Out</x-label>
                                <x-input wire:model="HsTotalDropOut" disabled />
                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Enrollment</x-label>
                                <x-input wire:model="HsTotalEnrollment" disabled />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Percent Dr</x-label>
                                <x-input disabled wire:model="HsDropOutRate" />
                            </div>
                        </div>



                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Year Level</x-label>
                                <x-input wire:model="HsDrYear" required/>
                                <x-error fieldName="HsDrYear" />

                            </div>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Category</x-label>
                            <x-input disabled wire:model="selectedOption" />
                        </div>
                    </div>


                    <div class="flex justify-end items-center mx-4">
                        <x-text-alert />
                        <div wire:loading wire:target="saveReportHs" class="mx-4">
                            Loading...
                        </div>
                        <x-button type="submit" wire:loading.attr="disabled">Save </x-button>
                    </div>

                </form>
            </x-slot>
        </x-form>
    @endif





</div>






</div>
