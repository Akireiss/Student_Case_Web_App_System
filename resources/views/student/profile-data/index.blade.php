@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-screen justify-center items-center">
        <p class="text-xl mb-4 text-bold text-center  font-bold">
            {{ $form->student->first_name }} {{ $form->student->middle_name }} {{ $form->student->last_name }}
        </p>

        <p class="text-xl mb-4 text-bold text-center font-bold">
          Grade:{{ $form->student->classroom?->grade_level ?? "No Data"}}  {{ $form->student->classroom?->section  ?? "No Data"}}
        </p>
        <div class="mx-auto mt-4 flex flex-col items-center space-y-4 md:flex-row md:items-center md:space-y-0 md:space-x-8">
            @php
                $formId = $form;
            @endphp
            @if ($formId)
                <div class="text-center">

                    <div class="space-y-4">

                        <div class="bg-gray-100 shadow-md p-4 shadow-lg   ">
                            <img class="w-48 h-48 mx-auto mb-2"
                                src="data:image/png;base64,
        {{ base64_encode(
            QrCode::format('png')->merge(public_path('logo.PNG'), 0.3, true)->size(200)->generate(url('/student/profile/data/' . $form->id)),
        ) }}"
                                alt="QR Code">
                        </div>
                    </div>


                    <div class="flex mx-auto flex-row space-x-2 mt-2">

                        <x-button id="saveImageButton">
                            Save Image
                        </x-button>
                        {{-- the link:: a href="{{ url('/student/profile/data/') }}" --}}
                        <x-button id="saveImageButton">
                            Copy Link
                        </x-button>
                    </div>


                </div>
            @else
                <div>
                    No Data
                </div>
            @endif
        </div>



        <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white">
            <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                <a href="{{ url('student/profile/data/' .$form->id) }}" type="button"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-white " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-white ">Profile</span>
                </a>



                <a href="{{ url('student-profile/data/' . $form->id . '/edit') }}"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">


                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 mb-2 group-hover:text-white text-gray-500">
                        <path
                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                        <path
                            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                    </svg>



                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-white ">Edit</span>
                </a>
                <a href="{{ url('student/profile/data/' . $form->id . '/view') }}"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 mb-2 h-5 group-hover:text-white text-gray-500">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd"
                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-white ">View</span>
                </a>

                <a href="{{ url('student/view/cases/' . $form->student->id) }}"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  class="w-5 mb-2 h-5 group-hover:text-white text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                      </svg>


                    <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-white ">View</span>
                </a>
            </div>
        </div>


    </div>


    {{-- Need more revsion here --}}
    <script>
        document.getElementById('saveImageButton').addEventListener('click', function() {
            const qrCodeImage = document.querySelector('.w-48.h-48');
            const scaleFactor = 2;

            const canvas = document.createElement('canvas');
            canvas.width = qrCodeImage.width * scaleFactor;
            canvas.height = qrCodeImage.height * scaleFactor;
            const context = canvas.getContext('2d');
            context.drawImage(qrCodeImage, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png', 1.0);
            const link = document.createElement('a');
            link.href = dataURL;
            link.download = 'qr_code.png';
            link.click();
        });
    </script>
@endsection
