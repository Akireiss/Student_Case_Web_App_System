<div>
    <div class="mx-auto py-8">

        <h3 class="font-semibold mb-6 dark:text-gray-200 text-gray-600">Update your information here</h3>

        <div class="bg-white dark:bg-gray-800 rounded shadow-lg p-10 px-4 md:p-8 mb-6">
            <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 lg:grid-cols-3">


                <div class="text-gray-600 dark:text-gray-400">
                    <p class="font-medium text-lg dark:text-gray-200 text-gray-600">Personal Details</p>
                    <p className="dark:text-gray-400">Please fill out all the fields.</p>
                </div>


                <div class="lg:col-span-2">



                    <form wire:submit.prevent="update">
                        <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5">
                                <x-label for="full_name">Name</x-label>
                                <x-input type="text" wire:model="name" name="name" />
                            </div>

                            <div class="md:col-span-5">
                                <x-label for="email">Email Address</x-label>
                                <x-input type="email" wire:model="email" name="email" />
                            </div>

                            <div class="md:col-span-5 text-right">
                                <div class="inline-flex items-end">
                                    @if ($successMessage)
                                    <div class=" text-green-800 p-2">
                                        {{ $successMessage }}
                                    </div>
                                @endif
                                    <x-button type="submit" wire:loading.attr="disabled">
                                        Update
                                    </x-button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 lg:grid-cols-3  mt-5">
                <div class="text-gray-600 dark:text-gray-400">
                    <p class="font-medium text-lg dark:text-gray-200 text-gray-600">Password</p>
                    <p className="dark:text-gray-400">Update your password here.</p>
                </div>

                <div class="lg:col-span-2">
                    <div>
                        @if ($successMessage)
                        <div class=" text-green-800 p-2">
                            {{ $successMessage }}
                        </div>
                    @endif

                        <form wire:submit.prevent="updatePassword">
                            <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <x-label for="current_password">Current Password</x-label>
                                    <x-input type="password" wire:model="currentPassword" name="current_password" />
                                    @error('currentPassword') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="md:col-span-5">
                                    <x-label for="password">New Password</x-label>
                                    <x-input type="password" wire:model="newPassword" name="password" />
                                    @error('newPassword') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-5">
                                    <x-label for="password">Repeat Password</x-label>
                                    <x-input type="password" wire:model="passwordConfirmation" name="password_confirmation" />
                                    @error('passwordConfirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        @if ($successMessage)
                                        <div class=" text-green-800 p-2">
                                            {{ $successMessage }}
                                        </div>
                                    @endif
                                        <x-button type="submit" wire:loading.attr="disabled">
                                            Update
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
