@props(['name', 'placeholder'])

@php
  $id = $attributes->whereStartsWith('id')->first();
  $id = $id ? $id->start : Str::random(8);
@endphp

<div x-data="{ showPassword: false }">
  <input
    x-bind:type="showPassword ? 'text' : 'password'"
    {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) !!}
    placeholder="{{ $placeholder }}"
    id="{{ $id }}"
  />
  <button
    x-on:click="showPassword = !showPassword"
    class="absolute top-0 right-0 m-3 text-gray-500 focus:outline-none"
  >
    <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <!-- Eye icon SVG code -->
    </svg>
    <svg x-show="showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <!-- Eye-slash icon SVG code -->
    </svg>
  </button>
</div>
