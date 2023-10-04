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
                                {{-- <x-input value="{{ $anecdotal->report->first()?->users->name ?? 'No Reporter Found' }}" --}}
                                    {{-- disabled /> --}}
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
                                <x-input disabled type="text" value="{{ $anecdotalData?->remarks ?? 'No Data' }}" />

                            </div>
                        </div>


                    </x-grid>
                    <x-grid columns="2" gap="4" px="0" mt="4">

                        <div class="w-full px-4">
                            <x-label>Letter</x-label>
                            <div x-data="{ isZoomed: false }" x-clock class="flex space-x-2 mt-2">
                                @if ($anecdotalData->images->isNotEmpty())
                                    @foreach ($anecdotalData->images as $image)
                                        <div class="relative">
                                            <a href="{{ asset('storage/' . $image->images) }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('storage/' . $image->images) }}" alt="Anecdotal Image"
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



                        <div class="w-full px-4">

                            <x-label>Story</x-label>
                                <textarea id="message" rows="4"  disabled
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                                    rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write the story behind the report here">{{ $anecdotalData?->story ?? 'No Data' }}
                                </textarea>


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
        <div class="w-full mx-auto mt-6">
            <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

                <div class="flex-auto px-6 py-2 lg:px-10  pt-0">
                    <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                       Meeting Outcome Update
                    </h6>

                    <x-grid columns="3" gap="4" px="0" mt="4">


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Meeting Outcome
                                </x-label>
                               <x-select wire:model="outcome">
                                <option value="Succesfull">Succesfull</option>
                                <option value="Follow-up">Follow-up</option>
                                <option value="Referral">Referral </option>
                               </x-select>
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Remarks (Short Description)
                                </x-label>
                                <x-input wire:model="outcome_remarks" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>
                                    Action Taken
                                </x-label>
                                <x-select name="action_id" wire:model="actions_id">
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
                        <div wire:loading wire:target="update" class="mx-4">
                            Loading...
                        </div>
                        <x-button type="submit" wire:loading.attr="disabled" wire:click="update">Resolved</x-button>
                    </div>

                </div>

            </div>
        </div>
</div>

@endif




</div>
