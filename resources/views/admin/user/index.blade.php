@extends('layouts.dashboard.index')

@section('content')
    <div class="mx-auto">
        <div class="flex justify-between items-center">
            {{-- <h6 class="text-xl font-bold text-left ">
                Users List
            </h6> --}}

        </div>
        <div>

          <livewire:admin.user.users-table />
        </div>

    </div>
@endsection
