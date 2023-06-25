@extends('layouts.dashboard.index')

@section('content')
    <x-form title="Edit Offenses">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/offenses') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form action="{{ route('admin.settings.offenses.update', $offense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Add New Offense
                </h6>
                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Offense Name
                            </x-label>
                            <x-input type="text" name="offenses" value="{{ $offense->offenses }}" />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Status
                            </x-label>
                            <x-select name="status">
                                <option value="0" @if($offense->status == 0) selected @endif>Active</option>
                                <option value="1" @if($offense->status == 1) selected @endif>Inactive</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>
                                Description
                            </x-label>
                            <x-textarea name="description">
                                {{ $offense->description }}
                            </x-textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button type="submit">Update</x-button>
                </div>
            </form>
        </x-slot>
    </x-form>
@endsection
