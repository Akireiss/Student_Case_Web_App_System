<div>


    <div>
        <h1 class="text-black text-left text-2xl ">
            Resolved Cases For The Past Three Days
        </h1>
    </div>

<div>



<div class="py-5 px-3">

<x-table>
    <x-slot name="header">
       <th class="px-4 py-3">Student Name</th>
       <th class="px-4 py-3">Minor Offense</th>
       <th class="px-4 py-3">Date</th>
    </x-slot>
@if ()

@for ($resolvedCases->students)

@endfor

@endif

        <tr class="text-gray-700 dark:text-gray-400">

<td>

</td>

        </tr>
</x-table>

</div>





</div>
