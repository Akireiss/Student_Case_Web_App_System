@include('layouts.header')

<div class="flex justify-center items-center mt-24">
    <div class="max-w-lg mx-3 p-8 md:p-12 my-10 rounded-lg shadow-md w-full ">

    <section>

        <a href="/">
            <img src="{{ asset('assets/image/logo.png') }}" alt="phpyo" class="w-40 mx-auto mb-2">
        </a>
    </section>

    <div>
        <p class="text-gray-600 pt-2 font-bold">Send confirmation here</p>
    </div>


    @if (session('status'))
        <div class="text-green-500 text-sm" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-6 pt-3 rounded">
            <x-label for="email">{{ __('Email Address') }}</x-label>

            <div class="col-md-6">
                <x-input id="email" type="email"
                    class="form-control
                                 @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4 flex justify-end">
                <x-button type="submit">
                    {{ __('Send Password Reset Link') }}
                </x-button>
            </div>
        </div>
    </form>

    </div>
</div>


@include('components.footer')
