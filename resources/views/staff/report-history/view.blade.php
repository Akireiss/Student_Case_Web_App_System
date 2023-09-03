@extends('layouts.dashboard.index')
@section('content')
    <x-form title="Report Information">
        <x-slot name="actions">
            <x-slot name="actions">
                @if (auth()->user()->role === 0)

                <x-link :href="url('report/history')">
                  Back
              </x-link>
          @elseif(auth()->user()->role === 2)
              <x-link :href="url('adviser/report/history')">
                  Back
              </x-link>
              @endif
        </x-slot>

        <x-slot name="slot">
            <h6 class="text-sm my-3 px-4 font-bold uppercase ">
                Student Information
            </h6>
            <x-grid columns="2" gap="4" px="0" mt="0">

                <div class="w-full px-4">

                    <x-label>
                        Student Name
                    </x-label>
                    <x-input type="text" name="offenses"
                        value="{{ $report->anecdotal->student->first_name }} {{ $report->anecdotal->student->last_name }}"
                        disabled />
                </div>


                <div class="w-full px-4">
                    <x-label>
                        Referred By
                    </x-label>
                    <x-input value="{{ $report->user?->name ?? 'No Reporter Found' }}" disabled />
                </div>


                <div class="w-full px-4">


                    <x-label>
                        Grade Level
                    </x-label>
                    <x-input type="text" name="offenses"
                        value="{{ $report->anecdotal->student->classroom->grade_level }} {{ $report->anecdotal->student->classroom->section }}"
                        disabled />
                </div>


                <div class="w-full px-4">
                    <x-label>
                        Date Reffered
                    </x-label>
                    <x-input value="{{ $report ? $report->created_at->format('F j, Y') : 'No Data Found' }}" disabled />

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
                    <x-input value="{{ $report->anecdotal?->Minoroffenses?->offenses ?? 'No Offenses Found' }}" disabled />
                </div>

                <div class="w-full px-4">
                    <x-label>
                        Grave Offenses
                    </x-label>
                    <x-input value="{{ $report->anecdotal?->Graveoffenses?->offenses ?? 'No Offenses Found' }}" disabled />
                </div>
            </x-grid>



            <x-grid columns="3" gap="4" px="0" mt="4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Observation
                        </x-label>
                        <x-input value="{{ $report->anecdotal?->observation ?? 'No Observation' }}" disabled />


                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Desired
                        </x-label>
                        <x-input value="{{ $report->anecdotal?->desired ?? 'No Desired Observation' }}" disabled />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Outcome
                        </x-label>
                        <x-input type="text" name="outcome" disabled
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
                        <x-input disabled type="text" name="gravity"
                            value="{{ $report->anecdotal?->getGravityTextAttribute() ?? 'No Data' }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Remarks (Short Description)
                        </x-label>
                        <x-input disabled type="text" value="{{ $report->anecdotal?->remarks ?? 'No Data' }}" />

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
                                <x-checkbox checked disabled />
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
