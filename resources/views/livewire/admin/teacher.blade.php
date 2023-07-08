<div>
    <div x-data="{ showTable: true, showForm: false }">
        <!-- Table Section -->
        <div x-show="showTable">
            <div class="flex items-center justify-between my-6">
                <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
                    Teacher
                        </h4>
                        <div class="flex-grow flex justify-end">
                <x-button x-on:click="showTable = false; showForm = true">
                    Add
                </x-button>
                        </div>
            </div>

            <div class="text-gray-700">
                <livewire:employee-table />
            </div>

        </div>
        <!-- Form Section -->
        <div x-cloak x-show="showForm">

            <x-flashalert />

            <div>
                <!-- Back Button to show the Table -->
                <x-form title="Add Students">
                    <x-slot name="actions">
                        <x-button x-on:click="showForm = false; showTable = true">
                            Back
                        </x-button>
                    </x-slot>
                    <x-slot name="slot">


                        <form wire:submit.prevent="store">
                            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                                Add New Employee
                            </h6>

                            <!-- Personal information form fields -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="w-full px-4">
                                    <div class="relative mb-3">
                                        <x-label>Employee Name</x-label>
                                        <x-input type="text" name="employees" wire:model="employees" />
                                        @error('employees')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="w-full px-4">
                                    <div class="relative mb-3">
                                        <x-label>Employee Number</x-label>
                                        <x-input type="text" name="refference_number"
                                            wire:model="refference_number" />
                                        @error('refference_number')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="w-full px-4">
                                    <div class="relative mb-3">
                                        <x-label>Status</x-label>
                                        <x-select name="status" wire:model="status">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </x-select>
                                        @error('status')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <x-button type="submit">Add</x-button>
                            </div>
                        </form>
            </div>


            </x-slot>
            </x-form>
        </div>
    </div>
</div>
</div>
