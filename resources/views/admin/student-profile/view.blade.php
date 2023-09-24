@extends('layouts.dashboard.index')
@section('content')
<div class="flex justify-end mx-4 ">
    <x-link target="_blank" class="bg-red-500"
    href="{{ route('generate-pdf', ['id' => $profile->id]) }}">
  PDF
</x-link>
</div>

<div>

        <x-profile :profile="$profile" />

</div>

@endsection
