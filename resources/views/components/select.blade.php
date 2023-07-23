@props(['selected' => null])

<select required {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 py-2.5 bg-gray-50
    focus:ring-indigo-500 rounded-md shadow-sm w-full text-gray-800']) }}>
  <option value="">Choose from below</option>
    {{ $slot }}
</select>
