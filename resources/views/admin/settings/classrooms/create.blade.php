@extends('layouts.dashboard.index')
@section('content')
{{-- Form --}}
    <x-form title="Add Classroom">
        <x-slot name="actions">
            {{-- Button --}}
            <x-link href="{{ url('admin/settings/classrooms') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form action="{{ route('admin.classroom.store') }}" method="POST">
                @csrf


                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Add New Classroom
                </h6>
                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            {{-- Label --}}
                            <x-label>Grade Level</x-label>
                            {{-- Input Select --}}
                            <x-select name="grade_level">
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Section</x-label>
                            <x-select name="section">
                                    <option value="Jupiter">Jupiter</option>
                                    <option value="Akasya">Akasya</option>
                                    <option value="Earth">Earth</option>
                                    <option value="Sun">Sun</option>
                                    <option value="Neptune">Neptune</option>
                                    <option value="Pluto">Pluto</option>
                                    <option value="Venus">Venus</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Adviser</x-label>
                            <x-select name="employee_id">
                                @foreach ($employees as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
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
