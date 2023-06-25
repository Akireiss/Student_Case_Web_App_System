@props(['value'])


<label {{ $attributes->merge(['class' => 'block font-medium text-sm
 text-gray-600']) }}>
    {{-- dedault: text-gray-700 --}}
    {{ $value ?? $slot }}
</label>
