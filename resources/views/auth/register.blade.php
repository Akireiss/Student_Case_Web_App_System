
@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

                                    <x-authentication-card>
                                        <x-slot name="logo">
                                            <x-authentication-card-logo />
                                        </x-slot>

                                        <x-validation-errors class="mb-4" />

                                        <section>
                                            <h3 class="font-bold text-2xl">Welcome </h3>
                                            <p class="text-gray-600 pt-2"> Register here.</p>
                                        </section>

                                        <form method="POST" action="{{ route('register') }}"  class="flex flex-col">
                                            @csrf

                                            <div class="mb-6 pt-3 rounded ">
                                                <x-label for="name" value="{{ __('Name') }}" />
                                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                                @error('name')
                                                <span class="text-red-500 text-sm mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>

                                            <div class="mb-6 pt-3 rounded ">
                                                <x-label for="email" value="{{ __('Email') }}" />
                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                                @error('email')
                                                <span class="text-red-500 text-sm mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>

                                            <div class="mb-6 pt-3 rounded ">
                                                <x-label for="password" value="{{ __('Password') }}" />
                                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                                @error('email')
                                                <span class="text-red-500 text-sm mt-1" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>

                                            <div class="mb-6 pt-3 rounded ">
                                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                            </div>

                                            <div class="flex items-center justify-end mt-4">
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900
                                                rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                                    {{ __('Terms and policies') }}
                                                </a>

                                                <x-button class="ml-4">
                                                    {{ __('Register') }}
                                                </x-button>
                                            </div>
                                        </form>
                                    </x-authentication-card>
                                    <div class="max-w-lg mx-auto text-center mt-12 mb-6">
                                        <p class="text-black">Already have an account? <a href="/login"
                                                class="font-bold hover:underline">Login</a>.</p>
                                    </div>
                       @endsection

