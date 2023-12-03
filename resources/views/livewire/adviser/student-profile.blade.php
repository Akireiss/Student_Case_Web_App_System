<div>
    <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
        Students Profile
    </h2>
    <x-bread :breadcrumbs="[
        ['url' => url('adviser/dashboard'), 'label' => 'Adviser'],
        ['url' => url('adviser/students-profile'), 'label' => 'Student Profile'],
    ]"/>

    <div class="flex justify-between items-center">
<div>

</div>
        <div>
            <x-link :href="url('adviser/student-profile/add')">
                Add
            </x-link>

        </div>
    </div>

   <div>
    <livewire:adviser.student-profile-table/>
   </div>
</div>
