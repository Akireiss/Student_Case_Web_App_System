<div>
    <div class="mx-auto py-8">

        <h6 class="text-xl font-bold text-left ">
Update your information heress
        </h6>

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
                                <x-input type="text" wire:model="name" name="name" required />
                            </div>

                            <div class="md:col-span-5">
                                <x-label for="email">Email Address</x-label>
                                <x-input type="email" wire:model="email" name="email" />
                            </div>

                            <div class="md:col-span-5 text-right">

                                <div class="flex justify-end items-center">
                                    <x-text-alert />
                                    <div wire:loading wire:target="update" class="mx-4">
                                        Loading...
                                    </div>
                                    <x-button wire:loading.attr="disabled">Update</x-button>
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

                        <form wire:submit.prevent="updatePassword"
                        x-data="{ showPassword: false, passwordMismatch: false }"
                        x-on:submit="checkPasswordsMatch()"
                        >

                            <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <x-label for="current_password">Current Password</x-label>
                                    <div class="relative">
                                        <x-input type="password" id="current_password"
                                                 name="current_password" x-bind:type="showPassword ? 'text' : 'password'"
                                                 wire:model="currentPassword"
                                                 required autocomplete="current-password"  minlength="8" />
                                        <button type="button" @click="showPassword = !showPassword"
                                                class="absolute right-2 top-2.5 text-gray-600 focus:outline-none">
                                            <div x-show="!showPassword">
                                                <p class="text-sm text-red">show</p>
                                            </div>
                                        </button>

                                        <button type="button" @click="showPassword = !showPassword" x-show="showPassword"
                                                class="absolute right-2 top-2.5 text-gray-600 focus:outline-none">
                                            <div x-show="showPassword">
                                                <p class="text-sm text-red">hide</p>
                                            </div>
                                        </button>
                                    </div>
                                    @error('currentPassword') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>


                        <div class="md:col-span-5">
                                    <x-label>Password</x-label>
                                    <div class="relative">
                                        <x-input type="password" id="password"
                                         name="password" x-bind:type="showPassword ? 'text' : 'password'"
                                         wire:model="newPassword"
                                            required autocomplete="new-password"  minlength="8" />
                                            @error('newPassword') <span class="text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </div>

                                     <div class="md:col-span-5">
                                    <x-label label="password-confirmation">Repeat Password</x-label>
                                    <x-input type="password" id="repeat-password"   name="password_confirmation"
                                     wire:model="passwordConfirmation"
                                        x-bind:type="showPassword ? 'text' : 'password'" x-bind:class="{ 'border-red-500': passwordMismatch }"
                                        x-on:keyup="checkPasswordsMatch()" required autocomplete="new-password" />
                                        <p x-show="passwordMismatch" class="text-red-500 text-xs mt-1 ">Passwords do not match.</p>
                                        @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror

                                    </div>



                            </div>


                            <div class="flex justify-end items-center my-4">
                                <x-text-alert />
                                <div wire:loading wire:target="updatePassword" class="mx-4">
                                    Loading...
                                </div>
                                <x-button wire:loading.attr="disabled">Update</x-button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
