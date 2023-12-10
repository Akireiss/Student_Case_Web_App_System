@include('layouts.header')

<div class="flex justify-center items-center mt-24">
    <div class="max-w-lg mx-3 p-8 md:p-12 my-10 rounded-lg shadow-md w-full ">

        <section>
            <a href="/">
                <img src="assets/image/logo.png" alt="" class="w-40 mx-auto mb-2">
            </a>
            <p class="text-gray-600 pt-2 font-bold">Login here.</p>
        </section>

        <form method="POST" action="{{ route('login') }}" >
            @csrf

            <div class="mb-6 pt-3 rounded">
                <x-label for="email">Email</x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                @error('email')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @if(session('error'))
                <span class="text-red-500 text-sm mt-1" role="alert">
        {{ session('error') }}
                </span>
@endif

            </div>

            <div class="mb-6 pt-3 rounded">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button>
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>


    </div>


</div>

<div class="mx-auto text-center mb-6">
    <p class="text-black">Don't have an account? <a href="/register" class="font-bold hover:underline">Register</a>.</p>
</div>

@include('components.footer')
