<div>
    <x-validation />
    <x-flashalert />

            {{-- <div class="mx-auto">
                <div class="flex justify-between items-center ">
                    <h6 class="text-xl font-bold px-4 text-left ">
                    Report Student
                    </h6>

                </div>

                <div class="w-full mx-auto mt-6">
                    <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-lg rounded-lg border-0 ">

                        <div class="flex-auto px-6 lg:px-10 py-10 pt-0"> --}}


            <form wire:submit.prevent="store" enctype="multipart/form-data" >
                @csrf
                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Report Student
                </h6>
                <x-grid columns="2" gap="4" px="0" mt="0">

                    <div class="w-full px-4">


                        <div x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
                            <x-label for="studentName">
                                First Name
                            </x-label>
                            <div class="relative">
                                <x-input wire:model.debounce.300ms="studentName" @focus="isOpen = true"
                                    @click.away="isOpen = false" @keydown.escape="isOpen = false"
                                    @keydown="isOpen = true" type="text" id="studentName" name="studentName"
                                    placeholder="Start typing to search..." />
                                @error('studentId')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                                <span x-show="studentName !== ''" @click="studentName = ''; isOpen = false"
                                    class="absolute right-3 top-2 cursor-pointer text-red-600 font-bold">
                                    &times;
                                </span>
                                @if ($studentName && count($students) > 0)
                                    <ul class="bg-white border border-gray-300 mt-2 rounded-md w-full max-h-48 overflow-auto absolute z-10"
                                        x-show="isOpen">
                                        @foreach ($students as $student)
                                            <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                                                wire:click="selectStudent('{{ $student->id }}', '{{ $student->first_name }} ')"
                                                x-on:click="isOpen = false">
                                                {{ $student->first_name }} {{ $student->last_name }}
                                            </li>
                                        @endforeach
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
                            Minor Offenses
                        </x-label>
                        <x-select name="minor_offense_id" wire:model="minor_offenses_id">
                            <option value="" >Choose from below</option>
                            @if ($minorOffenses)
                                @foreach ($minorOffenses as $id => $minorOffense)
                                    <option value="{{ $id }}">{{ $minorOffense }} {{ $id }}</option>
                                @endforeach
                            @endif
                        </x-select>

                    </div>

                    <div class="w-full px-4">
                        <x-label>
                            Grave Offenses
                        </x-label>
                        <x-select name="grave_offense_id" wire:model="grave_offenses_id">
                            <option value="">Choose from below</option>
                            @if ($graveOffenses)
                                @foreach ($graveOffenses as $id => $graveOffense)
                                    <option value="{{ $id }}">{{ $graveOffense }} {{ $id }}</option>
                                @endforeach
                            @endif
                        </x-select>

                    </div>
                </x-grid>


                <x-grid columns="3" gap="4" px="0" mt="4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Observation
                            </x-label>
                            <x-input type="text" name="observation" wire:model="observation" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Desired
                            </x-label>
                            <x-input type="text" name="desired" wire:model="desired" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Outcome
                            </x-label>
                            <x-input type="text" name="outcome" wire:model="outcome" />
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
                            <x-input type="text" name="gravity" wire:model="gravity" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Remarks (Short Description)
                            </x-label>
                            <x-input type="text" name="short_description" wire:model="short_description" />
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


                <h6 class="text-sm my-6 px-4 font-bold uppercase">
                    Actions Taken
                </h6>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">

                    <div class="relative mb-3">
                        <div class="flex items-center space-x-2">
                            <x-checkbox wire:model="actions" value="Parent Teacher Meeting" />
                            <x-label>Parent Teacher Meeting</x-label>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mx-4 mt-2 space-x-2">
                    <x-button>Submit</x-button>
                </div>
            </form>

{{--
        </div>
    </div>
</div>
</div> --}}


<h6 class="text-lg font-bold px-4 text-left mb-3">
    Student Recent Cases
    </h6>
    <x-table>
        <x-slot name="header">
            <th class="px-4 py-3">Student Full Name</th>
            <th class="px-4 py-3">Cases</th>
        </x-slot>

        @if ($studentName && count($cases) > 0)
            @foreach ($cases as $case)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{ $studentName }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $case->case }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="px-4 py-3" colspan="2">No student selected.</td>
            </tr>
        @endif
    </x-table>

</div>
