@extends('layouts.dashboard.index')
@section('content')
    <x-form title="Offenses Information">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/offenses') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">

            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Offense
            </h6>
            <!-- Personal information form fields -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Offense Name
                        </x-label>
                        <x-input type="text" disabled value="{{ $offense->offenses }}" name="offenses" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Status
                        </x-label>
                        <x-input type="text" disabled value="{{ $offense->getStatusTextAttribute() }}" />
                    </div>
                </div>


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Description
                        </x-label>
                        <x-textarea disabled name="description">
                            {{ $offense->description }}
                        </x-textarea>
                    </div>
                </div>
            </div>

        </x-slot>
    </x-form>
@endsection
