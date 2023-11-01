<div>
    <x-form title="">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/offenses') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form wire:submit.prevent="update" >

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Update Offense
                </h6>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Offense Name
                            </x-label>
                            <x-input type="text" wire:model="offenses" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                              Category
                            </x-label>
                            <x-select wire:model="category">
                                <option value="0">Minor</option>
                                <option value="1">Grave</option>
                            </x-select>
                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                              Status
                            </x-label>
                            <x-select wire:model="status">
                                <option value="0" >Active</option>
                                <option value="1">Inactive</option>
                            </x-select>
                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Description
                            </x-label>
                            <x-textarea  rows="4" wire:model="story" required
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" wire:model="description">
                            </x-textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center">
                    <x-text-alert />
                    <div wire:loading wire:target="update" class="mx-4">
                        Loading...
                    </div>
                    <x-button type="submit" wire:loading.attr="disabled">Update </x-button>
                </div>
            </form>

        </x-slot>
    </x-form>
</div>
