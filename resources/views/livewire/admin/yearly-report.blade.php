<div>
<!-- resources/views/livewire/admin/yearly-report.blade.php -->

<div class="flex justify-end space-x-2">
    <div x-data="{ open: false }" class="relative inline-block text-left">
        <x-buttontype @click="open = !open">
            {{ $selectedOption }}
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 ml-2">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </x-buttontype>
        <ul x-show="open" @click.away="open = false" class="absolute z-50 mt-2 py-2 bg-white border border-gray-300 rounded-lg shadow-lg w-full">
            <li><a href="#" wire:click="$set('selectedOption', 'High School')"
                class="block px-4 py-2 text-gray-800
                 hover:bg-gray-500 hover:text-white">High School</a></li>
            <li><a href="#" wire:click="$set('selectedOption', 'Senior High')"
                 class="block px-4 py-2 text-gray-800 hover:bg-gray-500 hover:text-white">Senior High</a></li>
        </ul>
    </div>

    <div x-data="{ open: false }" class="relative inline-block text-left">
        <x-buttontype @click="open = !open">
            Year Level
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 ml-2">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </x-buttontype>
        <ul x-show="open" @click.away="open = false" class="absolute z-50 mt-2 py-2 bg-white border border-gray-300 rounded-lg shadow-lg w-full">
            <li><a href="#" class="block px-4 py-2 text-gray-800
                 hover:bg-gray-500 hover:text-white">High School</a></li>
        </ul>
    </div>

</div>


<div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">

    <form wire:submit.prevent="saveReport">
        @forelse($groupedClassrooms as $gradeLevel => $classroom)

        <div class="w-full">
            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Grade: {{ $gradeLevel }}
            </h6>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full px-4 hidden">
                    <div class="relative mb-3">
                        {{-- Label --}}
                        <x-label>Grade Level</x-label>
                        <x-input disabled value="{{ $gradeLevel }}" />
                    </div>
                </div>
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Male</x-label>
                        <x-input disabled wire:model="{{ $selectedOption === 'High School' ? 'groupedClassrooms.'
                         . $gradeLevel . '.total_hs_male' : 'groupedClassrooms.' . $gradeLevel . '.total_sh_male' }}" />
                    </div>
                </div>
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Female</x-label>
                        <x-input disabled wire:model="{{ $selectedOption === 'High School' ? 'groupedClassrooms.'
                        . $gradeLevel . '.total_hs_female' : 'groupedClassrooms.' . $gradeLevel . '.total_sh_female' }}" />
                    </div>
                </div>
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Total</x-label>
                        <x-input disabled wire:model="{{ $selectedOption === 'High School' ? 'groupedClassrooms.'
                        . $gradeLevel . '.total_students' : 'groupedClassrooms.' . $gradeLevel . '.total_students' }}" />
                    </div>
                </div>
            </div>
        </div>


        @empty
        <div>
            <p>
                No Classroom found
            </p>
        </div>
        @endforelse





        <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
            Other Information
          </h6>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <div class="w-full px-4">
            <div class="relative mb-3">
                <x-label>Category</x-label>
                <x-input disabled wire:model="selectedOption" />
            </div>
        </div>
        <div class="w-full px-4">
            <div class="relative mb-3">
                <x-label>Year Level</x-label>
                <x-input wire:model="yearLevel" />
            </div>
        </div>

        </div>

        <div class="flex justify-end items-center mx-4">
            <x-text-alert />
            <div wire:loading wire:target="saveReport" class="mx-4">
                Loading..
            </div>
            <x-button type="submit" wire:click="saveReport" wire:loading.attr="disabled">Save Report</x-button>
        </div>

        </form>



















</div>
