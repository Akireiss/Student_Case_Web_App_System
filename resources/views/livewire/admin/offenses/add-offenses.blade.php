<div>
    <x-form title="">
        <x-slot name="actions">

        </x-slot>

        <x-slot name="slot">
            <form wire:submit.prevent="create" >

                <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
                Create Offense
                </h6>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Offense Name<x-required/>
                            </x-label>
                            <x-input type="text" wire:model="offenses" />
                            <x-error fieldName="offenses" />

                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                              Category<x-required/>
                            </x-label>
                            <x-select wire:model="category">
                                <option value="0">Minor</option>
                                <option value="1">Grave</option>
                            </x-select>
                            <x-error fieldName="category" />

                        </div>
                    </div>


                                        <div class="w-full px-4">
                                            <div class="relative mb-3">
                                                <x-label>
                                                    Description<x-required/>
                                                </x-label>
                                                <x-textarea  rows="4" wire:model="story" required
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                    rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" wire:model="description">
                                                </x-textarea>
                                                <x-error fieldName="story" />

                                            </div>
                                        </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                              Status<x-required/>
                            </x-label>
                            <x-select wire:model="status">
                                <option value="0" >Active</option>
                                <option value="1">Inactive</option>
                            </x-select>
                            <x-error fieldName="status" />

                        </div>
                    </div>

                </div>

                <div class="flex justify-end items-center">
                    <x-text-alert />
                    <div wire:loading wire:target="create" class="mx-4">
                        Loading...
                    </div>
                    <div class="px-4 mt-3">

                        <x-button type="submit" wire:loading.attr="disabled">Create </x-button>
                    </div>
                </div>
            </form>

        </x-slot>
    </x-form>
</div>
