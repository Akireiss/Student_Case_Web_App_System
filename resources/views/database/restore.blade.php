@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row space-y-4 lg:space-x-2 container mx-auto mt-20">

    <!-- Restore Database Form -->
    <div class="flex-1">
        <div class="bg-white p-6 shadow rounded-lg">
            <h6 class="text-md my-1  font-bold uppercase mt-3">Database have not found or have been corrupted</h2>
            <h6 class="text-md my-1  font-bold uppercase mt-1">Upload a new database</h2>

            @if (session('success'))
                <div class="bg-green-200 p-2 rounded text-green-700 mb-2">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-200 p-2 rounded text-red-700 mb-2">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('restore.database') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <x-label for="new_database_name">Database Name: <span class="text-red-500">(e.g., MyDatabase_01-2023)</span></x-label>
                    <input type="text" required name="database_name" id="new_database_name" class="border rounded p-2 w-full"/>
                    @error('database_name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
                </div>
                <div class="mb-4">
                    <x-label for="sql_file">Upload SQL File:</x-label>
                    <input type="file" required name="sql_file" id="sql_file"
                        class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                        file:bg-transparent file:border-0
                        file:bg-gray-100 file:mr-4
                        file:py-2.5 file:px-4">

                @error('sql_file')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
                </div>
                <p class="font-medium text-sm text-gray-600 hover:text-gray-900
                rounded-md focus:outline-none
                focus:ring-2 focus:ring-offset-2
                 focus:ring-indigo-500">Database already repaired? <a href="/" class="underline">Click here</a></p>

                <div class="flex justify-end">
                    <x-button type="submit">Create Database</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
