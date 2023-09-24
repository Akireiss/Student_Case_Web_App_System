<div>

    <x-form title="">
        @guest
        <x-slot name="actions">
            <x-button onclick="window.history.back()">Back</x-button>
        </x-slot>

        @endguest

@auth

<x-slot name="actions">
    <x-link href="{{ url('adviser/students') }}">
        Back
    </x-link>
</x-slot>
@endauth

        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
            Student Information
        </h6>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>First Name</x-label>
                    <x-input type="text" name="first_name" required value="{{ $student->first_name }}" disabled />

                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Middle Name</x-label>
                    <x-input type="text" name="middle_name" required value="{{ $student->middle_name }}" disabled />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Last Name</x-label>
                    <x-input type="text" name="last_name" required value="{{ $student->last_name }}" disabled />

                </div>
            </div>



            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Learners Reference Number</x-label>
                    <x-input type="number" value="{{ $student->lrn }}" name="lrn" required disabled />
                </div>
            </div>

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Classroom</x-label>
                    <x-input required value="{{ $student->classroom->grade_level }}" disabled />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Status</x-label>
                    <x-input value="{{ $student->getStatusTextAttribute() }}" disabled />
                </div>
            </div>


        </div>



    </x-form>
</div>







@if ($student->anecdotal->isEmpty())
    <p class="text-green-500 text-center font-bold">No cases found for this student.</p>
@else
    <p class="text-left font-bold text-xl">Student Cases</p>

    @foreach ($student->anecdotal as $report)
        <x-form title="">
            <x-slot name="actions">
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
                        <x-input type="text" name="offenses" disabled
                            value="{{ $report->students->first_name }} {{ $report->students->last_name }}" disabled />
                    </div>


                    <div class="w-full px-4">
                        <x-label>
                            Referred By
                        </x-label>
                        <x-input disabled value="{{ $report->user?->name ?? 'No Reporter Found' }}" disabled />
                    </div>


                    <div class="w-full px-4">
                        <x-label>
                            Grade Level
                        </x-label>
                        <x-input type="text" name="offenses" disabled
                            value="{{ $report->students->classroom->grade_level }} {{ $report->students->classroom->section }}"
                            disabled />
                    </div>


                    <div class="w-full px-4">
                        <x-label>
                            Date Reffered
                        </x-label>
                        <x-input disabled
                            value="{{ $report ? $report->created_at->format('F j, Y') : 'No Data Found' }}" disabled />

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
                        <x-input disabled value="{{ $report->Minoroffenses?->offenses ?? 'No Offenses Found' }}"
                            disabled />
                    </div>

                    <div class="w-full px-4">
                        <x-label>
                            Grave Offenses
                        </x-label>
                        <x-input disabled value="{{ $report->Graveoffenses?->offenses ?? 'No Offenses Found' }}"
                            disabled />
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
                            <x-input value="{{ $report->desired ?? 'No Desired Observation' }}" disabled />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Outcome
                            </x-label>
                            <x-input type="text" name="outcome" disabled
                                value="{{ $report->outcome ?? 'No Outcome Observation' }}" />
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
                                value="{{ $report->getGravityTextAttribute() ?? 'No Data' }}" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Remarks (Short Description)
                            </x-label>
                            <x-input disabled type="text" value="{{ $report->remarks ?? 'No Data' }}" />

                        </div>
                    </div>

                    <div class="w-full px-4">
                        <x-label>Letter</x-label>
                        <div x-data="{ isZoomed: false }" x-clock>
                            @if ($report->letter)
                                <img src="{{ asset('storage/' . $report->letter) }}" alt="Letter Image"
                                    class="w-32 h-32 object-cover border border-gray-200 rounded cursor-pointer"
                                    @click="isZoomed = !isZoomed" x-bind:class="{ 'max-h-full max-w-full': isZoomed }">
                                <div x-show="isZoomed" @click.away="isZoomed = false"
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-80">
                                    <img src="{{ asset('storage/' . $report->letter) }}" alt="Zoomed Letter Image"
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
                        <div class="flex items-center space-x-2 mx-4">
                            @if ($report && $report->actionsTaken->isNotEmpty())
                                @foreach ($report->actionsTaken as $action)
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
    @endforeach
@endif
