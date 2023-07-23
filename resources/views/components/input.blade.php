@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-50
border border-gray-300 text-gray-900 text-sm rounded-lg
focus:border-green-400 block w-full p-2.5
w-full']) !!} >

