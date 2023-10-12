<div>
    <x-form title="">
        <x-slot name="actions">
            <x-link>
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form wire:submit.prevent="updateClassroom">



                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Add New Classroom
                </h6>
                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            {{-- Label --}}
                            <x-label>Grade Level</x-label>
                            {{-- Input Select --}}
                            <x-select wire:model="grade_level" required>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                            </x-select>
                            <x-error fieldName="grade_level" />

                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Section</x-label>
                            <x-select wire:model="section" required>
                                    <option value="Jupiter">Jupiter</option>
                                    <option value="Akasya">Akasya</option>
                                    <option value="Earth">Earth</option>
                                    <option value="Sun">Sun</option>
                                    <option value="Neptune">Neptune</option>
                                    <option value="Pluto">Pluto</option>
                                    <option value="Venus">Venus</option>
                            </x-select>
                            <x-error fieldName="section" />

                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Adviser</x-label>
                            <x-select wire:model="employee_id" required>
                                @foreach ($employees as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </x-select>
                            <x-error fieldName="employee_id" />

                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Status</x-label>
                            <x-select wire:model="status" required>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>

                            </x-select>
                            <x-error fieldName="status" />

                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center">
                    <x-text-alert />
                    <div wire:loading wire:target="updateClassroom" class="mx-4">
                        Loading...
                    </div>
                    <x-button type="submit" wire:loading.attr="disabled">Update Classroom</x-button>
                </div>
                </form>



        </x-slot>

    </x-form>

</div>
