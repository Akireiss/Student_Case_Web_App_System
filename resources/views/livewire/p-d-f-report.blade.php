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
        <form>
        <!-- Personal information form fields -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full px-4">
                <div class="relative mb-3">
                    {{-- Label --}}
                    <x-label>Classroom</x-label>
                    <x-select wire:model="selectedClassroom">
                        <option value="All">All Classroom</option>
                        @foreach ($classrooms as $class)
                            <option value="{{ $class->id }}">Grade: {{ $class->grade_level }} {{ $class->section }}</option>
                        @endforeach
                    </x-select>

                </div>
            </div>


            <div class="w-full px-4">
                <div class="relative mb-3">
                        <x-label for="section">Offense</x-label>

<x-select wire:model="selectedCategory">
    <option value="All">All</option>
    <option value="1">Grave</option>
    <option value="0">Minor</option>
</x-select>

                </div>
            </div>


            {{-- <div class="w-full px-4">
                <div class="relative mb-3">
                    <x-label>School Year</x-label>
                    <x-select>

                    @foreach ($groupedAnecdotals as $academicYear => $anecdotals)

                        @foreach ($anecdotals as $anecdotal)
                            <option value="">{{ $anecdotal->created_at->format('Y-m-d') }}: {{ $anecdotal->content }}</li>
                        @endforeach

                @endforeach
            </x-select>

                </div>
            </div> --}}


        </div>
        <div class="flex justify-end">
            <div class="relative mb-3">

                <a href="#" wire:click="downloadPDF" target="_blank ">Download PDF</a>


                    {{-- <button wire:click="generatePDF">Generate Report</button> --}}

            </div>
        </div>



    </form>

    </x-slot>
</x-form>
</div>
