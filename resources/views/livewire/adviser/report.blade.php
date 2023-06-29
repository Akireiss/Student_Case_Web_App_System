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
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


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
                                                        {{ $result['first_name'] }}
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
                                        Offense Information
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
                        </div>

                        <div class="flex justify-end mx-4 mt-2">
                            <x-button type="button" x-on:click="step = 2">Next</x-button>
                        </div>
                </div>


                <div x-show="step === 2" x-cloak>

                  <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Report Student
                </h6>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">

                    <div class="w-full px-4">
                        <x-label>Offenses</x-label>
                        <div x-data="{ open: false, selectedOption: '' }" class="relative">
                            <div class="h-10 bg-white flex border border-gray-200 rounded items-center">
                                <div class="relative flex-grow">
                                    <input x-model="selectedOption" name="select" id="select" class="px-4 appearance-none outline-none text-gray-800 w-full" readonly />
                                    <input type="hidden" name="offenses_id" x-bind:value="selectedOption" /> <!-- Add a hidden input to store the selected offense ID -->
                                    <button @click="open = !open" class="absolute inset-y-0 right-0 px-2 text-gray-300 hover:text-gray-600">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <ul x-show="open" @click.away="open = false" class="absolute z-10 py-1 mt-1 overflow-auto bg-white rounded shadow-md border border-gray-200 max-h-48 w-full">
                                @foreach($offenses as $id => $offense)
                                <li x-on:click="selectedOption = '{{ $offense }}'; open = false"
                                data-value="{{ $id }}" class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                                {{ $offense }}</li>

                                @endforeach
                            </ul>
                        </div>
                    </div>

                      <div class="w-full px-4 ">
                        <x-label>
                          Offenses
                        </x-label>
                        <div x-data="{ open: false, selectedOption: '' }" class="relative">
                          <div class="h-10 bg-white flex border border-gray-200 rounded items-center">
                            <div class="relative flex-grow">
                              <input x-model="selectedOption" name="select" id="select" class="px-4 appearance-none outline-none text-gray-800
                               w-full" readonly />

                              <button @click="open = !open" class="absolute inset-y-0 right-0 px-2 text-gray-300 hover:text-gray-600">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                              </button>
                            </div>
                          </div>

                          <ul x-show="open" @click.away="open = false" class="absolute z-10 py-1 mt-1 overflow-auto bg-white rounded shadow-md border border-gray-200 max-h-48 w-full">
                            @foreach($offenses as $id => $offense)
                            <li x-on:click="selectedOption = '{{ $offense }}'; open = false"
                            data-value="{{ $id }}" class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                            {{ $offense }}</li>

                            @endforeach
                        </ul>

                        </div>
                      </div>
                  </div>

                      <h6 class="text-sm mt-4 mb-6 px-4 font-bold uppercase ">
                        Interventions Tried
                      </h6>

                      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 ">

                        <div>
                          <div class="relative mb-3">
                            <div class="flex items-center space-x-2">
                              <x-checkbox/>
                              <x-label>
                                Teacher-Student Conference
                              </x-label>
                            </div>
                          </div>
                        </div>

                        <div>
                          <div class="relative mb-3">
                            <div class="flex items-center space-x-2">
                                <x-checkbox/>
                              <x-label>
                                Notify Parent
                              </x-label>
                            </div>
                          </div>
                        </div>

                        <div>
                          <div class="relative mb-3">
                            <div class="flex items-center space-x-2">
                                <x-checkbox/>
                              <x-label>
                                Written Explanation
                              </x-label>
                            </div>
                          </div>
                        </div>

                        <div>
                          <div class="relative mb-3">
                            <div class="flex items-center space-x-2">
                                <x-checkbox/>
                              <x-label>
                                Document Action Taken
                              </x-label>
                            </div>
                          </div>
                        </div>

                        <div>
                          <div class="relative mb-3">
                            <div class="flex items-center space-x-2">
                                <x-checkbox/>
                              <x-label>
                                Parent-Teacher-Discipline Committe Conference
                              </x-label>
                            </div>
                          </div>
                        </div>

                        <div>
                          <div class="relative mb-3">
                            <div class="flex items-center space-x-2">
                                <x-checkbox/>
                              <x-label>
                                Written Agreement
                              </x-label>
                            </div>
                          </div>
                        </div>



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
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Student Name</th>
                                    <th scope="col" class="px-6 py-4">Date</th>
                                    <th scope="col" class="px-6 py-4">Case Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentReports as $report)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{ $report->anecdotal->student->first_name }} {{ $report->anecdotal->student->last_name }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if ($report->user)
                                                {{ $report->user->name }}
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ $report->case_status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-center">
            <h1 class="text-center">No Reports Found For This Student</h1>
        </div>
    @endif
@endif


    {{-- exception it only give bugs(may need in the future) --}}
    {{-- document.addEventListener('livewire:load', function () {
    Livewire.on('lastNameUpdated', function (lastName) {
        document.getElementById('last_name').value = lastName;
    });
}); --}}










