@extends('layouts.dashboard.index')
@section('content')
    <x-form title="Anecdotal">
        <x-slot name="actions">
            {{-- Button Here --}}
        </x-slot>

        <x-slot name="slot">
            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Student Anecdotal
            </h6>

            <h6 class="text-sm my-1 px-4 font-bold uppercase ">
                Case Information
            </h6>

            <x-grid columns="2" gap="4" px="0" mt="4">
                <div class="w-full px-4">
                    <x-label>
                        Minor Offenses
                    </x-label>
                    <x-input type="text" name="observation" disabled
                        value="{{ optional($anecdotal->Minoroffenses)->offenses }}" />
                </div>

                <div class="w-full px-4">
                    <x-label>
                        Grave Offenses
                    </x-label>

                    <x-input type="text" name="observation" disabled
                        value="{{ optional($anecdotal->Graveoffenses)->offenses }}" />
                </div>
            </x-grid>

            <x-grid columns="3" gap="4" px="0" mt="4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Observation
                        </x-label>
                        <x-input type="text" name="observation" disabled
                            value="{{ $anecdotal->observation ?? 'No observation' }}" />

                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Desired
                        </x-label>
                        <x-input type="text" name="observation" disabled
                            value="{{ $anecdotal->desired ?? 'No Desired' }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Outcome
                        </x-label>
                        <x-input type="text" name="observation" disabled value="{{ $anecdotal->outcome ?? '' }}" />

                    </div>
                </div>
            </x-grid>



            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Additional Information
            </h6>

            <x-grid columns="3" gap="4" px="0" mt="4">


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Gravity of offense
                        </x-label>
                        <x-input type="text" name="gravity" disabled value="{{ $anecdotal->gravity ?? '' }}" />

                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>
                            Remarks (Short Description)
                        </x-label>
                        <x-input type="text" name="short_description" disabled
                            value="{{ $anecdotal->short_description ?? '' }}" />
                    </div>
                </div>
                <div class="w-full px-4">
                    <x-label>Letter</x-label>
                    <input type="file" name="letter"
                        class="block w-full border border-gray-200 shadow-sm rounded-md text-sm
                              file:bg-transparent file:border-0
                              file:bg-gray-100 file:mr-4
                              file:py-2.5 file:px-4">
                </div>
            </x-grid>


            <h6 class="text-sm my-6 px-4 font-bold uppercase ">
                Actions Taken
            </h6>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
                @foreach ($actions as $action)
                    <div class="relative mb-3">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox" checked disabled>
                            <x-label>{{ $action->actions }}</x-label>
                        </div>
                    </div>
                    @if ($loop->iteration % 4 === 0)
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
                @endif
                @endforeach
            </div>





        </x-slot>
    </x-form>
@endsection
