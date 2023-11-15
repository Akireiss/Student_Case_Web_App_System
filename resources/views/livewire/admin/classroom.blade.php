<div>

    <div x-data="{ showTable: true, showForm: false }">
    <div x-show="showTable">
        <div class="flex items-center justify-between my-2">
            <h6 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
                {{-- List Of Students --}}
            </h6>
            <div class="flex justify-end  mt-4">
                <x-button x-on:click="showTable = false; showForm = true">
                    Add
                </x-button>
            </div>
        </div>
        <div>
            <livewire:classroom-table/>
        </div>
    </div>

    <div x-cloak x-show="showForm">
        <x-form title="">
            <x-slot name="actions">
                <x-button x-on:click="showForm = false; showTable = true">
                    Back
                </x-button>
            </x-slot>

            <x-slot name="slot">
                <form wire:submit.prevent="saveClassroom" method="POST">



                    <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
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
                                <x-input wire:model="section"/>
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

                    <div class="flex justify-end items-center px-4 mt-4">
                        <x-text-alert />
                        <div wire:loading wire:target="saveClassroom" class="mx-4">
                            Loading...
                        </div>
                        <x-button type="submit" wire:loading.attr="disabled">Add Classroom</x-button>
                    </div>
                    </form>



            </x-slot>

        </x-form>

    </div>
    </div>
</div>
