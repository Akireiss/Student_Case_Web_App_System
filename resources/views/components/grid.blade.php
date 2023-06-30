@props(['columns' => '1', 'gap' => '6', 'px' => '4', 'mt' => '0'])

<div class="grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3
 lg:grid-cols-{{ $columns }} gap-{{ $gap }} px-{{ $px }} mt-{{ $mt }}">
    {{ $slot }}
</div>
