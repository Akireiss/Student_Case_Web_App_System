<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PDF Report</title>
</head>

<body>
{{-- Total: {{ $anecdotals->count() }} --}}
    @if ($classroom)
        <div class="my-2">
            <p class="text-left text-xl">
                Grade: {{ $classroom->grade_level }} {{ $classroom->section }}
           </p>
           <p>

            Total: {{ $anecdotals->count() }}

            Case Status:
            @if ($status == "All")
            All
            @endif
            @if ($status == 0)
            Pending
            @endif

            @if ($status == 1)
            Ongoing
            @endif

            @if ($status == 2)
            Resvold
            @endif


            @if ($status == 3)
            Fllo Up
            @endif

           </p>


            @if ($classroom->students)
                @foreach ($classroom->students as $student)
                    <li>{{ $student->first_name }}
                        @if ($status == "All")
                        {{ $student->anecdotal->count() }}
                    @else
                        {{ $student->anecdotal->where('case_status', $status)->count() }}
                    @endif

                    </li>
                @endforeach
            @endif





        @else
        <div>
            All Reports From All Classroom
        </div>

        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 5px;">Pending</th>
                    <th style="border: 1px solid #000; padding: 5px;">Ongoing</th>
                    <th style="border: 1px solid #000; padding: 5px;">Resolved</th>
                    <th style="border: 1px solid #000; padding: 5px;">Follow Up</th>
                    <th style="border: 1px solid #000; padding: 5px;">Referral</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $anecdotals->where('case_status', 0)->count() }}
                    </td>
                    <td style="border: 1px solid #000; padding: 5px;">
                        {{ $anecdotals->where('case_status', 1)->count() }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">
                        {{ $anecdotals->where('case_status', 2)->count() }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">
                        {{ $anecdotals->where('case_status', 3)->count() }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">
                        {{ $anecdotals->where('case_status', 4)->count() }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    </div>
</body>

</html>
