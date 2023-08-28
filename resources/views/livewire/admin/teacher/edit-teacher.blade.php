<div>
    <x-form title="Add Students">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/teachers') }}">
                Back
            </x-link>
        </x-slot>
            <x-slot name="slot">


                <form wire:submit.prevent="update">
                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Add New Employee
                    </h6>

                    <!-- Personal information form fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Employee Name</x-label>
                                <x-input type="text" name="employees" wire:model="employees" required />
                                <x-error fieldName="employees" />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Employee Number</x-label>
                                <x-input type="text" name="refference_number"
                                    wire:model="refference_number" required  />
                                    <x-error fieldName="refference_number" />

                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Status</x-label>
                                <x-select name="status" wire:model="status" required >
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
                                </x-select>
                                <x-error fieldName="refference_number" />

                            </div>
                        </div>
                    </div>


                    <div class="flex justify-end items-center">
                        <x-text-alert />
                        <div wire:loading wire:target="update" class="mx-4">
                            Loading
                        </div>
                        <x-button type="submit" wire:loading.attr="disabled">Update</x-button>
                    </div>
                </form>
            </x-slot>
    </x-form>


</div>
