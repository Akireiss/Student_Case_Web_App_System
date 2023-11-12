<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PDF Report</title>
</head>


<body>
    <table width="100%">
        <tbody>
            <tr>
                <th class="bold">CZCMNHS Case Report </th>

            </tr>
            @if ($year !== 'All')
                <tr>
                    <th>School Year {{ $year }}</th>
                </tr>
            @else
                <tr>
                    <th>All Years</th>
                </tr>
            @endif

        </tbody>
    </table>

    {{ $category }}

    <p>
        {{-- Grade:{{ $classroom->grade_level }} {{ $classroom->section }} --}}
    </p>
    Case Status:
    @if ($status == 'All')
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


    @if ($highSchoolIds)

    @if ($highSchoolIds != 'All')
        <p>
            Grade:{{ $highSchoolIds->grade_level }} {{ $highSchoolIds->section }} Report
        </p>
        @if ($year !== 'All')
            <p>
                School Year {{ $year }}</th>
            </p>
        @else
            <p>
                All Years
            </p>
        @endif
        </p>

    @endif

    @else
    <p>All High School</p>
    @endif



    @if ($seniorHighSchool)

    @if ($seniorHighSchool != 'All')
        <p>
            Grade:{{ $seniorHighSchool->grade_level }} {{ $seniorHighSchool->section }} Report
        </p>
        @if ($year !== 'All')
            <p>
                School Year {{ $year }}</th>
            </p>
        @else
            <p>
                All Years
            </p>
        @endif
        </p>
        @endif
        @else
        <p>All Senior High School</p>

    @endif




{{--
    @if ($classroom != 'All')
        <table width="100%">
            <tbody>
                <tr>
                    <td>Students</td>
                    <td>Total Cases</td>
                </tr>
                @foreach ($classroom->students as $student)
                    <tr>
                        <td>{{ $student->first_name }}</td>
                        @if ($status == 'All')
                            <td>Total Cases: {{ $student->anecdotal->count() }}</td>
                        @elseif ($status == 0)
                            <td>Total Pending Cases: {{ $student->anecdotal->where('case_status', 0)->count() }}</td>
                        @elseif ($status == 1)
                            <td>Total Ongoing Cases: {{ $student->anecdotal->where('case_status', 1)->count() }}</td>
                        @elseif ($status == 2)
                            <td>Total Resolved Cases: {{ $student->anecdotal->where('case_status', 2)->count() }}</td>
                        @elseif ($status == 3)
                            <td>Total Follow-up Cases: {{ $student->anecdotal->where('case_status', 3)->count() }}</td>
                        @elseif ($status == 4)
                            <td>Total Referral Cases: {{ $student->anecdotal->where('case_status', 4)->count() }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        dasdsad
    @endif --}}















</body>

</html>
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }

    .page-break {
        page-break-after: always;
    }

    table {
        font-size: x-small;
        border-collapse: collapse;

    }

    table td {
        border: 1px solid black;
        padding: 5px;
        font-family: "Times New Roman", serif;
        font-size: 16px
    }

    table th {
        border: none;
        font-family: "Times New Roman", serif;
        font-size: 16px
    }

    .gray {
        background-color: lightgray
    }

    .bold {
        font-weight: bold;
        padding: 8px;
    }

    .checkbox {
        width: 12px;
        height: 12px;
        border: 1px solid #000;
        /* background-color: #000; */
        display: inline-block;
        /* Display the checkbox inline */
        margin-right: 4px;
        /* Add some spacing between checkbox and label */
    }

    .check {
        width: 12px;
        height: 12px;
        border: 1px solid #000;
        background-color: #000;
        display: inline-block;
        /* Display the checkbox inline */
        margin-right: 4px;
        /* Add some spacing between checkbox and label */
    }

    .label {
        display: inline-block;
    }

    .center {
        text-align: center;
        /* Center align the content within all <td> elements */
    }
</style>
