<div>

    <x-form title="Add Students">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/students') }}">
Back

            </x-link>
        </x-slot>

        <form wire:submit="update">
            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Add New Student
            </h6>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>First Name</x-label>
                        <x-input type="text" name="first_name" wire:model="first_name" />
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



                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Learners Reference Number</x-label>
                        <x-input type="number" name="lrn" wire:model="lrn" required />
                        <x-error fieldName="lrn" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Classroom</x-label>
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
                        </x-select>
                        <x-error fieldName="status" />
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center space-x-2">
                <x-text-alert />
                <div wire:loading wire:target="update" class="mx-4">
                    Loading...
                </div>
                <x-button type="submit" wire:loading.attr="disabled">Update </x-button>
                 <x-button wire:click="deleteStudent({{ $student }})"
                 class="bg-red-500 hover:bg-red-700">Delete</x-button>
            </form>
        </div>
    </x-form>


</div>



