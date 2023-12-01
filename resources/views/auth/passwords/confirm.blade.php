@include('layouts.header')

<div class="flex justify-center items-center mt-24">
    <div class="max-w-lg mx-3 p-8 md:p-12 my-10 rounded-lg shadow-md w-full ">


    <section>

        <a href="/">
            <img src="{{ asset('assets/image/logo.png') }}" alt="phpyo" class="w-40 mx-auto mb-2">

        </a>
    </section>

    <div>
        <p class="text-gray-600 pt-2 font-bold">Please confirm your password before continuing</p>
    </div>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
    </div>
</div>

@include('components.footer')

