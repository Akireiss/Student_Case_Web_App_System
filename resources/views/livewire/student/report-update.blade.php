<div>



    <div class="mx-auto">
        <div class="flex items-center justify-between">
            <h6 class="text-xl font-bold px-4">
                Report Information
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
                            <div class="relative mb-3">
                                <x-label>
                                    Referred By
                                </x-label>
                                <x-input
                                    value="{{ $anecdotalData->report->first()?->user->name ?? 'No Reporter Found' }}"
                                    disabled />
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
                            <x-input value="{{ $anecdotalData->Minoroffenses?->offenses ?? 'No Offenses Found' }}"
                                disabled />
                        </div>

                        <div class="w-full px-4">
                            <x-label>
                                Grave Offenses
                            </x-label>
                            <x-input value="{{ $anecdotalData->Graveoffenses?->offenses ?? 'No Offenses Found' }}"
                                disabled />
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

                    <x-grid columns="3" gap="4" px="0" mt="4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Gravity of offense
                                </x-label>
                                <x-input disabled type="text" name="gravity"
                                    value="{{ $anecdotalData?->gravity ?? 'No Data' }}" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Remarks (Short Description)
                                </x-label>
                                <x-input disabled type="text" value="{{ $anecdotalData?->remarks ?? 'No Data' }}" />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <x-label>Letter</x-label>
                            <div x-data="{ isZoomed: false }">
                                @if ($anecdotalData->letter)
                                    <img src="{{ asset('storage/' . $anecdotalData->letter) }}" alt="Letter Image"
                                        class="w-32 h-32 object-cover border border-gray-200 rounded cursor-pointer"
                                        @click="isZoomed = !isZoomed"
                                        x-bind:class="{ 'max-h-full max-w-full': isZoomed }">
                                    <div x-show="isZoomed" @click.away="isZoomed = false"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-80">
                                        <img src="{{ asset('storage/' . $anecdotalData->letter) }}"
                                            alt="Zoomed Letter Image" class="w-4/5 h-4/5 object-cover cursor-pointer"
                                            @click="isZoomed = !isZoomed">
                                    </div>
                                @else
                                    <p>No Letter Uploaded</p>
                                @endif
                            </div>
                        </div>
                </div>



                </x-grid>

                <div class="px-4">

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

                </div>

                <div class="flex justify-end px-8">
                    @if (!$anecdotalData->case_status == 1)
                    <div class="flex items-center">
                        <span class="text-red-500 text-sm mr-2">
                            Accepting it will update the status to ongoing
                        </span>
                        <x-button wire:click="acceptAnecdotal" wire:loading.attr="disabled">
                           Accept
                        </x-button>
                    </div>
                    @endif
                </div>






                {{-- Additional Form Only shown When The butotn is click--}}
                @if ($showMeetingOutcomeForm)
                <div class="px-4">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                        Meeting Outcome Update
                    </h6>


                    <x-grid columns="3" gap="4" px="0" mt="4">


                        <div class="w-full px-4">
                            <div class="relative mb-3" wire:model="outcome">
                                <x-label>
                                    Update
                                </x-label>
                                <x-input  />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3" wire:model="outcome_remarks">
                                <x-label>
                                    Remarks (Short Description)
                                </x-label>
                                <x-input   />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Action Taken
                                </x-label>
                                <x-select name="action_id" wire:model="actions_id">
                                    <option value=""></option>
                                    @foreach ($actions as $action)
                                        <option value="{{ $action->id }}">
                                            {{ $action->action_taken }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>



                    </x-grid>


                    <div class="flex justify-end items-center">
                        <x-text-alert />
                        <div wire:loading wire:target="store" class="mx-4">
                            Loading
                        </div>
                        <x-button type="submit" wire:loading.attr="disabled"
                        wire:click="update"
                        >Update</x-button>
                    </div>

                </div>
                @endif


            </div>
        </div>
    </div>









</div>
