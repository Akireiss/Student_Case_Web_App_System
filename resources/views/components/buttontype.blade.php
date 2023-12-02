<button {{ $attributes->merge(['type' => 'button', 'class' => 'border border-gray-300 px-4 py-1 bg-gray-50 hover:bg-gray-100
rounded-md shadow-sm text-gray-800 flex items-center']) }}>
    {{ $slot }}
</button>
