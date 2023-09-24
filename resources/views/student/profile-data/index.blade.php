@extends('layouts.app')

@section('content')
    <section class="pt-12 min-h-screen ">
        <div class="w-full lg:w-4/12 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-gray-100 w-full mb-6 shadow-xl rounded-lg mt-16">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center mt-6">
                        <div class="w-full px-4 flex justify-center">
                            <div class="relative">

                                @php
                                    $formId = $form;
                                @endphp
                                @if ($formId)
                                    <img src="data:image/png;base64,
        {{ base64_encode(
            QrCode::format('png')->merge(public_path('logo.PNG'), 0.3, true)->size(200)->generate(url('/student/profile/data/' . $form->id)),
        ) }}"
                                        alt="QR Code"
                                        class="shadow-md rounded-md  h-auto align-middle
                                    border-none">
                                @else
                                    <div>
                                        No Data
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="text-center mt-12">
                        <h3 class="text-xl font-semibold leading-normal text-gray-700 mb-2">
                            {{ $form->student->first_name }} {{ $form->student->last_name }}
                        </h3>
                        <div class="text-sm leading-normal mt-0 mb-2 text-gray-600 font-bold uppercase">
                            Grade:{{ $form->student->classroom?->grade_level ?? 'No Data' }}
                            {{ $form->student->classroom?->section ?? 'No Data' }}
                        </div>
                        <div class="text-sm leading-normal mb-2 text-gray-600 font-bold uppercase mt-10">
                            Castor Z. Concepcion Memorial National High School
                        </div>
                    </div>

                    <div class="w-full px-4 text-center mt-5 md:mt-5">
                        <div class="flex justify-center py-4 lg:pt-4 pt-8">

                            <a href="{{ url('student/profile/data/' . $form->id) }}" class="mr-4 p-3 text-center flex flex-col items-center ">
                                <span class="text-xl font-bold block uppercase tracking-wide text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-600 font-bold text-center mt-2 hover:border-b hover:border-green-500">Profile</span>
                            </a>


                            <a href="{{ url('student/profile/data/' . $form->id . '/view') }}" class="mr-4 p-3 text-center flex flex-col items-center">
                                <span class="text-xl font-bold block uppercase tracking-wide">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-600 font-bold hover:border-b hover:border-green-500">View</span>
                            </a>


                            <a href="{{ url('student-profile/data/' . $form->id . '/edit') }}" class="mr-4 p-3 text-center flex flex-col items-center">
                                <span class="text-xl font-bold block uppercase tracking-wide">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-600 font-bold hover:border-b hover:border-green-500">Edit</span>
                            </a>


                            <a href="{{ url('student/view/cases/' . $form->student->id) }}" class="lg:mr-4 p-3 text-center flex flex-col items-center">
                                <span class="text-xl font-bold block uppercase tracking-wide">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6 mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-600 font-bold hover:border-b hover:border-green-500">Cases</span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer class="relative  pt-8 pb-6 mt-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                        <div class="text-sm text-blueGray-500 font-semibold py-1">
                            © 2023 <a href="https://github.com/Akireiss/Student_Web_Case_CZCMHS" target="_blank"
                                class="hover:underline text-center">
                                Capstone Project</a> | Don Mariano Marcos Memorial State University</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
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
