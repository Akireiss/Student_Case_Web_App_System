@extends('layouts.app')
@section('content')
    <x-authentication-card class="mt-36">

        <section>
            {{-- <h3 class="font-bold text-2xl">Login your account</h3> --}}
            {{-- <p class="text-gray-600 pt-2">Login to your account.</p> --}}
            <a href="/">
                <img src="assets/image/logo.png" alt="" class="w-40 mx-auto mb-2">
            </a>
        </section>

        <div>
            <p class="text-gray-600 pt-2 font-bold">Login here.</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col">
            @csrf

            <div class="mb-6 pt-3 rounded ">
                <x-label for="email">Email</x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
                @error('email')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="mb-6 pt-3 rounded ">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                @error('password')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        </section>
        </main>
    </x-authentication-card>

    <div class="max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-black">Don't have an account? <a href="/register" class="font-bold hover:underline">Register</a>.</p>
    </div>
@endsection
