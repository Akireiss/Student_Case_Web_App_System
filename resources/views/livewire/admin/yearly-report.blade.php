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
@foreach ($groupedClassrooms as $gradeLevel => $classroom)
    <x-form title="">
        <x-slot name="actions"></x-slot>

        <x-slot name="slot">
            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Grade: {{ $gradeLevel }}
            </h6>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Grade Level</x-label>
                        <x-input disabled value="{{ $gradeLevel }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Male</x-label>
                        <x-input disabled value="{{ $selectedOption === 'High School' ?
                        $classroom->total_hs_male : $classroom->total_sh_male }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Female</x-label>
                        <x-input disabled value="{{ $selectedOption === 'High School' ?
                        $classroom->total_hs_female : $classroom->total_sh_female }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Total</x-label>
                        <x-input disabled value="{{ $classroom->total_students }}" />
                    </div>
                </div>
            </div>
        </x-slot>
    </x-form>
@endforeach


</div>
