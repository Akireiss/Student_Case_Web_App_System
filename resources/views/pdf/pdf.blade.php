<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $profile->student->first_name}} {{ $profile->student->last_name }}</title>

    <style type="text/css">

body {
        margin: 0;
        padding: 0;
    }

        .page-break {
            page-break-after: always;
        }

        table {
            font-size: 13px;
        border-collapse: collapse;
        font-family: 'Trebuchet MS', sans-serif;
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
            padding-bottom: 6px;
            padding-top:6px;
        }
        .header {
            font-weight: bold;
            padding-bottom: 12px;
            padding-top: 10px;
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
        .footer{
        padding-top: 20px;
        padding-bottom: 20px;
        font-size: 14px
    }
    </style>
</head>

<body>
    <table width="100%">
        <tbody>
            <tr>
                <td class="header">
                    CZCMNHS INDIVIDUAL INVENTORY <span style="float: right; font:bold;  ">Guidance Form 1</span>
                </td>
            </tr>
            <tr>
                <td class="bold">Personal Profile</td>
            </tr>
        </tbody>
    </table>

    <table width="100%">
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
                <td width="40%">Address: {{ $profile->municipal->municipality }},{{ $profile->barangay->barangay }}
                </td>
                <td width="40%">Contact Number: {{ $profile->contact }}</td>
                <td width="20%">Height: {{ $profile->height }}</td>
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

                    <div class="checkbox @if ($profile->disability !== 'No') check @endif"></div>

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
                                    <div class="checkbox @if ($profile->disability === 'No') check @endif"></div>
                                    <label class="label">No</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Place of Birth</td>
                                <td width="28.5%">{{ $father->parent_birth_place }}</td>
                                <td width="25%">{{ $mother->parent_birth_place }}</td>
                                <td width="21%">
                                    If yes, what is it?
                                    @if ($profile->disability !== 'No')
                                        {{ $profile->disability }}
                                    @endif
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
                                    <div class="checkbox @if ($profile->food_allergy !== 'No') check @endif"></div>

                                    <label class="label">Yes</label>
                                </td>

                            </tr>
                            <tr>
                                <td width="30%">Contact No.</td>
                                <td width="28.5%">{{ $father->parent_contact }}</td>
                                <td width="25%">{{ $mother->parent_contact }}</td>
                                <td width="21%">

                                    <div class="checkbox @if ($profile->food_allergy === 'No') check @endif"></div>
                                    <label class="label">No</label>
                                </td>
                            </tr>

                            <tr>
                                <td width="30%">Office Monthly Income</td>
                                <td width="28.5%">{{ $father->parent_office_contact }}</td>
                                <td width="25%">{{ $mother->parent_office_contact }}</td>
                                <td width="21%"> If yes, what is it?
                                    @if ($profile->food_allergy !== 'No')
                                        {{ $profile->disability }}
                                    @endif

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
                    @if ($profile->medicines->count() > 0)
                        1) {{ $profile->medicines[0]->medicine }}
                        <!-- Display other medicine attributes as needed -->
                    @else
                        1)
                    @endif
                </td>
            </tr>
        </tbody>
        <tbody>
            @if ($profile->siblings->isNotEmpty())
                @foreach ($profile->siblings as $sibling)
                    <tr>
                        <td width="30%">{{ $sibling->sibling_name }}</td>
                        <td width="28.5%">{{ $sibling->sibling_age }}</td>
                        <td width="25%">{{ $sibling->sibling_grade_section }}</td>
                        <td width="21%">
                            @if ($profile->medicines->count() > 1)
                                2) {{ $profile->medicines[1]->medicine }}
                                <!-- Display other medicine attributes as needed -->
                            @else
                                2)
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td width="81.5%">No Record Found</td>
                </tr>
            @endif

        </tbody>
    </table>

    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">You are currently living with:


                    <div class="checkbox @if ($profile->living_with === 'both-parent') check @endif"></div>
                    <label class="label" value="both-parent">both Parents</label>

                    <div class="checkbox @if ($profile->living_with === 'father-only') check @endif"></div>
                    <label class="label" value="father-only">Father only</label>

                    <div class="checkbox @if ($profile->living_with === 'mother-only') check @endif"></div>
                    <label class="label" value="mother-only">Mother only</label>

                    <div class="checkbox @if ($profile->living_with === 'n/a') check @endif"></div>
                    <label class="label" value="n/a">n/a</label>



                </td>


                <td width="20%">
                    @if ($profile->medicines->count() > 2)
                        3) {{ $profile->medicines[2]->medicine }}
                    @else
                        3)
                    @endif
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
                    Vitamins taken in
                </td>

            </tr>

        </tbody>
    </table>
    <table width="100%">

        <tbody>
            @if ($profile->parent_status)
                @foreach ($profile->parent_status as $parentStatus)
                    <tr>
                        <td width="26%">
                            <div class="checkbox @if ($parentStatus->parent_status === 'Living Together') check @endif"></div>

                            <label class="label">Living Together</label>
                        </td>
                        <td width="26%">
                            <div class="checkbox @if ($parentStatus->parent_status === 'Separated') check @endif"></div>

                            <label class="label">Separated</label>
                        </td>

                        <td width="27.5%">
                            <div class="checkbox @if ($parentStatus->parent_status === 'Legally Separated') check @endif"></div>

                            <label class="label">Legally Separated</label>
                        </td>


                        <td width="20%">
                            @if ($profile->vitamins->count() > 0)
                            1) {{ $profile->vitamins[0]->vitamins }}

                        @else
                            1)
                        @endif
                        </td>
                    </tr>


                    <tr>
                        <td width="26%">
                            <div class="checkbox @if ($parentStatus->parent_status === 'With another partner') check @endif"></div>

                            <label class="label">With another partner</label>
                        </td>
                        <td width="26%">
                            <div class="checkbox @if ($parentStatus->parent_status === 'Father is OFW') check @endif"></div>

                            <label class="label">Father is OFW</label>
                        </td>

                        <td width="27.5%">
                            <div class="checkbox @if ($parentStatus->parent_status === 'Mother is OFW') check @endif"></div>

                            <label class="label">Mother is OFW</label>
                        </td>


                        <td width="20%">
                            @if ($profile->vitamins->count() > 0)
                            2) {{ $profile->vitamins[1]->vitamins }}
                            @else
                            2)
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Guardian Name: {{ $profile->guardian_name }}

                </td>


                <td width="20%">
                    @if ($profile->vitamins->count() > 0)
                    3) {{ $profile->vitamins[2]->vitamins }}
                    @else
                    3)
                    @endif
                </td>

            </tr>


        </tbody>
    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="56.5%">Relationship with the guardian: {{ $profile->guardian_relationship }}

                </td>
                <td width="23%">Contact No: {{ $profile->guardian_contact }}

                </td>

                <td width="20%" >
                    Accident experienced
                </td>

            </tr>

        </tbody>
    </table>


    <table width="100%">

        <tbody>
            <tr>
                <td width="56.5%">Occupation: {{ $profile->guardian_occupation }}

                </td>
                <td width="23%">Age: {{ $profile->guardian_age }}

                </td>

                <td width="20%">
                    @if ($profile->accidents->count() > 0)
                    1) {{ $profile->accidents[0]->accidents }}
                    <!-- Display other medicine attributes as needed -->
                @else
                    1)
                @endif
                </td>

            </tr>

        </tbody>
    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%">Address: {{ $profile->guardian_address }}

                </td>


                <td width="20%">
                    @if ($profile->accidents->count() > 0)
                    2) {{ $profile->accidents[1]->accidents }}
                    <!-- Display other medicine attributes as needed -->
                @else
                    2)
                @endif
                </td>

            </tr>

        </tbody>
    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="79.5%" class="bold">Educational Background:

                </td>


                <td width="20%">
                    @if ($profile->accidents->count() > 0)
                    3) {{ $profile->accidents[2]->accidents }}
                    <!-- Display other medicine attributes as needed -->
                @else
                    3)
                @endif
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
            @if ($profile->education)
                @foreach ($profile->education as $educations)
                    <tr>
                        <td width="15%">
                            Grade:{{ $educations->grade_level }}
                        </td>
                        <td width="41%">
                            {{ $educations->school_name }}

                        </td>
                        <td width="23.5%">
                            {{ $educations->grade_section }}
                        </td>
                        <td width="20%">
                            {{ $educations->school_year }}
                        </td>

                    </tr>
                @endforeach
            @else
                <td width="100%">

                </td>
            @endif

        </tbody>
    </table>

 {{-- <div class="page-break"></div> --}}

    {{-- Second Page --}}
    <div class="page-break"></div>
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
            @if($profile->awards)
@foreach ($profile->awards as  $awards)
            <tr>
                <td width="79.5%">
                    {{ $awards->award_name }}
                </td>


                <td width="20%">
                    {{ $awards->award_year }}
                </td>

            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <table width="100%">

        <tbody>
            <tr>
                <td>What is yor favorite subject/s? {{ $profile->favorite_subject }}
                </td>
            </tr>
            <tr>
                <td>
                    What subject do you find difficult? {{ $profile->difficult_subject }}
                </td>
            </tr>
            <tr>
                <td>
                    What school organizations are you afiliated? {{ $profile?->school_organization ?? ''}}
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
                    <div class="checkbox @if ($profile->graduation_plan === 'Go to College') check @endif"></div>

                    <label class="label">Go to College</label>
                </td>
                <td width="33%">
                <div class="checkbox @if ($profile->graduation_plan === 'Work as a skilled worker') check @endif"></div>

                    <label class="label">Work as a skilled worker</label>
                </td>

                <td width="33%">
                <div class="checkbox @if ($profile->graduation_plan === 'Pursue TESDA certificates') check @endif"></div>

                    <label class="label">Pursue TESDA certificates</label>
                </td>

            </tr>


            <tr>
                <td width="33%">
                <div class="checkbox @if ($profile->graduation_plan === 'Engage in Business') check @endif"></div>

                    <label class="label">Engage in Business</label>
                </td>
                <td width="33%">
                <div class="checkbox @if ($profile->graduation_plan === 'Work to help parents') check @endif"></div>

                    <label class="label">Work to help parents</label>
                </td>

                <td width="33%">
                <div class="checkbox @if ($profile->graduation_plan === 'Undecided') check @endif"></div>
                    <label class="label">Undecided</label>
                </td>



            </tr>


        </tbody>
    </table>

    <br>

    <table width="100%" style="background-color: black">

        <tbody>
            <tr>
                <td class="bold" style="color: white">
                    ANECDOTAL (SUMMARY)
                </td>
            </tr>
        </tbody>

    </table>





    </table>
    <table width="100%">

        <tbody>
            <tr>
                <td width="21%" class="bold">Date</td>
                <td width="26%" class="bold">Observed Behavior</td>
                <td width="26%" class="bold">Desired Behavior</td>
                <td width="26%" class="bold">Remarks/Follow Up</td>
            </tr>
        </tbody>

        <tbody>
            @if ($profile->student->anecdotal && $profile->student->anecdotal->count() > 0)
                @foreach ($profile->student->anecdotal as $studentAnecdotal)
                    <tr>
                        <td>{{ $studentAnecdotal->created_at->format('F j, Y') }}</td>
                        <td>{{ $studentAnecdotal->observation }}</td>
                        <td>{{ $studentAnecdotal->desired }}</td>
                        <td>{{ $studentAnecdotal->outcomes->outcome_remarks }}</td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td>No Anecdotal</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        </tbody>

    </table>


    <table width="100%">


        <tbody>
            <tr>
                <td width="21%" class="footer">
                    Thank you for taking time to answer this survey. Rest assured that all of the
                    information that you have shared with us shall be strictly treated as confidential and shall
                    be handled with due respect. - Guidance office, CZCMNNHS
                </td>
            </tr>
        </tbody>
    </table>


</body>

</html>
