@extends('layouts.dashboard.index')
@section('content')

<h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
    Audit Trail
   </h2>
   <x-bread :breadcrumbs="[
       ['url' => url('admin/dashboard'), 'label' => 'Admin'],
       ['url' => url('admin/settings/audit-trail'), 'label' => 'Settings'],
       ['url' => url('admin/settings/audit-trail'), 'label' => 'Audit Trail'],
   ]"/>
    <div class="flex items-center justify-between mb-2">
    <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
    </h4>
    <div class="flex-grow flex justify-end">

    </div>
  </div>
<div>
    <livewire:activity-table/>
</div>
@endsection
