@extends('layouts.app')

@section('content')
<div class="flex flex-col h-screen justify-center items-center">
    <p class="text-xl mb-4">
       Welcome {{ $form->student->first_name }} {{ $form->student->middle_name }} {{ $form->student->last_name }}
    </p>

    <div class="mx-auto mt-4 flex flex-col items-center space-y-4 md:flex-row md:items-center md:space-y-0 md:space-x-8">
        @php
            $formId = $form;
        @endphp
        @if ($formId)
            <div class="text-center">
                <div>

                    <img class="w-48 h-48 mx-auto mb-2" src="data:image/png;base64,
                    {{ base64_encode(QrCode::format('png')->merge(public_path('logo.PNG'), 0.3, true)->size(200)
                ->generate(url('/student/profile/data/' . $form->id))) }}" alt="QR Code">
                {{-- <img src="{{ asset('assets/image/check.svg') }}" class="w-32 mx-auto" alt="Complete Image"> --}}
            </div>

            <div class="flex justify-center">
                <div class="flex flex-row space-x-3">
                    <x-button>Edit</x-button>
                    <x-button>View</x-button>
                </div>
            </div>

            </div>
        @else
           <div>
            No Data
           </div>
        @endif
    </div>
</div>



@endsection
