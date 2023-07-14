<div>

    <x-form title="Add Student Profile">
        <x-slot name="actions">
            <x-link href="{{ url('admin/student-profile') }}">
                Back
            </x-link>
        </x-slot>
        <x-slot name="slot">

            <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 ">
                Personal Information
            </h6>
            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="w-full px-4">

                    <div class="relative mb-3">
                        <x-label>
                            First Name
                        </x-label>
                        <x-input />
                    </div>

                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                        Last Name
                    </x-label>
                    <x-input />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Middle Name
                    </x-label>
                    <x-input />
                </div>


                <div class="w-full px-4">

                    <div class="relative mb-3">
                        <x-label>
                            First Name
                        </x-label>
                        <x-input />
                    </div>

                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                        Suffix
                    </x-label>
                    <x-input />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Nickname
                    </x-label>
                    <x-input />
                </div>




                <div class="w-full px-4">

                    <div class="relative mb-3">
                        <x-label>
                            Age
                        </x-label>
                        <x-input />
                    </div>

                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Birthdate
                    </x-label>
                    <x-input />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Contaact Number
                    </x-label>
                    <x-input />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Middle Name
                    </x-label>
                    <x-input />
                </div>





                <div class="relative mb-3 px-4">
                    <x-label>
                        Middle Name
                    </x-label>
                    <x-input />
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Middle Name
                    </x-label>
                    <x-input />
                </div>




            </x-grid>
            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                Address
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        Province
                    </x-label>
                    <x-select class="form-control" id="city-select" wire:model="selectedCity">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                        @endforeach
                    </x-select>
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Municipality
                    </x-label>
                    <x-select class="form-control" id="municipality-select" wire:model="selectedMunicipality">
                        @foreach($municipalities as $municipality)
                            <option value="{{ $municipality->id }}">{{ $municipality->municipality }}</option>
                        @endforeach
                    </x-select>
                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                        Barangay
                    </x-label>
                    <x-select class="form-control" id="barangay-select" wire:model="selectedBarangay">
                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay->id }}">{{ $barangay->barangay }}</option>
                        @endforeach
                    </x-select>
                </div>


            </x-grid>




            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Family Background
            </h6>



            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Father
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">


                <div class="relative mb-3 px-4">
                    <x-label>
                        Name
                    </x-label>
                    <x-input />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Age
                    </x-label>
                    <x-input />
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Occupation
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Contaact No.
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Office Contact No.
                    </x-label>
                    <x-input />
                </div>
                <div class="relative mb-3 px-4">
                    <x-label>
Monthly Income
                    </x-label>
                    <x-input />
                </div>



            </x-grid>



            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                Place of birth
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        Province
                    </x-label>
                    <x-select>
                        <option>La Union</option>
                    </x-select>
                </div>





                <div class="relative mb-3 px-4">
                    <x-label>
                        Municipality
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Barangay
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>




            </x-grid>
            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                Workplace Address
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        Province
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>





                <div class="relative mb-3 px-4">
                    <x-label>
                        Municipality
                    </x-label>
                    <x-select>
                        <option>La Union</option>
                    </x-select>
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Barangay
                    </x-label>
                    <x-select>
                        <option>La Union</option>
                    </x-select>
                </div>

            </x-grid>

            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Mother
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">


                <div class="relative mb-3 px-4">
                    <x-label>
                        Name
                    </x-label>
                    <x-input />
                </div>



                <div class="relative mb-3 px-4">
                    <x-label>
                        Age
                    </x-label>
                    <x-input />
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Occupation
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Contaact No.
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Office Contact No.
                    </x-label>
                    <x-input />
                </div>
                <div class="relative mb-3 px-4">
                    <x-label>
Monthly Income
                    </x-label>
                    <x-input />
                </div>



            </x-grid>



            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                Place of birth
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        Province
                    </x-label>
                    <x-select>
                        <option>La Union</option>
                    </x-select>
                </div>





                <div class="relative mb-3 px-4">
                    <x-label>
                        Municipality
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Barangay
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>

            </x-grid>




            <div x-data="{ siblings: [] }">


                <div class="flex items-center justify-between mt-4 mx-4">
                    <h6 class="text-sm font-bold uppercase">
                        List down the names of Siblings that are studying at CZCMNHS?
                    </h6>
                    <div class="relative mb-3 px-4">
                    <x-button @click="siblings.push({ name: '', age: '' })">
                        Add Sibling
                    </x-button>

                        <x-button @click="siblings.pop()" class="bg-red-500 text-white">
                            Remove
                        </x-button>
                    </div>
                </div>


                <template x-for="(sibling, index) in siblings" :key="index">
                    <x-grid columns="3" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Name
                            </x-label>
                            <x-input x-model="sibling.name" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                Age
                            </x-label>
                            <x-input x-model="sibling.age" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                Grade and Section
                            </x-label>
                            <x-input x-model="sibling.gradeSection" />
                        </div>

                    </x-grid>
                </template>


            </div>


            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                You are currently living with:
            </h6>
            <x-grid columns="1 md:grid-cols-4" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-checkbox/>
                    <x-label class="inline-block">both Parents</x-label>
                </div>
                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Father only</x-label>
                </div>
                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Mother only</x-label>
                </div>
                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">N/A</x-label>
                </div>
            </x-grid>




            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                Parent are currently: (check which applies below)
            </h6>
            <x-grid columns="3" gap="4" px="0" mt="0">


                <div class="relative mb-3 px-4">
                    <x-checkbox  />
                    <x-label class="inline-block">Living together</x-label>
                </div>



                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Separated</x-label>
                </div>




                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Legally Separated</x-label>
                </div>



                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">With another partner</x-label>
                </div>


                <div class="relative mb-3 px-4">
                    <x-checkbox/>
                    <x-label class="inline-block">Father is OFW</x-label>
                </div>


                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Mother is OFW</x-label>
                </div>


            </x-grid>




            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        Guardian's Name
                    </x-label>
                    <x-input />
                </div>





                <div class="relative mb-3 px-4">
                    <x-label>
                        Relationship with the guardian
                    </x-label>
                    <x-input />
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                    Contact No.
                    </x-label>
                    <x-input />
                </div>


                <div class="relative mb-3 px-4">
                    <x-label>
                    Age
                    </x-label>
                    <x-input />
                </div>

            </x-grid>


            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500 ">
                Address
            </h6>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        Province
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>





                <div class="relative mb-3 px-4">
                    <x-label>
                        Municipality
                    </x-label>
                    <x-select >
                        <option>La Union</option>
                    </x-select>
                </div>




                <div class="relative mb-3 px-4">
                    <x-label>
                        Barangay
                    </x-label>
                    <x-select>
                        <option>La Union</option>
                    </x-select>
                </div>


</x-grid>




            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                Educational Background
            </h6>
            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                Grade 7
            </h6>



                <x-grid columns="3" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-label>
                        Name of school
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Section
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        School Year
                    </x-label>
                    <x-input />
                </div>
                </x-grid>


                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Grade 8
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-label>
                        Name of school
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Section
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        School Year
                    </x-label>
                    <x-input />
                </div>
                </x-grid>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Grade 9
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-label>
                        Name of school
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Section
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        School Year
                    </x-label>
                    <x-input />
                </div>
                </x-grid>

                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Grade 10
                </h6>

                <x-grid columns="3" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-label>
                        Name of school
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Section
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        School Year
                    </x-label>
                    <x-input />
                </div>
                </x-grid>




                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Grade 11
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                <div class="relative mb-3 px-4">
                    <x-label>
                        Name of school
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        Section
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        School Year
                    </x-label>
                    <x-input />
                </div>
            </x-grid>





                <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                    Grade 12
                </h6>
                <x-grid columns="3" gap="4" px="0" mt="0">
                    <div class="relative mb-3 px-4">
                        <x-label>
                            Name of school
                        </x-label>
                        <x-input />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            Section
                        </x-label>
                        <x-input />
                    </div>

                    <div class="relative mb-3 px-4">
                        <x-label>
                            School Year
                        </x-label>
                        <x-input />
                    </div>
                </x-grid>


            <div x-data="{ siblings: [] }">
                <div class="flex items-center justify-between mt-4 mx-4">
                    <h6 class="text-sm font-bold uppercase">
                        Name some of your Academic and Extra-Curricular Awards
                    </h6>
                    <div class="relative mb-3 px-4">
                    <x-button @click="siblings.push({ name: '', age: '' })" >
                        Add Award
                    </x-button>
                        <x-button @click="siblings.pop()" class="bg-red-500 text-white">
                            Remove
                        </x-button>
                    </div>
                </div>

                <template x-for="(sibling, index) in siblings" :key="index">
                    <x-grid columns="2" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Name of Award
                            </x-label>
                            <x-input x-model="sibling.name" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                Year Achieved
                            </x-label>
                            <x-input x-model="sibling.age" />
                        </div>
                    </x-grid>
                </template>
            </div>
        </x-grid/>


            <x-grid columns="3" gap="4" px="0" mt="0">

                <div class="relative mb-3 px-4">
                    <x-label>
                        What is your favorite subject/s:
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        What subject do you find difficult
                    </x-label>
                    <x-input />
                </div>

                <div class="relative mb-3 px-4">
                    <x-label>
                        What school organizations are you afiliated?
                    </x-label>
                    <x-input />
                </div>
            </x-grid>





            <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
               What do you plan to do after graduating Senior high School?
            </h6>
            <x-grid columns="3" gap="4" px="0" mt="0">


                <div class="relative mb-3 px-4">
                    <x-checkbox  />
                    <x-label class="inline-block">Go to College</x-label>
                </div>



                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Work as a skilled
                        worker</x-label>
                </div>




                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Pursue TESDA
                        certificates</x-label>
                </div>



                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Engage in
                        Business</x-label>
                </div>


                <div class="relative mb-3 px-4">
                    <x-checkbox/>
                    <x-label class="inline-block">Work to help
                        parents</x-label>
                </div>


                <div class="relative mb-3 px-4">
                    <x-checkbox />
                    <x-label class="inline-block">Undecided</x-label>
                </div>

            </x-grid>


            <div class="flex justify-end">
                <x-button>Submit</x-button>
            </div>


        </x-slot>
    </x-form>
</div>


@push('scripts')

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('municipalitiesUpdated', function (municipalities) {
            $('#municipality-select').empty();
            $('#municipality-select').append('<option value="">Select A Municipality</option>');

            municipalities.forEach(function (municipality) {
                $('#municipality-select').append('<option value="' + municipality.id + '">' + municipality.municipality + '</option>');
            });
        });

        Livewire.on('barangaysUpdated', function (barangays) {
            $('#barangay-select').empty();
            $('#barangay-select').append('<option value="">Select A Barangay</option>');

            barangays.forEach(function (barangay) {
                $('#barangay-select').append('<option value="' + barangay.id + '">' + barangay.barangay + '</option>');
            });
        });
    });
</script>

@endpush
