<div>

    <div class="mx-auto py-8">

        {{-- <h3 class="font-semibold mb-6  text-gray-600">Add New User</h3> --}}

        <div class="bg-white  rounded shadow-lg p-10  px-4 md:p-8 mb-6 ">

            <form wire:submit.prevent="store"
            x-data="{ showPassword: false, passwordMismatch: false }"
            x-on:submit="checkPasswordsMatch()"
            >
                <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600 ">
                        <p class="font-medium text-lg  text-gray-600">Personal Details</p>
                        <p className="">Please fill out all the fields. </p>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 ">
                            <div class="md:col-span-5">
                                <x-label for="full_name">Name</x-label>
                                <x-input type="text" wire:model="name" required/>
                                <x-error fieldName="name" />

                            </div>

                            <div class="md:col-span-5">
                                <x-label for="email">Email Address</x-label>
                                <x-input type="text" wire:model="email" type="email" required />
                                <x-error fieldName="email" />

                            </div>

                        </div>
                    </div>
                </div>

                <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 lg:grid-cols-3 mt-5">
                    <div class="text-gray-600 ">
                        <p class="font-medium text-lg  text-gray-600">Password</p>
                        <p class="">Create your password here.</p>
                    </div>

                    <div class="lg:col-span-2">

                        <div class="grid gap-4 gap-y-4 text-sm grid-cols-1 md:grid-cols-5">

                            <div class="md:col-span-5">
                                <x-label>Password</x-label>
                                <div class="relative">

                                    <x-input type="password" id="password" wire:model="password"
                                     name="password" x-bind:type="showPassword ? 'text' : 'password'"
                                        required autocomplete="new-password"  minlength="8" />
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
                                <x-error fieldName="password" />

                            </div>



                            <div class="md:col-span-5 " x-data="{ showAdviserType: {{ $role === 2 ? 'true' : 'false' }} }">
                                <x-label for="user_type" value="{{ __('User Type') }}" />
                                <x-select required id="user_type" wire:model="role"
                                    x-on:change="showAdviserType = (event.target.value === '2')">
                                    <option value="0">User</option>
                                    <option value="2">Adviser</option>
                                    <option value="1">Admin</option>
                                </x-select>
                                <x-error fieldName="role" />

                                <div x-show="showAdviserType" class="py-3">
                                    <x-label for="adviser_type" value="{{ __('Classroom') }}" />
                                    <x-select id="adviser_type" wire:model="classroom_id">
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">Grade: {{ $classroom->grade_level }}
                                                {{ $classroom->section }} </option>
                                        @endforeach
                                    </x-select>
                                    <x-error fieldName="classroom_id" />
                                </div>
                            </div>
                            <div class="md:col-span-5">
                                <x-label for="user_type" value="{{ __('Status') }}" />
                                <x-select required id="user_type" wire:model="status">
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
                                </x-select>
                                <x-error fieldName="status" />

                            </div>


                        </div>

                        <div class="flex justify-end items-center mt-5">
                            <x-text-alert />
                            <div wire:loading wire:target="store" class="mx-4">
                                Adding User...
                            </div>
                            <x-button type="submit" wire:loading.attr="disabled">Add User</x-button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
