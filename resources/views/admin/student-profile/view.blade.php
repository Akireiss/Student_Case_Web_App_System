@extends('layouts.dashboard.index')
@section('content')
<div class="flex justify-end items-center space-x-2">
    <x-link target="_blank" class="bg-red-500"
    href="{{ route('generate-pdf', ['id' => $profile->id]) }}">
  PDF
</x-link>
<div>
    <x-link href="{{ url('admin/student-profile') }}">
        Back
    </x-link>

</div>
</div>

<div>

        <x-profile :profile="$profile" />

</div>

@endsection
