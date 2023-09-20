@extends('layouts.app')
@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="mx-auto container lg:w-1/2 mt-36 ms:px-4">
    <x-form title="">
        <x-slot name="actions">
            <x-link href="{{ url('student/form') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">

            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Login using the last four digits of your LRN
            </h6>

            <form method="POST" action="{{ route('student.auth', ['profileId' => $profileId]) }}">


                @csrf

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Last Four Digits of LRN</x-label>
                        <x-input name="lrn" type="text" required autofocus />
                    </div>
                </div>

                <input type="hidden" name="profileId" value="{{ $profileId }}">

                <div class="w-full px-4 flex justify-end">
                   <x-button>
                    Login
                   </x-button>
                </div>
            </form>


        </x-slot>
    </x-form>
</div>

@endsection
