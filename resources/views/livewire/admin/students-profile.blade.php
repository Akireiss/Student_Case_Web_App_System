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
                    <x-input />
                </div>





                  <div class="relative mb-3 px-4">
                    <x-label>
                        Municipality
                    </x-label>
                    <x-input />
                </div>




                  <div class="relative mb-3 px-4">
                    <x-label>
                        Barangay
                    </x-label>
                    <x-input />
                </div>





        </x-grid>




        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
            Family Background
        </h6>

        <x-grid columns="3" gap="4" px="0" mt="0">


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

    </x-slot>
</x-form>
</div>
