<div>

    <div class="flex justify-between items-center">
        <div class="">
        Table: Grade: {{ auth()->user()->classroom->grade_level }} {{ auth()->user()->classroom->section }} Profiles
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
