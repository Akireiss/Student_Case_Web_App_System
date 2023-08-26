<x-grid columns="3" gap="4" px="0" mt="0">
    @foreach ($education as $i => $edu)
        <div class="w-full px-4">
            <h6 class="text-sm my-1 font-bold uppercase text-gray-500">
                Grade {{ $edu['grade_level'] }}
            </h6>
            <div class="relative mb-3">
                <x-label for="school_name">Name of school</x-label>
                <x-input wire:model="education.{{ $i }}.school_name" id="name" class="w-full" />
            </div>
            <div class="relative mb-3">
                <x-label for="section">Section</x-label>
                <x-input wire:model="education.{{ $i }}.grade_section" id="section" class="w-full" />
            </div>
            <div class="relative mb-3">
                <x-label for="school_year">School Year</x-label>
                <x-input wire:model="education.{{ $i }}.school_year" id="school_year" class="w-full" />
            </div>
        </div>
    @endforeach
</x-grid>
