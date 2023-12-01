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
                @if ($department == 'All')
                <th class="bold center letter">High School And Senior High School Department</th>
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
            {{-- All Department --}}
            @if ($department == 'All')
                @foreach ($Allclassrooms as $classroom)
                    <tr>
                        <td width="30%">{{ $classroom->first_letter }}</td>
                        <td width="28.5%">{{ $AllMaletotalCases[$classroom->first_letter] }}</td>
                        <td width="25%">{{ $AllFemaletotalCases[$classroom->first_letter] }}</td>
                    </tr>
                @endforeach
                <td>Total: </td>
                <td>{{ $totalAllMaleCases }}</td>
                <td> {{ $totalAllFemaleCases }} </td>
            @endif





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
                <td> {{ $totalAllMaleCasesSH }}</td>
                <td> {{ $totalAllFemaleCasesSH }}</td>
            @endif


        </tbody>
    </table>
    <br>

@if ($status == 'All')
        <table width="100%">
            <tbody>
                <tr>
                    <td width="30%">Grade Level:</td>
                    <td width="30%">Pending</td>
                    <td width="28.5%">Ongoing</td>
                    <td width="25%">Resolved</td>
                    <td width="25%">Follow Up</td>
                    <td width="25%">Refferal</td>
                </tr>
                @if ($department == 'All')
                @foreach ($Allclassrooms as $classroom)
                    <tr>
                        <td width="30%">{{ $classroom->first_letter }}</td>
                        <td width="28.5%">{{ $pendingAll[$classroom->first_letter] }}</td>
                        <td width="25%">{{ $ongoingAll[$classroom->first_letter] }}</td>
                        <td width="25%">{{ $ResolveAll[$classroom->first_letter] }}</td>
                        <td width="25%">{{ $FollowAll[$classroom->first_letter] }}</td>
                        <td width="25%">{{ $RefferAll[$classroom->first_letter] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td width="30%">Totals: </td>
                    <td width="28.5%">{{ $totalPendingAllCases }}</td>
                    <td width="25%">{{ $totalOngoingAllCases }}</td>
                    <td width="25%">{{ $totalResolveAllCases }}</td>
                    <td width="25%">{{ $totalFollowUpAllCases }}</td>
                    <td width="25%">{{ $totalRefferalAllCases }}</td>
                </tr>
            @endif


                @if ($department == 1)
                    @foreach ($classroomsSenior as $classroom)
                        <tr>
                            <td width="30%">{{ $classroom->first_letter }}</td>
                            <td width="28.5%">{{ $pendingSH[$classroom->first_letter] }}</td>
                            <td width="25%">{{ $ongoingSH[$classroom->first_letter] }}</td>
                            <td width="25%">{{ $ResolveSH[$classroom->first_letter] }}</td>
                            <td width="25%">{{ $FollowSH[$classroom->first_letter] }}</td>
                            <td width="25%">{{ $RefferSh[$classroom->first_letter] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td width="30%">Totals: </td>
                        <td width="28.5%">{{ $totalPendingCasesSenior }}</td>
                        <td width="25%">{{ $totalOngoingSH }}</td>
                        <td width="25%">{{ $totalResolveSH }}</td>
                        <td width="25%">{{ $totalFollowUpSH }}</td>
                        <td width="25%">{{ $totalRefferalSh }}</td>
                    </tr>
                @endif


                @if ($department == 0)
                    @foreach ($classroomsHS as $classroomHS)
                        <tr>
                            <td width="30%">{{ $classroomHS->first_letter }}</td>
                            <td width="28.5%">{{ $pendingHS[$classroomHS->first_letter] }}</td>
                            <td width="25%">{{ $ongoingHS[$classroomHS->first_letter] }}</td>
                            <td width="25%">{{ $ResolveHS[$classroomHS->first_letter] }}</td>
                            <td width="25%">{{ $FollowHS[$classroomHS->first_letter] }}</td>
                            <td width="25%">{{ $RefferHS[$classroomHS->first_letter] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td width="30%">Totals: </td>
                        <td width="28.5%">{{ $totalPendingHigh }}</td>
                        <td width="25%">{{ $totalOngoingHS }}</td>
                        <td width="25%">{{ $totalResolveHS }}</td>
                        <td width="25%">{{ $totalFollowUpHS }}</td>
                        <td width="25%">{{ $totalRefferalHS }}</td>
                    </tr>
                @endif



            </tbody>
@else
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="30%">Grade Level:</td>
                        <td width="30%">
                            @if ($status == 0)
                                Pending
                            @endif

                            @if ($status == 1)
                                Ongoing
                            @endif

                            @if ($status == 2)
                                Resolved
                            @endif

                            @if ($status == 3)
                                Follow Up
                            @endif
                            @if ($status == 4)
                                Refferal
                            @endif Cases
                        </td>
                    </tr>

                    @if ($department == 1)
                    @foreach ($classroomsSenior as $classroom)
                        <tr>
                            <td width="30%">{{ $classroom->first_letter }}</td>
                            <td width="28.5%">{{ $caseStatusSH[$classroom->first_letter] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td width="30%">Total: </td>
                        <td width="30%">{{ $totalcaseStatusSH }}</td>
                    </tr>
                    @endif

                    @if ($department == 0)
                    @foreach ($classroomsHS as $classroomHigh)
                        <tr>
                            <td width="30%">{{ $classroomHigh->first_letter }}</td>
                            <td width="28.5%">{{ $caseStatusHS[$classroomHigh->first_letter] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td width="30%">Total: </td>
                        <td width="30%">{{ $totalcaseStatusHS }}</td>
                    </tr>
                    @endif



                </tbody>


    @endif

    </table>









    <br>
    <br>

    <p class="letter bottom bold" style="font-size: 12px">Prepared By</p>
    <p class="letter bold " style="font-size: 12px">Rey Angelo D. Ordinario</p>
<br>
    <p class="letter bottom bold" style="font-size: 12px">Noted:</p>
    <p class="letter bold" style="font-size: 12px">Joel B. Nava</p>
    <p class="letter bold" style="font-size: 12px">School Principal IV</p>



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
