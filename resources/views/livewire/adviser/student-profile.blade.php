<div>

    <h6 class="text-xl font-bold text-left ">
      Grade:  {{ auth()->user()->classroom->grade_level }}  {{ auth()->user()->classroom->section }} Profiles
    </h6>

   <div>
    <livewire:adviser.student-profile-table/>
   </div>
</div>
