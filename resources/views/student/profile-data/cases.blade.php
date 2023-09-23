@extends('layouts.dashboard.index')
@section('content')
    <div>
        <x-cases :student="$student"/>

    </div>

@endsection
