@extends('layouts.dashboard.index')

@section('content')
<section class="bg-gray-600">

<div class="container mx-auto">
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-4 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('students.store.export') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="csv_file" class="block font-bold text-lg mb-2">Upload CSV File:</label>
        <input type="file" name="csv_file" id="csv_file" class="border p-2 mb-4">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Import Students</button>
    </form>
</div>






<div class="container mx-auto">
    <form action="{{ route('students.export') }}" method="get">
        @csrf
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Export Students CSV</button>
    </form>
</div>




<div class="container mx-auto">
    <form action="{{ route('students.export.excel') }}" method="get">
        @csrf
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Export Students Exvcel</button>
    </form>
</div>


@endsection
