<div>
    <div class="mx-auto">
        <div class="flex justify-between items-center">
            <h6 class="text-xl font-bold text-left ">
                Report Student
            </h6>
            @if (auth()->user()->role == '1')
                <x-button x-on:click="showForm = false; showTable = true">
                    Back
                </x-button>
            @endif



        </div>

        <div class="w-full mx-auto mt-6">
            <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

                <div class="flex-auto px-6 lg:px-10 py-10 pt-0">

                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        @csrf
                        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                            Student Information
                        </h6>
                        <x-grid columns="2" gap="4" px="0" mt="0">


                            <div class="w-full px-4">
                                <div x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
                                    <x-label for="studentName">
                                        Student Name
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
                                                        wire:click="selectStudent('{{ $student->id }}',
                                                         '{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}')"
                                                        x-on:click="isOpen = false">
                                                        {{ $student->first_name }} {{ $student->middle_name }}
                                                        {{ $student->last_name }}
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


                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Referred By
                                    </x-label>
                                    <x-input type="text" name="offenses" placeholder="{{ Auth()->user()->name }}"
                                        wire:model="user_id" value="{{ Auth()->user()->id }}" disabled />
                                </div>
                            </div>

                        </x-grid>

                        <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                            Case Information
                        </h6>

                        <x-grid columns="2" gap="4" px="0" mt="4">
                            <div class="w-full px-4">
                                <x-label>
                                    Classroom
                                </x-label>
                                <x-input disabled :value="$classroom && $classroom->section
                                    ? 'Grade: ' . $classroom->grade_level . ' ' . $classroom->section
                                    : ''" />
                            </div>




                            <div class="w-full px-4">
                                <x-label>
                                    Offense
                                </x-label>
                                <x-select name="offense_id" wire:model="offense_id">
                                    @if ($offenses)
                                        @foreach ($offenses as $id => $offense)
                                            <option value="{{ $id }}">{{ $offense }}</option>
                                        @endforeach
                                    @endif
                                </x-select>
                                <x-error fieldName="offense_id" />
                            </div>



                        </x-grid>


                        <x-grid columns="3" gap="4" px="0" mt="4">
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Observation
                                    </x-label>
                                    <x-input type="text" name="observation" wire:model="observation" />
                                    <x-error fieldName="observation" />

                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Desired
                                    </x-label>
                                    <x-input type="text" name="desired" wire:model="desired" />
                                    <x-error fieldName="desired" />

                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Outcome
                                    </x-label>
                                    <x-input type="text" name="outcome" wire:model="outcome" />
                                    <x-error fieldName="outcome" />

                                </div>
                            </div>
                        </x-grid>



                        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                            Additional Information
                        </h6>

                        <x-grid columns="3" gap="4" px="0" mt="4">


                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Gravity of offense
                                    </x-label>
                                    <x-select name="gravity" wire:model="gravity">
                                        <option value="0">Low Severity</option>
                                        <option value="1">Moderate Severity</option>
                                        <option value="2">Medium Severity</option>
                                        <option value="3">High Severity</option>
                                        <option value="4">Critical Severity</option>
                                    </x-select>
                                    <x-error fieldName="gravity" />


                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Remarks (Short Description)
                                    </x-label>
                                    <x-input type="text" name="short_description" wire:model="short_description" />
                                    <x-error fieldName="short_description" />

                                </div>
                            </div>

                            <div class="w-full px-4">
                                <x-label>Letter</x-label>
                                <input type="file" name="letter" wire:model="letter"
                                    class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                               file:bg-transparent file:border-0
                               file:bg-gray-100 file:mr-4
                               file:py-2.5 file:px-4">
                            </div>
                        </x-grid>



                        <h6 class="text-sm my-6 px-4 font-bold uppercase ">

                            Actions Taken <x-error fieldName="selectedActions" />
                        </h6>

                        <x-grid columns="3" gap="4" px="0" mt="4">
                            @forelse ($actions as $action)
                                <div class="w-full px-4 inline-flex space-x-3">
                                    <x-checkbox wire:model="selectedActions" value="{{ $action->action_taken }}" />
                                    <x-label>{{ $action->action_taken }}</x-label>

                                </div>
                            @empty
                                <p>No Data</p>
                            @endforelse

                        </x-grid>




                        <div class="flex justify-end items-center">
                            <x-text-alert />
                            <div wire:loading wire:target="store" class="mx-4">
                                Loading
                            </div>
                            <x-button type="submit" wire:loading.attr="disabled">Submit</x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    @if ($studentName && $studentId)
    <div class="px-4 py-3">
        @if (count($cases) > 0)
            @php
                $totalOffenses = 0;
                $totalPending = 0;
                $totalProcess = 0;
                $totalResolved = 0;
            @endphp
            @foreach ($cases as $case)
                @if ($case->offenses)
                    @php
                        $totalOffenses += 1;
                        if ($case->case_status == '0') {
                            $totalPending += 1;
                        } elseif ($case->case_status == '1') {
                            $totalProcess += 1;
                        } elseif ($case->case_status == '2') {
                            $totalResolved += 1;
                        }
                    @endphp
                @endif
            @endforeach
            <p class="text-red-500 text-md  text-center">{{ $studentName }} has a total of {{ $totalOffenses }} offenses.
           {{ $totalPending }} Pending cases | {{ $totalProcess}} Process cases | {{ $totalResolved }} Resolved cases
            </p>
        @else
        <p class="text-green-500 text-md text-center">
            No cases found for {{ $studentName }}
        </p>
        @endif
    </div>
@endif



</div>