<div class="container mx-auto p-4">
    <div class="flex items-center lg:px-44 text-gray-600 hover:text-gray-900   ">
        <a href="#" class="text-2xl font-bold text-green-500 ">
            CZCMNHS
        </a>
    </div>

    <div class="pt-14 md:pt-24 container mx-auto text-center md:space-x-1">
        <div class="flex items-center justify-center px-3 mx-auto flex-col">
            <!-- Left Column -->
            <div class="w-full md:w-2/5 text-center md:text-center mx-auto flex flex-col justify-center">
                <p class="uppercase tracking-loose text-lg md:text-lg">CASTOR Z. CONCEPCION MEMORIAL NATIONAL HIGH SCHOOL</p>
                <div class="text-sm text-center md:text-4xl
                 leading-tight my-1 md:hidden  text-gray-600 font-semibold">
                    A Happy School, Sustaining Excellence.
                </div>
                <div class="hidden md:block text-sm text-center md:text-4xl font-bold leading-tight text-black my-1">
                    A Happy School, Sustaining Excellence.
                </div>
            </div>

            <div class="w-full md:w-3/5 text-center py-3">
                <img class="w-full md:w-1/2 z-50 mx-auto px-8" src="{{ url('assets/image/form.svg') }}" />
            </div>
        </div>

        <div class="w-full md:px-96 ">
            <div class="px-4" x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
                <x-label for="studentName">
                    Student Name
                </x-label>
                <div class="relative">
                    <x-input wire:model.debounce.300ms="studentName" @focus="isOpen = true"
                        @click.away="isOpen = false" @keydown.escape="isOpen = false"
                        @keydown="isOpen = true" type="text" id="studentName" name="studentName"
                        placeholder="Start typing to search." />
                    <x-error fieldName="studentName" />
                    <x-error fieldName="studentId" />

                    <span x-show="studentName !== ''" @click="studentName = ''; isOpen = false"
                        class="absolute right-3 top-2 cursor-pointer text-red-600 font-bold">
                        &times;
                    </span>

                    <ul class="bg-white border border-gray-300 mt-2 rounded-md w-full max-h-48 overflow-auto absolute z-10"
                        x-show="isOpen">
                        @if ($studentName && count($students) > 0)
                            @foreach ($students as $student)
                                <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                                    wire:click="selectStudent('{{ $student->id }}',
                                        '{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}')"
                                    x-on:click="isOpen = false">
                                    {{ $student->first_name }} {{ $student->middle_name }}
                                    {{ $student->last_name }}
                                </li>
                            @endforeach
                        @else
                            <div class="px-4 py-2 cursor-pointer hover:bg-gray-200 bg-white border border-gray-300 mt-2 rounded-md w-full">
                                No Student Found
                            </div>
                        @endif
                    </ul>
                </div>
                <input type="hidden" name="studentId" wire:model="studentId">
            </div>
        </div>
    </div>


    @if ($showCreateLink)
        <div class="max-w-lg mx-auto text-center my-3">
            <p class="text-center text-black">
                Don't have a profile? <a target="_blank" href="{{ url('student/profile/create') }}" class="font-bold hover:underline">Create Here</a>.
            </p>
        </div>
    @endif

    {{-- Form here to verify the lrn if it matches the student lrn --}}
</div>
