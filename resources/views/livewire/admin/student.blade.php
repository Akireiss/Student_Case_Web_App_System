<div>

<div x-data="{ showTable: true, showForm: false }">
    <!-- Table Section -->
    <div x-show="showTable">
        <div class="flex items-center justify-between my-6">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
        Students
            </h4>
        <div class="flex justify-end  mt-4">
            <x-button x-on:click="showTable = false; showForm = true">
                Add
            </x-button>
        </div>
        </div>

        <div>
            <livewire:student-table/>
        </div>
        <!-- Add Button to show the Form -->

    </div>
    <!-- Form Section -->
    <div x-cloak x-show="showForm">
        <x-flashalert />
        <div>

            <x-form title="Add Students">
                <x-slot name="actions">
                    <x-button x-on:click="showForm = false; showTable = true">
                        Back
                    </x-button>
                </x-slot>

            <form wire:submit.prevent="store">
                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Add New Employee
                </h6>

                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>First Name</x-label>
                            <x-input type="text" name="first_name" wire:model="first_name" />
                            @error('last_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Last Name</x-label>
                            <x-input type="text" name="last_name" wire:model="last_name" />
                            @error('last_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Learners Refference Number</x-label>
                            <x-input type="text" name="lrn"
                                wire:model="lrn" />
                            @error('lrn')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Classrooom</x-label>
                            <x-select name="classroom_id" wire:model="classroom_id">
                                    @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">Grade 8 Akasya</option>
                                    @endforeach
                            </x-select>
                            @error('classroom_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
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
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button type="submit">Add</x-button>
                </div>
            </form>
            </x-form>
        </div>
    </div>
</div>
</div>
