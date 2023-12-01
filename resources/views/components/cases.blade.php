
        <div>

            <x-form title="">
                <x-slot name="actions">
                    @if (auth()->user()->role === 1)
                    <x-link :href="url('admin/settings/students')">Back</x-link>
                @elseif (auth()->user()->role === 2)
                    <x-link :href="url('adviser/students')">Back</x-link>
                @endif
                </x-slot>



                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Student Information
                </h6>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Full Name</x-label>
                            <x-input type="text" name="first_name" required value="{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}" disabled />

                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Learners Reference Number</x-label>
                            <x-input type="number" value="{{ $student->lrn }}" name="lrn" required disabled />
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Classroom</x-label>
                            <x-input value="Grade: {{ $student->classroom->grade_level }} {{ $student->classroom->section }}" disabled />
                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Status</x-label>
                            <x-input value="{{ $student->getStatusTextAttribute() }}" disabled />
                        </div>
                    </div>


                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Total Cases: {{ $student->anecdotal->count() }}</x-label>
                            <x-input
                            value="Pending: {{ $student->anecdotal->where('case_status', 0)->count() }}, Ongoing: {{ $student->anecdotal->where('case_status', 1)->count() }}, Resolved: {{ $student->anecdotal->where('case_status', 2)->count()}}, Follow-Up {{ $student->anecdotal->where('case_status', 3)->count() }}, Reffer: {{ $student->anecdotal->where('case_status', 4)->count() }} " disabled />
                        </div>
                    </div>

                </div>



            </x-form>
        </div>



        @if ($student->anecdotal->isEmpty())
        <div class="flex justify-center items-center mx-4 ">
            <p class="font-medium text-md text-gray-600 ">
               No cases found
            </p>
        </div>
        @else

                <div class="w-full mx-auto mt-6">
                    <div class="relative flex flex-col min-w-0 py-4 break-words w-full mb-6 shadow-md rounded-lg border-0 ">


                        <div class="flex-auto px-6 py-2 lg:px-10  pt-0">
                            <h6 class="text-sm my-1  font-bold uppercase mb-2 ">
                                Student Cases
                            </h6>

                            @foreach ($student->anecdotal as $anecdotal)
                            <x-grid columns="4" gap="4" px="0" mt="0">


                                    <div class="relative mb-3">
                                        <x-label>
                                            Offense
                                        </x-label>
                                        <x-input type="text" name="offenses"
                                            value="{{ $anecdotal->offenses->offenses }}"
                                            disabled />
                                    </div>
                                    <div class="relative mb-3">
                                        <x-label>
                                            Gravity
                                        </x-label>
                                        <x-input type="text" name="offenses"
                                            value="{{ $anecdotal->getGravityTextAttribute() }}"
                                            disabled />
                                    </div>
                                    <div class="relative mb-3">
                                        <x-label>
                                            Case Status
                                        </x-label>
                                        <x-input type="text" name="offenses"
                                            value="{{ $anecdotal->student->getStatusTextAttribute() }}"
                                            disabled />
                                    </div>
                                    <div class="relative mb-3">
                                        <x-label>
                                            Date
                                        </x-label>
                                        <x-input type="text" name="offenses"
                                            value="{{ $anecdotal->created_at->format('F j, Y') }}"
                                            disabled />
                                    </div>

                                </x-grid>
                                <hr>
                                @endforeach
                        </div>
                    </div>
                </div>

                @endif







