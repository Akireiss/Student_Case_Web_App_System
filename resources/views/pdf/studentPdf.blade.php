<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $student->first_name }} {{ $student->last_name }}</title>
</head>


<body>
    <table width="100%">
        <tbody>
            <tr>

                <th class="bold center">CASTOR Z. CONCEPCION MEMORIAL NATIONAL HIGH SCHOOL</th>

            </tr>
            <tr>

                <th class="bold center">STUDENT CASE</th>

            </tr>

        </tbody>
    </table>
    <br>

    <table width="100%">
        <tbody>

            <tr>
                @if ($student->deparment === 0)
                <td class="bold center letter">High School Department</th>
                    @else
                <td class="bold center letter">Senior High School Department</th>
                @endif
            </tr>


        </tbody>
    </table>



    <table width="100%">
        <tbody>
            <tr>
                <td width="30%">Name</td>
                <td width="30%">Grade Level:</td>
                <td width="30%">Pending</td>
                <td width="28.5%">Ongoing</td>
                <td width="25%">Resolved</td>
                <td width="25%">Follow Up</td>
                <td width="25%">Refferal</td>
            </tr>
            <tr>
                @if ($student)
            <tr>
                <td width="30%">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                <td width="30%">Grade: {{ $student->classroom->grade_level }} {{ $student->classroom->section }}</td>
                <td width="30%">{{ $student->anecdotal->where('case_status', 0)->count() }}</td>
                <td width="28.5%">{{ $student->anecdotal->where('case_status', 1)->count() }}</td>
                <td width="25%">{{ $student->anecdotal->where('case_status', 2)->count() }}</td>
                <td width="25%">{{ $student->anecdotal->where('case_status', 3)->count() }}</td>
                <td width="25%">{{ $student->anecdotal->where('case_status', 4)->count() }}</td>
            </tr>
        @else
            <td>No Data</td>
            @endif



        </tbody>
    </table>
    <br>

    <table width="100%">
        <tbody>

            <tr>

                <td class="bold center letter">All Cases</th>


            </tr>


        </tbody>
    </table>


    <table width="100%">
        <tbody>
            <tr>
                <td width="15%">Name</td>
                <td width="15%">Grade Level</td>
                <td width="15%">Offense</td>
                <td width="15%">Gravity</td>
                <td width="15%">Status</td>
                <td width="20%">Date</td>
            </tr>

            @if ($student)
                @forelse ($student->anecdotal as $anecdotal)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $anecdotal->grade_level }}</td>
                        <td>{{ $anecdotal->offenses->offenses }}</td>
                        <td>{{ $anecdotal->getGravityTextAttribute() }}</td>
                        <td>{{ $anecdotal->getStatusTextAttribute() }}</td>
                        <td>{{ $anecdotal->created_at->format('F j, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No data</td>
                    </tr>
                @endforelse
            @endif
        </tbody>
    </table>


    {{-- <tr>
        <td width="30%">Total</td>
        <td width="30%"></td>
        <td width="30%"></td>
        <td width="28.5%"></td>
        <td width="25%"></td>
        <td width="25%"></td>
    </tr> --}}

</body>

</html>
<style type="text/css">
    .bottom {
        margin-bottom: 15px;
    }

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

    td {
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

    .letter {
        text-transform: uppercase;
    }
</style>
