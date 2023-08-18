<div>
    <div class="container px-6 py-4 mx-auto">
        <div class="text-xl font-semibold text-gray-700">
            <a class="text-2xl font-bold transition-colors duration-300 transform text-green-400 lg:text-3xl dark:hover:text-green-500"
                href="{{ url('/') }}">CZCMNHS</a>
        </div>
    </div>

    <div class="pt-14 md:pt-24 p-0 md:p-5 container mx-auto text-center md:space-x-1">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center justify-center">
            <!-- Left Col -->
            <div class="flex flex-col w-full md:w-2/5 justify-center text-center md:text-center mx-auto">
                <p class="uppercase tracking-loose w-full md:text-center sm:text-lg">CASTOR Z. CONCEPCION MEMORIAL NATIONAL HIGH SCHOOL</p>
                <div class="hidden md:block text-sm text-center">
                    <h1 class="my-1 text-sm md:text-5xl font-bold leading-tight text-black">
                        A Happy School, Sustaining Excellence.
                    </h1>
                </div>
                <h1 class="my-1 text-sm md:text-5xl font-bold leading-tight text-black md:hidden">
                    A Happy School, Sustaining Excellence.
                </h1>
            </div>

            <div class="w-full md:w-3/5 py-3 text-center ">
                <img class="w-full md:w-1/2 z-50 mx-auto px-8 " src="{{ url('assets/image/form.svg') }}" />
            </div>
        </div>

        <div class="w-full px-4 inline">
            <div class="md:mx-72 mx-10">
                <x-label for="studentName">
                    Search your name here
                </x-label>
                <div class="relative">
                    <x-input wire:model.debounce.300ms="studentName" @focus="isOpen = true" @click.away="isOpen = false"
                        @keydown.escape="isOpen = false" @keydown="isOpen = true" type="text" id="studentName"
                        name="studentName" placeholder="Start typing to search..." />

                    <x-error fieldName="studentId" />

                    <span x-show="studentName !== ''" @click="clearStudent" class="absolute right-3 top-2 cursor-pointer text-red-600 font-bold">
                        &times;
                    </span>
                    <ul class="bg-white border border-gray-300 mt-2 rounded-md w-full max-h-48 overflow-auto absolute z-10"
                        x-show="isOpen">
                        @if (count($students) > 0)
                            @foreach ($students as $student)
                                <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                                    wire:click="selectStudent('{{ $student->id }}', '{{ $student->first_name }} {{ $student->last_name }}')"
                                    x-on:click="isOpen = false">
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </li>
                            @endforeach
                            @elseif ($studentName)
                            <li class="px-4 py-2 cursor-pointer text-gray-600">
                                No Student Found
                            </li>
                        @endif
                    </ul>

                    <input type="hidden" name="studentId" wire:model="studentId">
                </div>
            </div>
        </div>

    </div>


    @if ($showCreateLink)
    <div class="max-w-lg mx-auto text-center my-3">
        <p class="text-black text-center">
            Don't have a profile? <a target="_blank" href="{{ url('student/profile/create') }}" class="font-bold hover:underline">Create Here</a>.
        </p>
    </div>
    @endif

</div>
