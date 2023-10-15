@extends('layouts.app')

@section('content')

<div class="flex justify-center items-center mt-36 ">
    <div class="max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-md w-full">

        <section>
            <a href="/">
                <img src="{{ asset('assets/image/logo.png') }}" class="w-40 mx-auto mb-2">
            </a>
        </section>

        <div class="mx-4">
            <p class="text-gray-600 pt-2 font-bold">Login here.</p>
        </div>

        <form method="POST" action="{{ route('student.auth', ['profileId' => $profileId]) }}">
            @csrf

            <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>Last Four Digits of your LRN</x-label>
                    <x-input id="lrnInput" name="lrn" class="w-full"
                     type="number" required autofocus />
                    @if (session()->has('message'))
                        <span class="text-red-500 text-sm">
                            {{ session('message') }}
                        </span>
                    @endif
                </div>
            </div>

            <input type="hidden" name="profileId" value="{{ $profileId }}">

            <div class="w-full px-4 flex justify-end">
                <x-button>
                    Login
                </x-button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="mx-auto text-center mb-6">
    <p class="text-black">Don't have an account? <a href="/student/profile/create" class="font-bold hover:underline">Create here.</a>.</p>
</div>
@include('components.footer')

<script>
    const lrnInput = document.getElementById('lrnInput');

    lrnInput.addEventListener('input', function() {
        const inputValue = this.value;
        const sanitizedValue = inputValue.replace(/\D/g, '');
        if (sanitizedValue.length > 4) {
            this.value = sanitizedValue.slice(0, 4);
        }
    });
</script>

@endsection
