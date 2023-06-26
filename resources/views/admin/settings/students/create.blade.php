@extends('layouts.dashboard.index')
@section('content')

<x-form title="Add Students">
    <x-slot name="actions">
        {{-- Button --}}
        <x-link href="{{ url('admin/settings/students') }}">
            Back
        </x-link>
    </x-slot>

    @if($errors->any())
    <div class="bg-red-400">
    @foreach ($errors->all() as $error )
    <div>{{ $error }}</div>
    @endforeach
    @endif

    <x-slot name="slot">
        <form action="{{ url('admin/settings/students/store') }}" method="POST">
            @csrf
            @method('POST')

            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Add New Students
            </h6>

            <!-- Personal information form fields -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            First Name
                        </x-label>
                        <x-input type="text" name="first_name" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Last Name
                        </x-label>
                        <x-input type="text" name="last_name" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Learner Reference Number
                        </x-label>
                        <x-input type="number" name="lrn"  />
                    </div>
                </div>


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Classroom</x-label>
                        <x-select name="classroom_id">
                            @foreach ($classrooms as $id => $classroom)
                                @if ($classroom)
                                    <option value="{{ $classroom->id }}">
                                        Grade: {{ $classroom->gradeLevel->grade_level }}
                                        {{ $classroom->section->name }}

                                    </option>
                                @endif
                            @endforeach
                        </x-select>
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Status</x-label>
                        <x-select name="status">
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </x-select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <x-button type="submit">Add</x-button>
            </div>
        </form>


        <!-- Add any additional sections or form fields here -->
    </x-slot>
</x-form>
@endsection
