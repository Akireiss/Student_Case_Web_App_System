@props(['selected' => null])

<select {{ $attributes->merge(['class' => 'border border-gray-300 p-2 bg-gray-50
     rounded-md shadow-sm w-full text-gray-800']) }}>
<option selected value="">Choose from below</option>
    {{ $slot }}
</select>
