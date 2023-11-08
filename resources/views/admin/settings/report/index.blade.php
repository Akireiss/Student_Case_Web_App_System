@extends('layouts.dashboard.index')
@section('content')
    <div>
        {{-- Form --}}
        <x-form title="Grade: ">
            <x-slot name="actions">

                <x-link href="{{ url('admin/settings/classrooms') }}">
                    Back
                </x-link>
            </x-slot>

            <x-slot name="slot">

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Anecdotal Reports
                </h6>

                <form action="{{ route('generate.report.pdf') }}" method="get" target="_blank">
                    <!-- Your form fields for selecting classroom and offense category -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <!-- Classroom selection -->
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Classroom</x-label>
                                <x-select name="selectedClassroom" required>
                                    <!-- Options for classrooms -->
                                    <option value="All">All Classroom</option>
                                    @foreach ($classrooms as $class)
                                        <option value="{{ $class->id }}">Grade: {{ $class->grade_level }} {{ $class->section }}</option>
                                    @endforeach

                                </x-select>
                                <span class="text-red-500">
                                    @error('selectedClassroom')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <!-- Offense category selection -->
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Offense</x-label>
                                <x-select name="selectedCategory" required>
                                    <!-- Options for offense categories -->
                                    <option value="All">All</option>
                                    <option value="0">Minor</option>
                                    <option value="1">Grave</option>
                                </x-select>
                                <span class="text-red-500">
                                    @error('selectedCategory')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">School Year: <span class="text-green-500 text-sm">June(this year)-May(next-year)</span></x-label>
                                <x-select name="year" required>
                                    <option value="All">All Year</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>
                                    <option value="2023-2024">2023-2024</option>
                                </x-select>
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section" >Status</x-label>
                                <x-select name="status" required>
                                    <option value="All">All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Ongoing</option>
                                    <option value="2">Resolved</option>
                                    <option value="3">Follow Up</option>
                                    <option value="4">Refferal</option>
                                </x-select>
                            </div>
                        </div>



                    </div>
                    <div class="flex justify-end px-4">
                        <div class="relative mb-3">
                            <x-button type="submit">Generate PDF</x-button>
                        </div>
                    </div>
                </form>



            </x-slot>
        </x-form>
    </div>
@endsection
