<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PDF Report</title>
</head>
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

<body>
    {{-- Total: {{ $anecdotals->count() }} --}}

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
     Grade:{{ $classroom->grade_level }} {{ $classroom->section }}
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


    @if ($classroom !== "All")
    <table width="100%">
        <tbody>
            <tr>
                <td>Students</td>
                <td>Total Cases</td>
            </tr>
        @if ($category == "All")
            @foreach ($classroom->students as $student)
            <tr>
                <td>{{ $student->first_name}}</td>

                @if ($status == 'All')
                <td>Total Case: {{ $student->anecdotal->count()}}</td>
                @endif
                @if ($status == 0)
                <td>Total Pending Case: {{ $student->anecdotal->where('case_status', 0)->count()}}</td>
                @endif
                @if ($status == 1)
                <td>Total Ongoing Case: {{ $student->anecdotal->where('case_status', 1)->count()}}</td>
                @endif
                @if ($status == 2)
                <td>Total Resolve Case: {{ $student->anecdotal->where('case_status', 2)->count()}}</td>
                @endif
                @if ($status == 4)
                <td>Total Followup Case: {{ $student->anecdotal->where('case_status', 3)->count()}}</td>
                @endif
                @if ($status == 4)
                <td>Total Refferal Case: {{ $student->anecdotal->where('case_status', 4)->count()}}</td>
                @endif
            </tr>
        @endforeach

        @else
        <td>dsada</td>
            @endif
        </tbody>
    </table>


            @else


            dsadasd


    @endif














</body>

</html>
