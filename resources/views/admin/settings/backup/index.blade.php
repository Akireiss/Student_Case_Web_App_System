@extends('layouts.dashboard.index')

@section('content')
<div class="flex flex-col lg:flex-row space-y-4 lg:space-x-2">
    <!-- Manual Backup Form -->
    <div class="flex-1">
        <div class="bg-white p-4 shadow rounded-lg mt-4">
              <h6 class="text-sm my-1  font-bold uppercase mt-3">Backup Current Database</h2>
            <form action="{{ route('manual.backup') }}" method="POST">
                @csrf
                <p>
                    Creating regular backups of your database is crucial for data integrity and system recovery.
                    In case of unexpected events or data loss, having a recent backup ensures that you can
                    restore your system to a known, stable state. Please follow the steps below to perform a
                    system backup:
                </p>
                    <li>Click the "Perform System Backup" button below.</li>
                    <li>Wait for the backup process to complete.</li>
                    <li>Download and store the backup file in a secure location.</li>

                <div class="flex justify-end mt-3 ">
                <x-button type="submit">Create Backup</x-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Restore Database Form -->
    <div class="flex-1">
        <div class="bg-white p-4 shadow rounded-lg">
              <h6 class="text-sm my-1  font-bold uppercase mt-3">Upload A New Database</h2>

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
                    <x-label for="new_database_name">Database Name: <span class="text-red-500">(e.g., MyDatabase_01-2023)</span></x-label>

                    <input type="text" name="database_name" id="new_database_name" class="border rounded p-2 w-full"/>
                </div>
                <div class="mb-4">
                    <x-label for="sql_file">Upload SQL File:</x-label>
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
                <div class="flex justify-end">
                    <x-button type="submit">Create Database</x-button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="bg-white p-4 shadow rounded-lg mt-4">
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
      <h6 class="text-sm my-1  font-bold uppercase mt-3">Change Database </h2>
    <form action="{{ route('change.database.name') }}" method="POST">
        @csrf
        <div class="mb-4">
            <x-label for="new_database_name">Your Database Name: {{ $currentDatabaseName }}</x-label>
<x-select name="new_database_name">
    @foreach ($filteredDatabases as $key => $dbName)
        <option value="{{ $dbName }}">{{ $dbName }}</option>
    @endforeach
</x-select>


        </div>
        @error('new_database_name')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
        <div class="flex justify-end">
        <x-button type="submit">Change Database</x-button>
        </div>
    </form>
</div>
{{-- <div class="container">
    <h2>List of Database Names</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Database Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($databaseNames as $key => $dbName)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $dbName }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

@endsection
