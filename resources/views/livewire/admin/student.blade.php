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
                <livewire:student-table />
            </div>
        </div>
        <div x-cloak x-show="showForm">
            <div>

                <x-form title="">
                    <x-slot name="actions">
                        <x-button x-on:click="showForm = false; showTable = true">
                            Back
                        </x-button>
                    </x-slot>

                    <form wire:submit.prevent="store">
                        <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
                            Add New Student
                        </h6>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>First Name</x-label>
                                    <x-input type="text" name="first_name" wire:model="first_name" required />
                                    <x-error fieldName="first_name" />
                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>Middle Name</x-label>
                                    <x-input type="text" name="middle_name" wire:model="middle_name" required />
                                    <x-error fieldName="middle_name" />
                                </div>
                            </div>


                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>Last Name</x-label>
                                    <x-input type="text" name="last_name" wire:model="last_name" required />
                                    <x-error fieldName="last_name" />
                                </div>
                            </div>
                        </div>


                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>Learners Reference Number</x-label>
                                    <x-input type="number" name="lrn" wire:model="lrn" required />
                                    <x-error fieldName="lrn" />
                                </div>
                            </div>


                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>Gender</x-label>
                                    <x-select name="gender" wire:model="gender" required>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </x-select>
                                    <x-error fieldName="gender" />
                                </div>
                            </div>


                        </div>


                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Classrooom</x-label>
                                <x-select name="classroom_id" wire:model="classroom_id" required>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">Grade:{{ $classroom->grade_level }}
                                            {{ $classroom->section }}</option>
                                    @endforeach
                                </x-select>
                                <x-error fieldName="classroom_id" />
                            </div>
                        </div>



                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label>Status</x-label>
                                    <x-select name="status" wire:model="status" required>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                        <option value="2">Graduate</option>
                                    </x-select>
                                    <x-error fieldName="status" />
                                </div>
                            </div>

                        </div>


                        <div class="flex justify-end items-center px-4 mt-4">
                            <x-text-alert />
                            <div wire:loading wire:target="store" class="mx-4">
                                Loading...
                            </div>
                            <x-button type="submit" wire:loading.attr="disabled">Add Student</x-button>
                        </div>
                    </form>
                </x-form>
            </div>
        </div>
    </div>
</div>
