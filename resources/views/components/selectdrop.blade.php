<div x-data="{ open: false, selectedOption: '' }" class="relative">
    <div class="h-10 bg-white flex border border-gray-200 rounded items-center">
        <div class="relative flex-grow">
            <input x-model="selectedOption" name="{{ $name }}" id="{{ $name }}" placeholder="Select From List" class="px-4 appearance-none outline-none text-gray-800 w-full cursor-pointer" readonly @click="open = !open" />
            <input type="hidden" name="{{ $hiddenInputName }}" x-bind:value="selectedOption" /> <!-- Add a hidden input to store the selected option value -->
            <button @click="open = !open" class="absolute inset-y-0 right-0 px-2 text-gray-300 hover:text-gray-600">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
        </div>
    </div>
    <ul x-show="open" @click.away="open = false" class="absolute z-10 py-1 mt-1 overflow-auto bg-white rounded shadow-md border border-gray-200 max-h-48 w-full">
        {{ $slot }}
    </ul>
</div>
