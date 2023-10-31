<div>



    <div class="mx-auto">
        <div class="flex items-center justify-between">
            <h6 class="text-xl font-bold px-4">
                {{-- Report Status : {{ $anecdotalData->getStatusTextAttribute() }} --}}
            </h6>
            <div class="flex justify-end">
                <x-link :href="url('admin/reports')">
                    Back
                </x-link>
            </div>
        </div>


        <div class="w-full mx-auto mt-6">
            <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

                <div class="flex-auto px-6 py-2 lg:px-10  pt-0">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                        Student Information
                    </h6>

                    <x-grid columns="2" gap="4" px="0" mt="0">

                        <div class="w-full px-4">

                            <div class="relative mb-3">
                                <x-label>
                                    Student Name
                                </x-label>
                                <x-input type="text" name="offenses"
                                    value="{{ $anecdotalData->student->first_name }}" disabled />

                            </div>

                        </div>


                        <div class="w-full px-4">
                            <x-label>
                                Grade Level
                            </x-label>
                            <x-input value=" Grade: {{ $anecdotalData->grade_level }}" disabled />
                        </div>


                    </x-grid>

                    <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                        Case Information
                    </h6>

                    <x-grid columns="2" gap="4" px="0" mt="4">



                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Referred By
                                </x-label>
                                @if ($anecdotalData->report->first())
                                    <x-input value="{{ $anecdotalData->report->first()->user->name }}" disabled />
                                @endif


                            </div>
                        </div>

                        <div class="w-full px-4">
                            <x-label>
                                Offenses
                            </x-label>
                            <x-input value="{{ $anecdotalData->offenses?->offenses ?? 'No Offenses Found' }}" disabled
                                disabled />
                            <span class="text-red-500 text-sm">
                                Offense type: {{ $anecdotalData->offenses->category === 0 ? 'Minor' : 'Grave' }}
                            </span>

                        </div>
                    </x-grid>



                    <x-grid columns="3" gap="4" px="0" mt="4">
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Observation
                                </x-label>
                                <x-input value="{{ $anecdotalData?->observation ?? 'No Observation' }}" disabled />


                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Desired
                                </x-label>
                                <x-input value="{{ $anecdotalData?->desired ?? 'No Desired Observation' }}" disabled />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Outcome
                                </x-label>
                                <x-input type="text" name="outcome" disabled
                                    value="{{ $anecdotalData?->outcome ?? 'No Outcome Observation' }}" />
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
                                    value="{{ $anecdotalData?->getGravityTextAttribute() ?? 'No Data' }}" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Remarks (Short Description)
                                </x-label>
                                <x-input disabled type="text"
                                    value="{{ $anecdotalData?->short_description ?? 'No Data' }}" />

                            </div>
                        </div>


                    </x-grid>





                    <div class="w-full px-4">

                        <x-label>Story</x-label>
                        <textarea id="message" rows="4" disabled
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                                    rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Write the story behind the report here">{{ $anecdotalData?->story ?? 'No Data' }}
                                </textarea>


                    </div>

                </div>



                <div class="mx-8">

                    <h6 class="text-sm my-6 px-4 font-bold uppercase">
                        Actions Taken
                    </h6>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6 px-4">
                        @if ($anecdotalData->actionsTaken->isNotEmpty())
                            @foreach ($anecdotalData->actionsTaken as $actions)
                                <div class="relative mb-3">
                                    <div class="flex items-center space-x-2">
                                        <x-checkbox checked disabled value="{{ $actions->actions }}" />
                                        <x-label>{{ $actions->actions }}</x-label>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-4">
                                <p class="mx-4 text-left text-gray-500">
                                    No Actions Taken
                                </p>
                            </div>
                        @endif
                    </div>


                </div>

                <div class="flex justify-end px-8">
                    @if (!$anecdotalData->case_status == 1)
                        <div class="flex items-center">
                            <span class="text-red-500 text-sm mr-2">
                                Accepting it will update the status to ongoing
                            </span>
                            <div wire:loading wire:target="acceptAnecdotal" class="mx-4">
                                Loading...
                            </div>
                            <x-button wire:click="acceptAnecdotal" wire:loading.attr="disabled">
                                Accept
                            </x-button>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>


    @if ($showMeetingOutcomeForm)
        {{-- Still need some adjustment --}}
        <div class="w-full mx-auto mt-6">
            <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

                <div class="flex-auto px-6 py-2 lg:px-10  pt-0">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                        Meeting Outcome Update
                    </h6>
                    <form wire:submit.prevent="update" enctype="multipart/form-data">
                        <x-grid :columns="$anecdotalData->case_status === 1 ? 2 : 2" gap="4" px="0" mt="4">


                            @if ($anecdotalData->case_status === 1)
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Meeting Outcome
                                    </x-label>
                                    <x-select wire:model="outcome" required >
                                        <option value="2">Resolved</option>
                                        <option value="3">Follow-up</option>
                                        <option value="4">Refferral</option>
                                    </x-select>
                                    <x-error fieldName="outcome" />

                                </div>
                            </div>
                            @else
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Meeting Outcome
                                    </x-label>
                                    <x-input value="{{ $anecdotalData->outcomes->getActionTextAttribute() }}" disabled/>
                                </div>
                            </div>
                            @endif


                            @if ($anecdotalData->case_status === 1)
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Remarks (Short Description)
                                    </x-label>
                                    <x-input wire:model="outcome_remarks" required />
                                    <x-error fieldName="outcome_remarks" />
                                </div>
                            </div>
                            @else
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Remarks (Short Description)
                                    </x-label>
                                    <x-input value="{{ $anecdotalData->outcomes->outcome_remarks }}" disabled/>

                                </div>
                            </div>
                            @endif




                        </x-grid>

                        <x-grid columns="2" gap="4" px="0" mt="4">

                            @if($anecdotalData->case_status === 1)
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Action Taken
                                    </x-label>
                                    <x-select name="action_id" wire:model="action" required>
                                        <option value="Parent Guidance Meeting">Parent Guidance Meeting</option>
                                        <option value="Anecdotal Collect">Anecdotal Collect</option>
                                        <option value="Reinforce expectations">Reinforce expectations</option>
                                        <option value="Notify Parents">Notify Parents</option>
                                    </x-select>
                                    <x-error fieldName="action" />

                                </div>
                            </div>
                            @else
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>
                                        Action Taken
                                    </x-label>
                                    <x-input value="{{ $anecdotalData->outcomes->action }}" disabled/>

                                </div>
                            </div>
                            @endif


                            @if ($anecdotalData->case_status === 1)
                                <div class="w-full px-4">
                                    <div class="relative mb-3">
                                        <x-label>
                                            Reminder to this case
                                        </x-label>
                                        <x-input type="date" wire:model.defer="reminderDays"
                                            min="{{ now()->toDateString() }}" />
                                    </div>
                                </div>
                            @endif


                         @if($anecdotalData->case_status === 1)
                         <div class="w-full px-4">
                            <x-label>Letter</x-label>
                            <input type="file" name="letter[]" wire:model="letter" multiple
                                class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                            file:bg-transparent file:border-0
                            file:bg-gray-100 file:mr-4
                            file:py-2.5 file:px-4">

                            <span class="text-red-500 text-sm">
                                Accepted file types: Images (JPEG, PNG)
                            </span>
                            <x-error fieldName="letter" />
                        </div>

                            @else
                            <div class="w-full px-4">
                                <x-label>Letter</x-label>
                                <input type="file" disabled
                                    class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                                file:bg-transparent file:border-0
                                file:bg-gray-100 file:mr-4
                                file:py-2.5 file:px-4">

                                <span class="text-red-500 text-sm">
                                    Accepted file types: Images (JPEG, PNG)
                                </span>

                            </div>
                            @endif

                        </x-grid>

                        <div class="w-full px-4">
                            <x-label>Images</x-label>
                            <div x-data="{ isZoomed: false }" x-clock class="flex space-x-2 mt-2 ">
                                @if ($anecdotalData->images->isNotEmpty())
                                    @foreach ($anecdotalData->images as $image)
                                        <div class="relative">
                                            <a href="{{ asset('storage/' . $image->images) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <img src="{{ asset('storage/' . $image->images) }}"
                                                    alt="Anecdotal Image"
                                                    class="w-32 h-32 object-cover border border-gray-200 rounded cursor-pointer">
                                            </a>

                                        </div>
                                    @endforeach
                                @else
                                    <div>
                                        <p class="font-medium text-sm text-gray-600 text-left">No Images Uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @if ($anecdotalData->case_status === 1 )

                        <div class="flex justify-end items-center">
                            <x-text-alert />
                            <div wire:loading wire:target="update" class="mx-5">
                                Loading...
                            </div>
                            <x-button type="submit" wire:loading.attr="disabled" wire:click="saveLetters">Resolved</x-button>
                        </div>

                    @elseif ($anecdotalData->case_status === 2)
                        <div class="flex justify-end items-center mx-4">
                            <p class="font-medium text-md text-green-500">
                                The case was resolved on {{ $anecdotalData->updated_at->format('F j, Y') }}
                            </p>
                        </div>
                    @elseif ($anecdotalData->case_status === 3)
                        <div class="flex justify-end items-center mx-4">
                            <p class="font-medium text-md text-green-500">
                                The case is still under follow-up, and the meeting occurred on {{ $anecdotalData->updated_at->format('F j, Y') }}
                            </p>
                        </div>
                    @elseif ($anecdotalData->case_status === 4)
                        <div class="flex justify-end items-center mx-4">
                            <p class="font-medium text-md text-green-500">
                                The case requires referral to another party.
                            </p>
                        </div>
                    @endif

                    </form>

                </div>

            </div>
        </div>
</div>

@endif




</div>
