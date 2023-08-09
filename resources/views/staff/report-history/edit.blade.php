@extends('layouts.dashboard.index')
@section('content')
    <x-form title="Report Information">
        <x-slot name="actions">
            <x-link :href="url('adviser/report/history')">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
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
                                @click.away="isOpen = false" @keydown.escape="isOpen = false"
                                @keydown="isOpen = true" type="text" id="studentName" name="studentName"
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


                </div>



                <div class="w-full px-4">
                    <x-label>
                        Referred By
                    </x-label>
                    <x-input value="{{ $report->user?->name ?? 'No Reporter Found' }}"  />
                </div>


                <div class="w-full px-4">


                    <x-label>
                        Grade Level
                    </x-label>
                    <x-input type="text" name="offenses"
                        value="{{ $report->anecdotal->student->classroom->grade_level }} {{ $report->anecdotal->student->classroom->section }}"
                         />
                </div>


                <div class="w-full px-4">
                    <x-label>
                        Date Reffered
                    </x-label>
                    <x-input value="{{ $report ? $report->created_at->format('F j, Y') : 'No Data Found' }}"  />

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
                    <x-select name="minor_offense_id">
                        <option value="">Select an offense</option>
                        @foreach ($minorOffenses as $offenseId => $offenseName)
                            <option value="{{ $offenseId }}" {{ $report->anecdotal->minor_offense_id == $offenseId ? 'selected' : '' }}>
                                {{ $offenseName }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="w-full px-4">
                    <x-label>
                        Grave Offenses
                    </x-label>
                    <x-select name="grave_offense_id">
                        <option value="">Select an offense</option>
                        @foreach ($graveOffenses as $offenseId => $offenseName)
                            <option value="{{ $offenseId }}" {{ $report->anecdotal->grave_offense_id == $offenseId ? 'selected' : '' }}>
                                {{ $offenseName }}
                            </option>
                        @endforeach
                    </x-select>
                </div>


            </x-grid>



            <x-grid columns="3" gap="4" px="0" mt="4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Observation
                        </x-label>
                        <x-input value="{{ $report->anecdotal?->observation ?? 'No Observation' }}"  />


                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Desired
                        </x-label>
                        <x-input value="{{ $report->anecdotal?->desired ?? 'No Desired Observation' }}"  />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Outcome
                        </x-label>
                        <x-input type="text" name="outcome"
                            value="{{ $report->anecdotal?->outcome ?? 'No Outcome Observation' }}" />
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
                        <x-input  type="text" name="gravity"
                            value="{{ $report->anecdotal?->gravity ?? 'No Data' }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Remarks (Short Description)
                        </x-label>
                        <x-input  type="text" value="{{ $report->anecdotal?->remarks ?? 'No Data' }}" />

                    </div>
                </div>

                <div class="w-full px-4">
                    <x-label>Letter</x-label>
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
                Actions Taken
            </h6>

            <x-grid columns="3" gap="4" px="0" mt="4">
                <div class="relative mb-3">
                    <div class="flex items-center space-x-2">
                        @if ($report->anecdotal && $report->anecdotal->actionsTaken->isNotEmpty())
                            @foreach ($report->anecdotal->actionsTaken as $action)
                                <x-checkbox checked  />
                                <x-label>{{ $action->actions }}</x-label>
                            @endforeach
                        @else
                            No Action Taken Found
                        @endif
                    </div>
                </div>
            </x-grid>
        </x-slot>

        </div>

        </div>
    </x-form>


@endsection
