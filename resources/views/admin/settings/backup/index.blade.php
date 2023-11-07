@extends('layouts.dashboard.index')

@section('content')
    <div class="flex space-x-4">
        <!-- Manual Backup Form -->
        <div class="flex-1">
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold">Manual Backup</h2>
                <form action="{{ route('manual.backup') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-4">Perform System Backup</button>
                </form>
            </div>
        </div>

        <!-- Restore Database Form -->
        <div class="flex-1">
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold">Upload A New Database</h2>
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
                <form action="{{ route('restore.restore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="new_database_name" class="block">Database Name:</label>
                        <input type="text" name="new_database_name" id="new_database_name"
                            class="border rounded p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="sql_file" class="block">Upload SQL File:</label>
                        <input type="file" name="sql_file" id="sql_file"
                            class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                    file:bg-transparent file:border-0
                    file:bg-gray-100 file:mr-4
                    file:py-2.5 file:px-4">
                    </div>
                    @error('new_database_name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    @error('sql_file')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Create Database</button>
                </form>
            </div>
        </div>
    </div>


    <div class="bg-white p-4 shadow rounded-lg">
        @if (session('success'))
        <div class="bg-green-200 p-2 rounded text-green-700 mb-2">
            {{ session('success') }}
        </div>
    @endif

        <h2 class="text-lg font-semibold">Restore Your Database</h2>
        <form action="{{ route('change.database.name') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="new_database_name">Your Database Name:</label>
                <input type="text" name="new_database_name" id="new_database_name" class="border rounded p-2 w-full" required>
            </div>

            @error('new_database_name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Change Database Name</button>
        </form>
    </div>
@endsection
