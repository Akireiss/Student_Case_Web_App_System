<div>

    <div class="w-full px-4">
        <div x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
        <x-label for="studentName">
            First Name
        </x-label>
        <div class="relative">
            <x-input wire:model.debounce.300ms="studentName" @focus="isOpen = true"
            @click.away="isOpen = false" @keydown.escape="isOpen = false"
            @keydown="isOpen = true" type="text" id="studentName" name="studentName"
            placeholder="Start typing to search." />
            <x-error fieldName="studentName" /> <!-- Use the correct field name here -->
            <x-error fieldName="studentId" /> <!-- Use the correct field name here -->

            <span x-show="studentName !== ''" @click="studentName = ''; isOpen = false"
            class="absolute right-3 top-2 cursor-pointer text-red-600 font-bold">
            &times;
            </span>
            @if ($studentName && count($students) > 0)
                <ul class="bg-white border border-gray-300 mt-2 rounded-md w-full max-h-48 overflow-auto absolute z-10"
                    x-show="isOpen">
                    @foreach ($students as $student)
                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                            wire:click="selectStudent('{{ $student->id }}', '{{ $student->first_name }}')"
                            x-on:click="isOpen = false">
                            {{ $student->first_name }}  {{ $student->middle_name }} {{ $student->last_name }}
                        </li>
                        @endforeach
                        @elseif ($studentName)
                        <span class="text-red-500 text-sm">
                            No Student Found
                        </span>
                    </ul>
                    @endif
                </div>
                <input type="hidden" name="studentId" wire:model="studentId">
            </div>
</div>

        </div>
