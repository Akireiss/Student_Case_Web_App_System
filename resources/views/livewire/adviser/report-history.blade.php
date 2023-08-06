<div>
    @extends('layouts.dashboard.index')

    @section('content')
        <h6 class="text-xl font-bold px-4 text-left py-4">
            Report History
        </h6>

        <x-table>
            <x-slot name="header">
                <th class="px-4 py-3">Student Name</th>
                <th class="px-4 py-3">Minor Offense</th>
                <th class="px-4 py-3">Grave Offense</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Manage</th>
            </x-slot>

            @foreach($userReports as $report)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-2">
                        {{ $report->anecdotal?->student?->first_name  ?? "No First Name" }}
                         {{ $report->anecdotal?->student?->last_name ??  "No Last Name" }}

                    </td>
                    <td class="px-4 py-2">
                        {{ $report->anecdotal?->Minoroffenses?->offenses  ?? "No Offenses Found" }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $report->anecdotal?->Graveoffenses?->offenses ?? "No Offenses Found" }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $report->anecdotal->case_status }}
                    </td>


                    <td class="px-4 py-2">
                        {{ $report->created_at->format('F j, Y') }}
                    </td>

                    <td class="px-4 py-2">
                        <x-link target="_blank" :href="url('adviser/report/history/' . $report->id . '/view')">View</x-link>

                        @if ($report->anecdotal && ($report->anecdotal->case_status === 0 || $report->anecdotal->case_status === 2))
                            <x-link href="">Manage</x-link>
                        @endif
                    </td>



                </tr>
            @endforeach
        </x-table>
    @endsection


</div>
