<div>

    <x-form title="">
        <x-slot name="actions">
            @if (auth()->user()->role === 1)
                <x-link :href="url('admin/settings/students')">Back</x-link>
            @elseif (auth()->user()->role === 2)
                <x-link :href="url('adviser/students')">Back</x-link>
            @endif
        </x-slot>



        <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
            Student Information
        </h6>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Full Name</x-label>
                    <x-input type="text" name="first_name" required value="{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}" disabled />

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
                    <x-input value="Grade: {{ $student->classroom->grade_level }} {{ $student->classroom->section }}" disabled />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Status</x-label>
                    <x-input value="{{ $student->getStatusTextAttribute() }}" disabled />
                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Total Cases: {{ $student->anecdotal->count() }}</x-label>
                    <x-input
                    value="Pending: {{ $student->anecdotal->where('case_status', 0)->count() }}, Ongoing: {{ $student->anecdotal->where('case_status', 1)->count() }}, Resolved: {{ $student->anecdotal->where('case_status', 2)->count()}}, Follow-Up {{ $student->anecdotal->where('case_status', 3)->count() }}, Reffer: {{ $student->anecdotal->where('case_status', 4)->count() }} " disabled />
                </div>
            </div>

        </div>



    </x-form>
</div>


@if ($student->anecdotal->isEmpty())
<div class="flex justify-center items-center mx-4 ">
    <p class="font-medium text-md text-gray-600 ">
        {{-- No Cases Found --}}
    </p>
</div>
@else
    @foreach ($student->anecdotal as $anecdotal)
        <div class="w-full mx-auto mt-6">
            <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">


                <div class="flex-auto px-6 py-2 lg:px-10  pt-0">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mb-2 ">
                        Student Information
                    </h6>

                    <x-grid columns="2" gap="4" px="0" mt="0">

                        <div class="w-full px-4">

                            <div class="relative mb-3">
                                <x-label>
                                    Student Name
                                </x-label>
                                <x-input type="text" name="offenses"
                                    value="{{ $anecdotal->student->first_name }} {{ $anecdotal->student->middle_name }} {{ $anecdotal->student->last_name }}"
                                    disabled />
                            </div>

                        </div>

                        <div class="w-full px-4">
                            <x-label>
                                Grade Level
                            </x-label>
                            <x-input value="Grade: {{ $anecdotal->grade_level ?? 'No Data' }}" disabled />
                        </div>


                    </x-grid>

                    <h6 class="text-sm my-1 px-4 font-bold uppercase mb-2 ">
                        Case Information
                    </h6>

                    <x-grid columns="2" gap="4" px="0" mt="4">



                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Referred By
                                </x-label>
                                <x-input value="{{ $anecdotal->report->first()?->users->name ?? 'No Reporter Found' }}"
                                    disabled />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <x-label>
                                Grave Offenses
                            </x-label>
                            <x-input value="{{ $anecdotal->offenses?->offenses ?? 'No Offenses Found' }}" disabled />
                        </div>
                    </x-grid>



                    <x-grid columns="3" gap="4" px="0" mt="4">
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Observation
                                </x-label>
                                <x-input value="{{ $anecdotal?->observation ?? 'No Observation' }}" disabled />


                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Desired
                                </x-label>
                                <x-input value="{{ $anecdotal?->desired ?? 'No Desired Observation' }}" disabled />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Outcome
                                </x-label>
                                <x-input type="text" name="outcome" disabled
                                    value="{{ $anecdotal?->outcome ?? 'No Outcome Observation' }}" />
                            </div>
                        </div>
                    </x-grid>


                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                        Additional Information
                    </h6>

                    <x-grid columns="2" gap="4" px="0" mt="4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Gravity of offense
                                </x-label>
                                <x-input disabled type="text" name="gravity"
                                    value="{{ $anecdotal?->gravity ?? 'No Data' }}" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Remarks (Short Description)
                                </x-label>
                                <x-input disabled type="text"
                                    value="{{ $anecdotal?->short_description ?? 'No Data' }}" />

                            </div>
                        </div>

                    </x-grid>



                    <div class="w-full px-4">

                        <x-label>Story</x-label>
                        <textarea id="message" rows="4" wire:model="story"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                            rounded-lg border border-gray-300 "
                            disabled placeholder="Write the story behind the report here">{{ $anecdotal?->story ?? 'No Data' }}
                        </textarea>


                    </div>



                    <div>

                        <h6 class="text-sm my-6 px-4 font-bold uppercase">
                            Actions Taken
                        </h6>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">

                            <div class="relative mb-3">
                                <div class="flex items-center space-x-2">
                                    <x-checkbox wire:model="actions" checked disabled value="Parent Teacher Meeting" />
                                    <x-label>Parent Teacher Meeting</x-label>
                                </div>
                            </div>
                        </div>
                        @if ($anecdotal->case_status === 0)
                        <div class="flex justify-end items-center mx-4">
                            <p class="font-medium text-md text-gray-600">
                                Status: Case is still {{ $anecdotal->getStatusTextAttribute() }}
                            </p>
                        </div>
                    @endif




                        <hr class="my-3">

                        <div class="w-full mx-auto">
                            @if ($anecdotal->case_status == 2 || $anecdotal->case_status == 3 || $anecdotal->case_status == 4)
                                <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                                    Meeting Outcome
                                </h6>

                                <x-grid columns="2" gap="4" px="0" mt="4">
                                    <div class="w-full px-4">
                                        <div class="relative mb-3">
                                            <x-label>
                                                Meeting Outcomes
                                            </x-label>
                                            <x-input disabled
                                                value="{{ $anecdotal->actions?->getActionTextAttribute() ?? 'No Data' }}" />
                                        </div>
                                    </div>
                                    <div class="w-full px-4">
                                        <div class="relative mb-3">
                                            <x-label>
                                                Remarks (Short Description)
                                            </x-label>
                                            <x-input disabled
                                                value="{{ $anecdotal->actions?->outcome_remarks ?? 'No Data' }}" />
                                        </div>
                                    </div>

                                </x-grid>


                                <x-grid columns="2" gap="4" px="0" mt="4">
                                    <div class="w-full px-4">
                                        <div class="relative mb-3">
                                            <x-label>
                                                Action Taken
                                            </x-label>
                                            <x-input disabled
                                                value="{{ $anecdotal->actions?->action ?? 'No Data' }}" />
                                        </div>
                                    </div>

                                    <div class="w-full px-4">
                                        <x-label>Promissory Note</x-label>
                                        <div x-data="{ isZoomed: false }" x-clock class="flex space-x-2">
                                            @if ($anecdotal->images->isNotEmpty())
                                                @foreach ($anecdotal->images as $image)
                                                    <a href="{{ asset('storage/' . $image->images) }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <img src="{{ asset('storage/' . $image->images) }}"
                                                            alt="Anecdotal Image"
                                                            class="w-32 h-32 object-cover border border-gray-200 rounded cursor-pointer">
                                                    </a>
                                                @endforeach
                                            @else
                                                <div>
                                                    <p
                                                        class=" font-medium text-sm
                            text-gray-600 text-left">
                                                        No Images Uploaded</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </x-grid>



                                {{-- Update --}}

                                @if ($anecdotal->case_status === 2)
                                    <div class="flex justify-end items-center  mx-auto px-4 ">
                                        <p class="font-medium text-md text-gray-600">
                                            Status: Case has been resolved last
                                            {{ $anecdotal->outcomes->updated_at->format('F j, Y') }}
                                        </p>
                                    </div>
                                @elseif ($anecdotal->case_status === 0)
                                    <div class="flex justify-end items-center mx-4 ">
                                        <p class="font-medium text-md text-gray-600 ">
                                            Status: Case is still {{ $anecdotal->getStatusTextAttribute() }}
                                        </p>
                                    </div>
                                @elseif ($anecdotal->case_status === 1)
                                    <div class="flex justify-end items-center mx-4 ">
                                        <p class="font-medium text-md text-gray-600 ">
                                            Status: Case is in {{ $anecdotal->getStatusTextAttribute() }}
                                        </p>
                                    </div>
                                @elseif ($anecdotal->case_status === 3)
                                    <div class="flex justify-end items-center mx-4 ">
                                        <p class="font-medium text-md text-gray-600 ">
                                            Status: Case is will need some {{ $anecdotal->getStatusTextAttribute() }}
                                        </p>
                                    </div>
                                @elseif ($anecdotal->case_status === 4)
                                    <div class="flex justify-end items-center mx-4 ">
                                        <p class="font-medium text-md text-gray-600 ">
                                            Status: Case will need some {{ $anecdotal->getStatusTextAttribute() }}
                                        </p>
                                    </div>
                                @endif
                        </div>
    @endif

    </div>
    </div>
    </div>
    </div>
    </div>
@endforeach
@endif
