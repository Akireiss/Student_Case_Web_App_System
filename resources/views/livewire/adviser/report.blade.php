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
                                    <input x-on:input.debounce.300ms="open = true" x-model="selected" wire:model.debounce.500ms="search" type="text" name="input" id="input"
                                        class="w-full border-2 border-gray-200 text-black rounded-lg py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500 transition-colors duration-300"
                                        placeholder="Type to search...">
                                </div>
                                <div x-show="open && selected.length >= 5" x-on:click.away="open = false" class="absolute z-50 w-full mt-2 bg-white rounded-md shadow-lg max-h-60 overflow-y-auto">
                                    @if ($searchResults && $searchResults->count() > 0)
                                        <ul class="rounded-md py-1 text-base leading-6 shadow-xs overflow-au text-black to focus:outline-none sm:text-sm sm:leading-5">
                                            @foreach ($searchResults as $result)
                                                <li x-on:click="selected = '{{ $result['first_name'] }}'; last_name = '{{ $result['last_name'] }}'; open = false; $wire.selectResult('{{ $result['first_name'] }}')"
                                                    class="cursor-pointer text-black select-none relative py-2 pl-3 pr-9 {{ $selectedResult == $result['first_name'] ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                                                    <span x-text="selected === '{{ $result['first_name'] }}' ? '✓' : ''"
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
                                <x-input type="text" name="offenses" wire:model="last_name" disabled/>
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
                    <x-button type="button"
                    x-on:click="step = 2">Next</x-button>
                    </div>
                </div>


                <div x-show="step === 2" x-cloak>

                    <h6 class="text-sm mt-3 mb-6 mx-4 font-bold uppercase">
                        Student Anecdotal
                        </h6>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        First Name
                                    </x-label>
                                    <x-input type="text" name="offenses" />
                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                      Last Name
                                    </x-label>
                                    <x-input type="text" name="offenses" />
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
                        <div class="flex justify-end mx-4 mt-2 space-x-2">
                    <x-button type="button" x-on:click="step = 1">Previous</x-button>
                    <x-button type="submit"
                  >Submit</x-button>
                        </div>
                  </form>
                </div>
              </div>

        </x-slot>
    </x-form>



</div>




{{-- exception it only give bugs(may need in the future) --}}
{{-- document.addEventListener('livewire:load', function () {
    Livewire.on('lastNameUpdated', function (lastName) {
        document.getElementById('last_name').value = lastName;
    });
}); --}}
