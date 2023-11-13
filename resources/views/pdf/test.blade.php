<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table width="100%">
        <tbody>
            <tr>

                <th class="bold center">CASTOR Z. CONCEPCION MEMORIAL NATIONAL HIGH SCHOOL</th>

            </tr>


        </tbody>
    </table>
    <table width="100%">
        <tbody>

            <tr>
                @if ($department == 0)
                    <th class="bold center letter">High School Department</th>
                @endif

                @if ($department == 1)
                    <th class="bold center letter">Senior High School Department</th>
                @endif
            </tr>


        </tbody>
    </table>

    <br>

    <table width="100%">
        <tbody>
            <tr>
                @if ($year != 'All')
                    <td class="center">Total Case SY {{ $year }}</td>
                @endif


            </tr>

        </tbody>

    </table>
    <table width="100%">
        <tbody>
            <tr>
        <td width="30%">Grade Levels:</td>
        <td width="28.5%">Total Male Cases:</td>
        <td width="25%">Total Female Cases:</td>
    </tr>

    @if ($department == 0)
    @foreach ($classroomsHS as $classroom)
        <tr>
            <td width="30%">{{ $classroom->first_letter }}</td>
            <td width="28.5%">{{ $totalMaleCasesHS[$classroom->first_letter] }}</td>
            <td width="25%">{{ $totalFemaleCasesHS[$classroom->first_letter] }}</td>
        </tr>
    @endforeach
    <td>Total: </td>
    <td> {{ $totalAllMaleCasesHS }}</td>
    <td> {{ $totalAllFemaleCasesHS }} </td>
@endif


@if ($department == 1)
    @foreach ($classroomsSenior as $classroom)
    <tr>
        <td width="30%">{{ $classroom->first_letter }}</td>
        <td width="28.5%">{{ $totalMaleCasesSH[$classroom->first_letter] }}</td>
        <td width="25%">{{ $totalFemaleCasesSH[$classroom->first_letter] }}</td>
    </tr>
@endforeach
<td>Total: </td>
    <td> </td>
    <td> </td>
@endif
        </tbody>
</table>

<br>
<br>

<p class="letter bottom bold" style="font-size: 12px">Prepared By</p>
<p class="letter bold bottom" style="font-size: 12px">Rey Angelo D. Ordinario</p>

<p class="letter bottom bold" style="font-size: 12px">Noted:</p>
<p class="letter bold" style="font-size: 12px">Joel B. Nava</p>
<p class="letter bold" style="font-size: 12px">School Principal IV</p>



</body>
</html>
<style type="text/css">
    .bottom {
        margin-bottom: 25px;
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
