<div>

    <div class="flex justify-between items-center">
        <h6 class="text-xl font-bold">
            Grade: {{ auth()->user()->classroom->grade_level }} {{ auth()->user()->classroom->section }} Profiles
        </h6>
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
