<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PDF Report</title>
</head>

<body>
    <h1>Your PDF Report</h1>
    {{-- @if ($status !== 'All')
            Total Case: {{ $anecdotals->count() }}
    @endif --}}
    @if ($classroom)
            <div class="my-2">
                <p class="text-left text-xl">
                    Grade: {{ $classroom->grade_level }} {{ $classroom->section }}
                </p>
            </div>
@else
<div>
    All Classrom
</div>
        @endif
        <br />


        @if ($status == 'All')
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
                        <td style="border: 1px solid #000; padding: 5px;">{{ $anecdotals->where('case_status', 0)->count() }}</td>
                        <td style="border: 1px solid #000; padding: 5px;">{{ $anecdotals->where('case_status', 1)->count() }}</td>
                        <td style="border: 1px solid #000; padding: 5px;">{{ $anecdotals->where('case_status', 2)->count() }}</td>
                        <td style="border: 1px solid #000; padding: 5px;">{{ $anecdotals->where('case_status', 3)->count() }}</td>
                        <td style="border: 1px solid #000; padding: 5px;">{{ $anecdotals->where('case_status', 4)->count() }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
