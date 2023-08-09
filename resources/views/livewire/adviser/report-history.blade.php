<x-form title="Report Information">
    <x-slot name="actions">
        <x-link :href="url('adviser/report/history')">
            Back
        </x-link>
    </x-slot>

    <x-slot name="slot">
        <form wire:submit.prevent="update"  enctype="multipart/form-data">
            @csrf
        <h6 class="text-sm my-3 px-4 font-bold uppercase ">
            Student Information
        </h6>
        <x-grid columns="2" gap="4" px="0" mt="0">

            <div class="w-full px-4 inline">
                <div x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
                    <x-label for="studentName">
                        First Name
                    </x-label>
                    <div class="relative">
                        <x-input wire:model.debounce.300ms="studentName" @focus="isOpen = true"
                            @click.away="isOpen = false" @keydown.escape="isOpen = false" @keydown="isOpen = true"
                            type="text" id="studentName" name="studentName"
                            placeholder="Start typing to search..." />

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
                                        wire:click="selectStudent('{{ $student->id }}', '{{ $student->first_name }} {{ $student->last_name }}')"
                                        x-on:click="isOpen = false">
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <input type="hidden" name="studentId" wire:model="studentId">
                </div>

                @if ($report->anecdotal->student)
                    Student Selected: <span class="mt-2">{{ $report->anecdotal->student->first_name }} {{ $report->anecdotal->student->last_name }}</span>
                @endif
            </div>


            <div class="w-full px-4">
                <x-label>
                    Referred By
                </x-label>
                <x-input  wire:model="user_id"
                 value="{{ $report->user?->name ?? 'No Reporter Found' }}" disabled/>
            </div>



        </x-grid>



        <h6 class="text-sm px-4 font-bold uppercase my-3">
            Case Information
        </h6>
        <x-grid columns="2" gap="4" px="0" mt="4">



            <div class="w-full px-4">
                <x-label>
                    Minor Offenses
                </x-label>
                <x-select name="minor_offense_id" wire:model="minor_offenses_id">
                    <option value="">Select an offense</option>
                    @foreach ($minorOffenses as $offenseId => $offenseName)
                        <option value="{{ $offenseId }}"
                            {{ $report->anecdotal->minor_offense_id == $offenseId ? 'selected' : '' }}>
                            {{ $offenseName }}
                        </option>
                    @endforeach
                </x-select>
                <x-error fieldName="minor_offenses_id" />

            </div>
            <div class="w-full px-4">
                <x-label>
                    Grave Offenses
                </x-label>
                <x-select name="grave_offense_id" wire:model="grave_offenses_id">
                    <option value="">Select an offense</option>
                    @foreach ($graveOffenses as $offenseId => $offenseName)
                        <option value="{{ $offenseId }}"
                            {{ $report->anecdotal->grave_offense_id == $offenseId ? 'selected' : '' }}>
                            {{ $offenseName }}
                        </option>
                    @endforeach
                </x-select>
                <x-error fieldName="grave_offenses_id" />

            </div>


        </x-grid>



        <x-grid columns="3" gap="4" px="0" mt="4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>
                        Observation
                    </x-label>
                    <x-input
                    wire:model="observation"
                    value="{{ $report->anecdotal?->observation ?? 'No Observation' }}" />

                        <x-error fieldName="observation" />

                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>
                        Desired
                    </x-label>
                    <x-input
                    wire:model="desired"
                    value="{{ $report->anecdotal?->desired ?? 'No Desired Observation' }}" />
                        <x-error fieldName="desired" />

                    </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>
                        Outcome
                    </x-label>
                    <x-input
                    wire:model="outcome"
                    type="text" name="outcome"
                        value="{{ $report->anecdotal?->outcome ?? 'No Outcome Observation' }}" />
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
                    <x-input
                    wire:model="gravity"
                    type="text" name="gravity" value="{{ $report->anecdotal?->gravity ?? 'No Data' }}" />
                        <x-error fieldName="gravity" />

                    </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>
                        Remarks (Short Description)
                    </x-label>
                    <x-input  wire:model="short_description"
                     type="text" value="{{ $report->anecdotal?->remarks ?? 'No Data' }}" />
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
                <div x-data="{ isZoomed: false }" x-clock>
                    @if ($report->anecdotal->letter)
                        <img src="{{ asset('storage/' . $report->anecdotal->letter) }}" alt="Letter Image"
                            class="w-32 h-32 object-cover border border-gray-200 rounded cursor-pointer"
                            @click="isZoomed = !isZoomed" x-bind:class="{ 'max-h-full max-w-full': isZoomed }">
                        <div x-show="isZoomed" @click.away="isZoomed = false"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-80">
                            <img src="{{ asset('storage/' . $report->anecdotal->letter) }}" alt="Zoomed Letter Image"
                                class="w-4/5 h-4/5 object-cover cursor-pointer" @click="isZoomed = !isZoomed">
                        </div>
                    @else
                        <p>No Letter Uploaded</p>
                    @endif
                </div>
            </div>



        </x-grid>


        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
            Actions Taken <x-error fieldName="selectedActions" />
        </h6>

        <x-grid columns="3" gap="4" px="0" mt="4">
            <div class="relative mb-3">
                <div class="flex items-center space-x-2">
                    @if ($report->anecdotal && $report->anecdotal->actionsTaken->isNotEmpty())
                        @foreach ($report->anecdotal->actionsTaken as $action)
                            <x-checkbox checked  wire:model="selectedActions" />
                            <x-label>{{ $action->actions }}</x-label>
                        @endforeach
                    @else
                        No Action Taken Found
                    @endif
                </div>
            </div>
        </x-grid>


        <div class="flex justify-end items-center">
            <x-text-alert />
            <div wire:loading wire:target="update" class="mx-4">
                Loading
            </div>
            <x-button type="submit" wire:loading.attr="disabled">Update</x-button>
        </div>
    </form>
    </x-slot>

    </div>

    </div>
</x-form>
