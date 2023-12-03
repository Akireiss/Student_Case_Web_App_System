<div>
    <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
        Reports
    </h2>
    <x-bread :breadcrumbs="[
        ['url' => url('adviser/dashboard'), 'label' => 'Adviser'],
        ['url' => url('adviser/report/student'), 'label' => 'Reports'],
    ]"/>
                <livewire:student.report />

</div>
