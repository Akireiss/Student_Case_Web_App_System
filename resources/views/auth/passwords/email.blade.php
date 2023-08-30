@include('layouts.header')

<x-authentication-card class="mt-36">

    <section>

        <a href="/">
            <img src="{{ asset('assets/image/logo.png') }}" alt="phpyo" class="w-40 mx-auto mb-2">
        </a>
    </section>

    <div>
        <p class="text-gray-600 pt-2 font-bold">Send confirmation here</p>
    </div>


    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="row mb-3">
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

</x-authentication-card>


@include('components.footer')
