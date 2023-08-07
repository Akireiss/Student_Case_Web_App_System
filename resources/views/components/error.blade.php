<!-- error-message.blade.php -->
@props(['fieldName'])

@error($fieldName)
    <span {{ $attributes->merge(['class' => 'text-red-500 text-sm']) }}>{{ $message }}</span>
@enderror
