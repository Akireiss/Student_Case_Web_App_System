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
                @else
                    <td class="center">Total Case for All School Year</td>
                @endif


            </tr>
            <tr>

                <td>
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
                </td>
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

            @if ($SeniorHigh === 'All')
                @php
                    $maleTotal = 0;
                    $femaleTotal = 0;
                @endphp

                @foreach ($seniorHighSchools as $senior)
                    @php

                        $totalMaleCases = $senior->students->where('gender', 0)->sum(function ($student) {
                            return $student->anecdotal->count();
                        });

                        $totalFemaleCases = $senior->students->where('gender', 1)->sum(function ($student) {
                            return $student->anecdotal->count();
                        });

                        $maleTotal += $totalMaleCases;
                        $femaleTotal += $totalFemaleCases;
                    @endphp

                    <tr>
                        <td width="30%">Grade {{ $senior->grade_level }}:</td>
                        <td width="28.5%">{{ $totalMaleCases }}</td>
                        <td width="25%">{{ $totalFemaleCases }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>Total:</td>
                    <td>{{ $maleTotal }}</td>
                    <td>{{ $femaleTotal }}</td>
                </tr>
            @else
                @foreach ($SeniorClassroom as $senior)
                    <tr>
                        <td>Grade: {{ $senior->grade_level }} {{ $senior->section }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach

            @endif



            @if ($highSchool === 'All')
                @php
                    $maleTotal = 0;
                    $femaleTotal = 0;
                @endphp

                @foreach ($HighSchoolClass as $high)
                    @php
                    // Parse the selected year into a start and end date
                    $yearParts = explode('-', $year);
                    $startYear = new DateTime($yearParts[0] . '-06-01');
                    $endYear = new DateTime($yearParts[1] . '-05-31 23:59:59');
                        $totalMaleCases = $high->students
                            ->where('gender', 0)
                            ->whereHas('anecdotal', function ($query) use ($startYear, $endYear) {
                                $query->whereBetween('created_at', [$startYear, $endYear]);
                            })
                            ->sum(function ($student) {
                                return $student->anecdotal->count();
                            });

                        $totalFemaleCases = $high->students
                            ->where('gender', 1)
                            ->whereHas('anecdotal', function ($query) use ($startYear, $endYear) {
                                $query->whereBetween('created_at', [$startYear, $endYear]);
                            })
                            ->sum(function ($student) {
                                return $student->anecdotal->count();
                            });

                        $maleTotal += $totalMaleCases;
                        $femaleTotal += $totalFemaleCases;
                    @endphp

                    <tr>
                        <td width="30%">Grade {{ $high->grade_level }}:</td>
                        <td width="28.5%">
                            {{ $totalMaleCases }}
                        </td>
                        <td width="25%">
                            {{ $totalFemaleCases }}
                        </td>
                    </tr>
                @endforeach




                <tr>
                    <td>Total:</td>
                    <td>{{ $maleTotal }}</td>
                    <td>{{ $femaleTotal }}</td>
                </tr>
            @else
                @foreach ($HighClassroom as $classroom)
                    <tr>
                        <td>Grade: {{ $classroom->grade_level }} {{ $classroom->section }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endif





        </tbody>
    </table>


    <br>
    <br>

    {{--
    <table width="100%">
        <tbody>
            <tr>
                <td width="30%"></td>
                <td width="28.5%">Male:</td>
                <td width="25%">Female:</td>
            </tr>
            <tr>
                <td width="30%">Grade 11:</td>
                <td width="28.5%">23:</td>
                <td width="25%">23:</td>
            </tr>
            <tr>
                <td width="30%">Grade 12:</td>
                <td width="28.5%">Birthdate:</td>
                {{-- Need some adjustment here
                <td width="25%">Birthplace:</td>
            </tr>

        </tbody>

    </table>



    <br>
    <br>


    <table width="100%">
        <tbody>
            <tr>
                <td width="30%"></td>
                <td width="28.5%">Male:</td>
                <td width="25%">Female:</td>
            </tr>
            <tr>
                <td width="30%">Grade 11:</td>
                <td width="28.5%">23:</td>
                <td width="25%">23:</td>
            </tr>
            <tr>
                <td width="30%">Grade 12:</td>
                <td width="28.5%">Birthdate:</td>
                {{-- Need some adjustment here
                <td width="25%">Birthplace:</td>
            </tr>

        </tbody>

    </table>



    <br>
    <br>


    <table width="100%">
        <tbody>
            <tr>
                <td width="30%"></td>
                <td width="28.5%">Male:</td>
                <td width="25%">Female:</td>
            </tr>
            <tr>
                <td width="30%">Grade 11:</td>
                <td width="28.5%">23:</td>
                <td width="25%">23:</td>
            </tr>
            <tr>
                <td width="30%">Grade 12:</td>
                <td width="28.5%">Birthdate:</td>
                {{-- Need some adjustment here
                <td width="25%">Birthplace:</td>
            </tr>

        </tbody>

    </table> --}}
    <br>
    <br>

    <p class="letter bottom bold" style="font-size: 12px">Prepared By</p>
    <p class="letter bold bottom" style="font-size: 12px">Rey Angelo D. Ordinario</p>

    <p class="letter bottom bold" style="font-size: 12px">Noted:</p>
    <p class="letter bold" style="font-size: 12px">Joel B. Nava</p>
    <p class="letter bold" style="font-size: 12px">School Principal IV</p>

    {{-- {{ $category }} --}}

    <p>
        {{-- Grade:{{ $classroom->grade_level }} {{ $classroom->section }} --}}
    </p>
    {{-- @if ($year !== 'All')
                <tr>
                    <th>School Year {{ $year }}</th>
                </tr>
            @else
                <tr>
                    <th>All Years</th>
                </tr>
            @endif --}}






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
