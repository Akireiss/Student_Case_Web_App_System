@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-6 bg-gray-100 border-b border-gray-200">{{ __('Dashboard') }}</div>

                <div class="p-6">
                    @if (session('status'))
                        <div class="bg-green-200 text-green-800 p-4 rounded-lg mb-4">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mb-4">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Log out') }}
                        </button>
                    </form>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
