


<h6 class="text-xl font-bold px-4 text-left ">
    Recent Cases
</h6>
@if ($cases->isNotEmpty())


<x-table>
    <x-slot name="header">
       <th class="px-4 py-3">Student Name</th>
       <th class="px-4 py-3">Grave Offense</th>
       <th class="px-4 py-3">Minor Offense</th>
       <th class="px-4 py-3">Date</th>
    </x-slot>
    @foreach ($cases as $case)
        <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-4 py-2">{{ $case->student->first_name }} {{ $case->student->last_name }}</td>
                   <td class="px-4 py-2">
                @if ($case->GraveOffenses)
                    {{ $case->GraveOffenses->offenses }}
                @else
                    No Offenses Found
                @endif
            </td>
                   <td class="px-4 py-2">
                @if ($case->MinorOffenses)
                    {{ $case->MinorOffenses->offenses }}
                @else
                    No Offenses Found
                @endif
            </td>
                   <td class="px-4 py-2">
                    {{ $case->created_at->format('F j, Y') }}
            </td>


        </tr>
    @endforeach
</x-table>
@else
<p>No other cases found for this student.</p>
@endif

<!-- Your other HTML content -->
