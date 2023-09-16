@extends('layouts.dashboard.index')
@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-semibold">Set a Reminder</h1>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mt-4">
            <ul class="list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('reminders.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <input type="text" name="description" id="description" class="border border-gray-300 p-2 w-full rounded">
        </div>
        <div class="mb-4">
            <label for="scheduled_at" class="block text-sm font-medium text-gray-700">Scheduled Time</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="border border-gray-300 p-2 w-full rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Set Reminder</button>
    </form>
</div>
@endsection
