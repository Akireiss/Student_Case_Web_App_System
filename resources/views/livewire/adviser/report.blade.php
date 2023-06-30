<div>
    <x-form title="Add Offenses">
        <x-slot name="actions">
            {{-- None Here --}}
        </x-slot>

        <x-slot name="slot">

            <div x-data="{ step: 1 }">
                <div x-show="step === 1" x-cloak>
                    <form>
                        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                            Report Student
                        </h6>
                        <!-- Step 1 form fields -->

                    <x-grid columns="2" gap="4" px="0" mt="0">


                            <div class="w-full px-4">
                                <div x-data="{ open: false, selected: '', last_name: '' }" class="relative">
                                    <div class="relative">
                                        <x-label>
                                            First Name
                                        </x-label>
                                        <x-input x-on:input.debounce.300ms="open = true" x-model="selected"
                                            wire:model.debounce.500ms="search" type="text" name="input"
                                            id="input" placeholder="Type to search..." />
                                    </div>
                                    <div x-show="open && selected.length >= 3" x-on:click.away="open = false"
                                        class="absolute z-50 w-full mt-2 bg-white rounded-md shadow-lg max-h-60 overflow-y-auto">
                                        @if ($searchResults && $searchResults->count() > 0)
                                            <ul
                                                class="rounded-md py-1 text-base leading-6 shadow-xs overflow-au text-black to focus:outline-none sm:text-sm sm:leading-5">
                                                @foreach ($searchResults as $result)
                                                    <li x-on:click="selected = '{{ $result['first_name'] }}'; last_name = '{{ $result['last_name'] }}'; open = false; $wire.selectResult('{{ $result['first_name'] }}')"
                                                        class="cursor-pointer text-black select-none relative py-2 pl-3 pr-9 {{ $selectedResult == $result['first_name'] ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                                                        <span
                                                            x-text="selected === '{{ $result['first_name'] }}' ? '✓' : ''"
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

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Last Name
                                    </x-label>
                                    <x-input type="text" name="offenses" wire:model="last_name" disabled />
                                </div>
                            </div>


                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Current Grade Level
                                    </x-label>
                                    <x-input type="text" name="offenses" />
                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Reffered By
                                    </x-label>
                                    <x-input type="text" name="offenses" value="{{ Auth()->user()->name }}" />
                                </div>
                            </div>


                    </x-grid>

                        <div class="flex justify-end mx-4 mt-2">
                            <x-button type="button" x-on:click="step = 2">Next</x-button>
                        </div>
                </div>

                <div x-show="step === 2" x-cloak>
                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Report Student
                    </h6>

                    <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                        Case Information
                    </h6>

                    <x-grid columns="2" gap="4" px="0" mt="4">
                        <div class="w-full px-4">
                            <x-label>
                                Minor Offenses
                            </x-label>
                            <x-selectdrop name="select" hidden-input-name="offenses_id"
                                wire:model="selectedMinorOffense">
                                @if ($minorOffenses)
                                    @foreach ($minorOffenses as $id => $minorOffense)
                                        <li x-on:click="selectedOption = '{{ $minorOffense }}'; open = false"
                                            data-value="{{ $id }}"
                                            class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            {{ $minorOffense }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="px-4 py-2">No minor offenses available.</li>
                                @endif
                            </x-selectdrop>
                        </div>

                        <div class="w-full px-4">
                            <x-label>
                                Grave Offenses
                            </x-label>
                            <x-selectdrop name="select" hidden-input-name="offenses_id"
                                wire:model="selectedGraveOffense">
                                @if ($graveOffenses)
                                    @foreach ($graveOffenses as $id => $graveOffense)
                                        <li x-on:click="selectedOption = '{{ $graveOffense }}'; open = false"
                                            data-value="{{ $id }}"
                                            class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                                            {{ $graveOffense }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="px-4 py-2">No grave offenses available.</li>
                                @endif
                            </x-selectdrop>
                        </div>
                    </x-grid>


                    <x-grid columns="3" gap="4" px="0" mt="4">
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Observation
                                </x-label>
                                <x-input type="text" name="offenses" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Desired
                                </x-label>
                                <x-input type="text" name="offenses" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Outcome
                                </x-label>
                                <x-input type="text" name="offenses" />
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
                                <x-input type="text" name="offenses" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Remarks
                                </x-label>
                                <x-input type="text" name="offenses" />
                            </div>
                        </div>
                        <div class="w-full px-4">
                            <x-label>Letter</x-label>
                            <input type="file"
                                class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                              file:bg-transparent file:border-0
                              file:bg-gray-100 file:mr-4
                              file:py-2.5 file:px-4">
                        </div>
                    </x-grid>


                    <h6 class="text-sm my-6 px-4 font-bold uppercase ">
                        Actions Taken
                    </h6>


                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
                        @foreach ($actions as $id => $label)
                            <div class="relative mb-3">
                                <div class="flex items-center space-x-2">
                                    <x-checkbox wire:model="selectedActions" value="{{ $id }}" />
                                    <x-label>{{ $label }}</x-label>
                                </div>
                            </div>

                            @if ($loop->iteration % 4 === 0)
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
                        @endif
                        @endforeach

                    </div>

                    <div class="flex justify-end mx-4 mt-2 space-x-2">
                        <x-button type="button" x-on:click="step = 1">Previous</x-button>
                        <x-button type="submit">Submit</x-button>
                    </div>
                    </form>
                </div>
            </div>

        </x-slot>

    </x-form>



    @if ($selectedResult)
        @if ($recentReports && $recentReports->count() > 0)
            <x-table>
                <x-slot name="header">
                    <th class="px-4 py-3">Student Name</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Case Status</th>
                    <th class="px-4 py-3">Anecdotal</th>
                </x-slot>
                @foreach ($recentReports as $report)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $report->anecdotal->student->first_name }} {{ $report->anecdotal->student->last_name }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($report->user)
                                {{ $report->user->name }}
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            {{ $report->case_status }}
                        </td>
                        <td class="px-4 py-3">
                            <x-link target="_blank"
                                href="{{ url('adviser/student/anecdotal/' . $report->anecdotal->id) }}">
                                View</x-link>

                        </td>
                    </tr>
                @endforeach
            </x-table>
        @else
            <div class="flex justify-center">
                <h1 class="text-center">No Reports Found For This Student</h1>
            </div>
        @endif
    @endif
