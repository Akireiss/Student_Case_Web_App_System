<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        .page-break {
    page-break-after: always;
}
        table {
            font-size: x-small;
        }
        .gray {
            background-color: lightgray;
        }

        table.inline {
            border-collapse: collapse;
            width: 100%;
        }
        table.inline td {
            border: 1px solid black;
            padding: 5px;
        }
        table.inline th {
            border: 1px solid black;
            padding: 5px;
        }
        .border-right {
            border-right: 1px solid black;

        }
        .border-left {
            border-left: 1px solid black;

        }
        .no-padding {
            margin:0%;
        }
        .bold{
            font-weight: bold;
            margin-top: 8px;
        }
        .hide{
            display: hidden;
        }
        .text-center{
            text-align: center
        }
        .text-left{
            text-align: center
        }
        .main{
            padding: 10px;
        }
        .left{
            text-align: left;
        }
    </style>
</head>
<body>
    <table class="inline">
        <tr >
            <td class="bold">CZCMNHS INDIVIDUAL INVENTORY</td>
            <td class="text-left">Guidance Form 1</td>
        </tr>
    </table>

    <table class="inline">

        <tr class="border">
            <td class="left bold">Personal Profile</td>
        </tr>
    </table>
    <table class="inline">
        <tr>
            <td>Last Name:  {{ $profile->student->last_name }}</td>
            <td class="border-right">Age: {{ $profile->age }}</td>
        </tr>
        <tr>
            <td class="no-padding">First Name: {{ $profile->student->first_name }}</td>
            <td class="border-right no-padding">Suffix: {{ $profile->suffix   }}</td>
        </tr>
        <tr>
            <td class="no-padding">Middle Name: {{ $profile->student->middle_name }}</td>
            <td class="border-right no-padding">Sex:  {{ $profile->sex   }}</td>
        </tr>
    </table>
    <table class="inline">
        <tr>
            <td class="no-padding">Nickname: {{ $profile->nickname }}</td>
            <td class="border-right no-padding">Birthdate: {{ $profile->birthdate }}</td>
            <td class="border-right no-padding">Birth Place: Butubut Norte Balaoan</td>
        </tr>
    </table>


    <table class="inline">
        <tr>
            <td>Address: {{ $profile->municipal->municipality }}, {{ $profile->barangay->barangay }} </td>
            <td class="border-right">Contact Number: {{ $profile->contact }}</td>
            <td class="border-right">Height:{{ $profile->height }}</td>
        </tr>
        <tr>
            <td>Birth Order: {{ $profile->birth_order }}</td>
            <td class="border-right">Number of Siblings: {{ $profile->no_of_siblings }}</td>
            <td class="border-right">Weight: {{ $profile->weight }}</td>

        </tr>

    </table>


    <table class="inline">
        <tr>
            <td class="no-padding">Religion: {{ $profile->religion }}</td>
            <td class="border-right no-padding">Mother Tongue: {{ $profile->mother_tongue }}</td>
            <td class="border-right no-padding">4ps Recipeint: {{ $profile->four_ps }}</td>
            <td class="border-right">BMI: {{ $profile->bmi }}</td>

        </tr>
    </table>
    <table class="inline">
        <tr>
            <td class="bold">Family Background    </td>
            <td class="no-padding"> Do you
                <br>have dissability?</td>
            <td class=" no-padding">{{ $profile->disability }}</td>

        </tr>
    </table>
    <table class="inline">
        <tr>
            <td> </td>
            <td class="border-right no-padding">Mother</td>
            <td class="border-left no-padding">Father:</td>

        </tr>

        @foreach ($profile->family as $father)
        @if ($father->parent_type === 0)

        @foreach ($profile->family as $mother)
        @if ($mother->parent_type === 1)
        <tr>
            <td class="border-right no-padding">Name:</td>
            <td class="border-right no-padding">{{ $mother->parent_name }}</td>
            <td class="border-right no-padding">{{ $father->parent_name }}</td>
        </tr>
        <tr>
            <td class="border-right no-padding">Place of birth:</td>
            <td class="border-right no-padding">{{ $mother->parent_birth_place }}</td>
            <td class="border-right no-padding">{{ $father->parent_birth_place }}</td>
        </tr>

        <tr>
            <td class="border-right no-padding">Age:</td>
            <td class="border-right no-padding">{{ $mother->parent_age }}</td>
            <td class="border-right no-padding">{{ $father->parent_age }}</td>
        </tr>

        <tr>
            <td class="border-right no-padding">Occupation:</td>
            <td class="border-right no-padding">{{ $mother->parent_occupation }}</td>
            <td class="border-right no-padding">{{ $father->parent_occupation }}</td>
        </tr>
        <tr>
            <td class="border-right no-padding">Place of work:</td>
            <td class="border-right no-padding">{{ $mother->parent_work_address }}</td>
            <td class="border-right no-padding">{{ $father->parent_work_address }}</td>
        </tr>
        <tr>
            <td class="border-right no-padding">Contact No:</td>
            <td class="border-right no-padding">{{ $mother->parent_contact }}</td>
            <td class="border-right no-padding">{{ $father->parent_contact }}</td>
        </tr>
        <tr>
            <td class="border-right no-padding">Office Contact:</td>
            <td class="border-right no-padding">{{ $mother->parent_office_contact }}</td>
            <td class="border-right no-padding">{{ $father->parent_office_contact }}</td>
        </tr>
        <tr>
            <td class="border-right no-padding">Monthly Income:</td>
            <td class="border-right no-padding">{{ $mother->parent_monthly_income }}</td>
            <td class="border-right no-padding">{{ $father->parent_monthly_income }}</td>
        </tr>
        @endif
        @endforeach
        @endif
        @endforeach


    </table>
    <table class="inline">
        <tr>
            <td class="bold">List down the names of Siblings that are studying in CZCMNHS
        </tr>
    </table>


    <table class="inline">
        <tr>
            <th>Name </th>
            <th>Age</th>
            <th>Grade and Section</th>
        </tr>
        @if ($profile->siblings->isNotEmpty())
            @foreach ($profile->siblings as $sibling)
        <tr>

            <td>{{ $sibling->sibling_name }}</td>
            <td>{{ $sibling->sibling_age }}</td>
            <td>{{ $sibling->sibling_grade_section }}</td>

        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">No Record Found</td>
        </tr>
    @endif
    </table>
    <table class="inline">
        <tr>
            <td >You are currently living with: {{$profile->living_with}} </td>
        </tr>
        <tr>
        <td >Parent are currently: </td>
        </tr>
        <tr>
            <td >Guardian Name: {{ $profile->guardian_name }}</td>
        </tr>
    </table>
    <table class="inline">
        <tr>
            <td>Relationship with the guardian:  {{ $profile->guardian_relationship }} </td>
            <td >Contact No: {{ $profile->guardian_contact }} </tr>
            </tr>
            <tr>
                <td >Occupation: {{ $profile->guardian_occupation }}</td>
                <td >Age:{{ $profile->guardian_age }} </tr>
                </tr>
    </table>

    <table  class="inline">
        <tr>
            <th>Grade Level</th>
            <th>School Name</th>
            <th>School Year</th>
            <th>Grade Section</th>
        </tr>
        @if ($profile->education->isNotEmpty())
            @foreach ($profile->education as $educ)
                <tr>
                    <td>Grade: {{ $educ?->grade_level ?? 'No Data' }}</td>
                    <td>{{ $educ?->school_name ?? 'No Data' }}</td>
                    <td>{{ $educ?->school_year ?? 'No Data' }}</td>
                    <td>{{ $educ?->grade_section ?? 'No Data'}}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">No education records available.</td>
            </tr>
        @endif
    </table>

    {{-- Page 2 --}}
    <div class="page-break"></div>

    <table class="inline">
        <tr>
            <td class="bold">Name some of your Academic and Extra-Curricular Awards:
        </tr>
    </table>

    <table  class="inline">


        <tr>
            <th class="left">Name of Award</th>
            <th class="left">Year Achived</th>
        </tr>

        @if ($profile->awards->isNotEmpty())
            @foreach ($profile->awards as $award)
                <tr>
                    <td>{{ $award->award_name }}</td>
                    <td>{{ $award->award_year }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">No record found.</td>
            </tr>
        @endif
    </table>

    <table  class="inline">
            <tr>
                <td colspan="4">What is yor favorite subject/s? {{$profile->favorite_subject  }}</td>

            </tr>
            <tr>
                <td colspan="4">What is yor favorite subject/s? {{$profile->difficult_subject  }}</td>

            </tr>
            <tr>
                <td colspan="4">What school organizations are you afiliated? {{$profile->school_organization  }}</td>

            </tr>

            <tr>
                <td colspan="4"> What do you plan to do after graduating Senior High School? {{$profile->graduation_plan  }}</td>
            </tr>

    </table>


</body>
</html>



