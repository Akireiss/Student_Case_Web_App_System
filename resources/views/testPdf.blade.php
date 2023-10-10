<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

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
        }

        table th {
            border: 1px solid black;

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

        .label {
            display: inline-block;
        }

        .center {
            text-align: center;
            /* Center align the content within all <td> elements */
        }
    </style>
</head>

<body>

    <table width="80%">
        <tbody>
            <tr>
                <td class="bold">CZCMNHS INDIVIDUAL INVENTORY</td>

            </tr>
            <tr>
                <td>Personal Profile</td>
            </tr>
        </tbody>
    </table>

    <table width="80%">
        <thead style="background-color: lightgray;">

        </thead>
        <tbody>
            <tr>
                <td width="70%">Last Name: {{ $profile->student->last_name }}</td>
                <td>Age:{{ $profile->age }}</td>

            </tr>
            <tr>
                <td>First Name:{{ $profile->student->first_name }}</td>
                <td>Suffix:{{ $profile->suffix }}</td>
            </tr>
            <tr>
                <td>Middle Name:{{ $profile->student->middle_name }}</td>
                <td>Sex: {{ $profile->sex }}</td>
            </tr>


        </tbody>


    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="30%">Nickname:{{ $profile->nickname }}</td>
                <td width="28.5%">Birthdate:{{ $profile->birthdate }}</td>
                {{-- Need some adjustment here --}}
                <td width="25%">Birthplace:{{ $profile->birth_place }}</td>
                <td width="21%"></td>
            </tr>
        </tbody>
    </table>

    <table width="100%">

        <tbody>
            <tr>
                <td width="40%">Address:{{ $profile->municipal->municipality }},{{ $profile->barangay->barangay }} </td>
                <td width="40%">Contact Number:{{ $profile->contact }}</td>
                <td width="20%">Height::{{ $profile->height }}</td>
            </tr>
            <tr>
                <td width="40%">Birth Order: {{ $profile->birth_order }}</td>
                <td width="40%">No of Siblings: {{ $profile->no_of_siblings }}</td>
                <td width="20%">Weight: {{ $profile->weight }}</td>

            </tr>
        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="30%">Religion:{{ $profile->religion }}</td>
                <td width="28.5%">Mother Tongue: {{ $profile->mother_tongue }}</td>
        <td width="25%">4ps Receipient:{{ $profile->four_ps }}</td>
                <td width="21%">BMI:{{ $profile->bmi }}</td>
            </tr>
        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%" class="bold">Family Background:</td>
                <td width="20%">Do you have dissability?</td>

            </tr>
        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="30%"></td>
                <td width="28.5%">Father</td>
                <td width="25%">Mother</td>
                <td width="21%">
                    <div class="checkbox"></div>
                    <label class="label">Yes</label>
                </td>
            </tr>
        </tbody>
        <tbody>

        @foreach ($profile->family as $father)
        @if ($father->parent_type === 0)

        @foreach ($profile->family as $mother)
        @if ($mother->parent_type === 1)
            <tr>
                <td width="30%">Name</td>
                <td width="28.5%">{{ $father->parent_name }}</td>
                <td width="25%">{{ $mother->parent_name }}</td>
                <td width="21%">
                    <div class="checkbox"></div>
                    <label class="label">No</label>
                </td>
            </tr>
            <tr>
                <td width="30%">Place of Birth</td>
                <td width="28.5%">{{ $father->parent_birth_place }}</td>
                <td width="25%">{{ $mother->parent_birth_place }}</td>
                <td width="21%">If yes, what it is?<br>

                </td>
            </tr>
            <tr>
                <td width="30%">Age</td>
                <td width="28.5%">{{ $father->parent_age }}</td>
                <td width="25%">{{ $mother->parent_age }}</td>
                <td width="21%"></td>
            </tr>
            <tr>
                <td width="30%">Occupation</td>
                <td width="28.5%">{{ $father->parent_occupation }}</td>
                <td width="25%">{{ $mother->parent_occupation }}</td>
                <td width="21%">Food Allergy</td>
            </tr>
            <tr>
                <td width="30%">Place of Work</td>
                <td width="28.5%">{{ $father->parent_work_address }}</td>
                <td width="25%">{{ $mother->parent_work_address }}</td>
                <td width="21%">
                    <div class="checkbox"></div>
                    <label class="label">Yes</label>
                </td>

            </tr>
            <tr>
                <td width="30%">Contact No.</td>
                <td width="28.5%">{{ $father->parent_contact }}</td>
                <td width="25%">{{ $mother->parent_contact }}</td>
                <td width="21%">

                    <div class="checkbox"></div>
                    <label class="label">No</label>
                </td>
            </tr>

            <tr>
                <td width="30%">Office Monthly Income</td>
                <td width="28.5%">{{ $father->parent_office_contact }}</td>
                <td width="25%">{{ $mother->parent_office_contact }}</td>
                <td width="21%">If yes, what it is?<br>

                </td>
            </tr>


            <tr>
                <td width="30%">Monthly Income.</td>
                <td width="28.5%">{{ $father->parent_monthly_income }}</td>
                <td width="25%">{{ $mother->parent_monthly_income }}</td>
                <td width="21%">

                </td>
            </tr>

            @endif
            @endforeach
            @endif
            @endforeach
        </tbody>

    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%"> List down the names of Siblings that are studying in CZCMNHS</td>
                <td width="20%">Medicine taken in</td>

            </tr>
        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="30%" class="center">Name</td>
                <td width="28.5%" class="center">Age</td>
                <td width="25%" class="center">Grade and Section</td>
                <td width="21%">
                    1
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td width="30%">s</td>
                <td width="28.5%"></td>
                <td width="25%"></td>
                <td width="21%">

                </td>
            </tr>
            <tr>
                <td width="30%">s</td>
                <td width="28.5%"></td>
                <td width="25%"></td>
                <td width="21%">

                </td>
            </tr>
            <tr>
                <td width="30%">s</td>
                <td width="28.5%"></td>
                <td width="25%"></td>
                <td width="21%">

                </td>
            </tr>

        </tbody>
    </table>

    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">You are currently living with:

                    {{-- divd --}}
                         <div class="checkbox"></div>
                    <label class="label">both Parents</label>

                    <div class="checkbox"></div>
                    <label class="label">Father only</label>

                    <div class="checkbox"></div>
                    <label class="label">Mother only</label>
                    <div class="checkbox"></div>
                    <label class="label">n/a</label>
                </td>


                <td width="20%">

                </td>

            </tr>
        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Parent are currently:

                </td>


                <td width="20%">

                </td>

            </tr>

        </tbody>
    </table>
    <table width="100%">

        <tbody>

                <tr>
                    <td width="26%">
                        <div class="checkbox"></div>
                        <label class="label">Living Together</label>
                    </td>
                    <td width="26%">
                        <div class="checkbox"></div>
                        <label class="label">Separated</label>
                    </td>

                    <td width="27.5%">
                        <div class="checkbox"></div>
                        <label class="label">Legally Separated</label>
                    </td>


                    <td width="20%">

                    </td>
                </tr>


                <tr>
                    <td width="26%">
                        <div class="checkbox"></div>
                        <label class="label">With another partner</label>
                    </td>
                    <td width="26%">
                        <div class="checkbox"></div>
                        <label class="label">Father is OFW</label>
                    </td>

                    <td width="27.5%">
                        <div class="checkbox"></div>
                        <label class="label">Mother is OFW</label>
                    </td>


                    <td width="20%">

                    </td>
                </tr>


        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Guardian Name:

                </td>


                <td width="20%">

                </td>

            </tr>


        </tbody>
    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="56.5%">Relationship with the guardian:

                </td>
                <td width="23%">Contact No:

                </td>

                <td width="20%">

                </td>

            </tr>

        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="56.5%">Occupation:

                </td>
                <td width="23%">Age:

                </td>

                <td width="20%">

                </td>

            </tr>

        </tbody>
    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Address:

                </td>


                <td width="20%">

                </td>

            </tr>

        </tbody>
    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Educational Background:

                </td>


                <td width="20%">

                </td>

            </tr>

        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="15%">
                    Grade Level
                </td>
                <td width="41%">
                    Name of School
                </td>
                <td width="23.5%">
                    Section
                </td>

                <td width="20%">
School Year
                </td>

            </tr>

        </tbody>


        <tbody>
            <tr>
                <td width="15%">
                    .
                </td>
                <td width="41%">

                </td>
                <td width="23.5%">
                </td>

                <td width="20%">
                </td>

            </tr>


        </tbody>
    </table>

    <div class="page-break"></div>

    {{-- Second Page --}}
    <table width="100%">

        <tbody>
            <tr>
                <td>Name some of your
                    Academic and Extra-Curricular Awards:

                </td>


            </tr>

        </tbody>
    </table>



    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Name of award:

                </td>


                <td width="20%">
                    Year Achieved:
                </td>

            </tr>

        </tbody>



        <tbody>
            <tr>
                <td width="79.5%">
s
                </td>


                <td width="20%">

                </td>

            </tr>

        </tbody>
    </table>

    <table width="100%">

        <tbody>
            <tr>
                <td>What is yor favorite subject/s?
                </td>
            </tr>
            <tr>
                <td>
                    What subject do you find difficult?
                </td>
            </tr>
            <tr>
                <td>
                    What school organizations are you afiliated?
                </td>
            </tr>
            <tr>
                <td>
                    What do you plan to do after graduating Senior High School?
                </td>
            </tr>
        </tbody>

    </table>


    <table width="100%">

        <tbody>

                <tr>
                    <td width="33%">
                        <div class="checkbox"></div>
                        <label class="label">Living Together</label>
                    </td>
                    <td width="33%">
                        <div class="checkbox"></div>
                        <label class="label">Separated</label>
                    </td>

                    <td width="33%">
                        <div class="checkbox"></div>
                        <label class="label">Legally Separated</label>
                    </td>

                </tr>


                <tr>
                    <td width="33%">
                        <div class="checkbox"></div>
                        <label class="label">With another partner</label>
                    </td>
                    <td width="33%">
                        <div class="checkbox"></div>
                        <label class="label">Father is OFW</label>
                    </td>

                    <td width="33%">
                        <div class="checkbox"></div>
                        <label class="label">Mother is OFW</label>
                    </td>



                </tr>


        </tbody>
    </table>
</body>

</html>
