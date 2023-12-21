
public function generateReport()
    {
        $highSchools = Classroom::where('status', 0)
        ->whereIn('grade_level', [7, 8, 9, 10 ])->get();

        $seniorHigh = Classroom::where('status', 0)
        ->whereIn('grade_level', [11, 12])
        ->get();

        $grave = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 1);
        });

        $minor = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 0);
        });

        $minorAndGrave = Anecdotal::count();

        return view('admin.settings.report.index', compact('highSchools', 'seniorHigh', 'grave', 'minor', 'minorAndGrave'));
    }

    public function generateReportPDF(Request $request)
    {
        $department = $request->input('department', 'All');

        $highSchool = $request->input('highSchool', 'All');

        $SeniorHigh = $request->input('SeniorHigh', 'All');

        $category = $request->input('selectedCategory', 'All');

        $year = $request->input('year', 'All');

        $status = $request->input('status', 'All');



        $SeniorId = $request->input('SeniorHigh');

        $highSchoolId = $request->input('highSchool');

        // Retrieve a single classroom instance
        $highSchoolIds = Classroom::where('id', $highSchoolId)->first();
        $seniorHighSchool = Classroom::where('id', $SeniorId)->first();

        $anecdotals = Anecdotal::query();

        // if ($classroomId !== 'All') {
        //     $anecdotals->whereHas('students', function ($query) use ($classroomId) {
        //         $query->where('classroom_id', $classroomId);
        //     });
        // }

        if ($department === 'All') {
            $anecdotals->where('case_status', $status);
        }

        if ($highSchool !== 'All') {
            $anecdotals->whereHas('students', function ($query) use ($highSchoolIds) {
                $query->whereIn('classroom_id', $highSchoolIds);
            });
        } else {
            $anecdotals->whereHas('students', function ($query) {
                $query->where('department', 0);
            });
        }


        if ($SeniorHigh !== 'All') {
            $anecdotals->whereHas('students', function ($query) use ($seniorHighSchool) {
                $query->whereIn('classroom_id', $seniorHighSchool);
            });
        } else {
            $anecdotals->whereHas('students', function ($query) {
                $query->where('department', 1);
            });
        }

        if ($category !== 'All') {
            $anecdotals->whereHas('offenses', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }

        if ($year !== 'All') {
            // Calculate the start and end dates for the selected year
            $yearParts = explode('-', $year);
            $startYear = Carbon::create($yearParts[0], 6, 1);
            $endYear = Carbon::create($yearParts[1], 5, 31)->endOfDay();

            $anecdotals->whereBetween('created_at', [$startYear, $endYear]);
        }

        if ($status !== 'All') {
            $anecdotals->where('case_status', $status);

        }

        // if ($status !== 'All') {
        //     $anecdotals->whereHas('offenses', function ($query) use ($status) {
        //         $query->where('status', 0);
        //     })->where('case_status', $status);

        // }
        // Get the data based on the query
        $anecdotals = $anecdotals->get();

        $allClassroom = Classroom::where('status', 0)->get();

        // Generate and stream the PDF
        $pdf = PDF::loadView('pdf.report', [
            'seniorHighSchool' => $seniorHighSchool,
            'highSchoolIds' =>  $highSchoolIds,
            'category' => $category,
            'anecdotals' => $anecdotals,
            'status' => $status,
            'year' => $year,
            'allClassroom' => $allClassroom,
        ]);



        return $pdf->stream('report.pdf');
    }



    // 'pendingSH' => $pendingSH,
            // 'ongoingSH' => $ongoingSH,
            // 'ResolveSH' => $ResolveSH,
            // 'FollowSH' => $FollowSH,
            // 'RefferSh' => $RefferSh


            //Case Staus's


// foreach ($classroomsSenior as $classroom) {
//     $totalPendingSH = Anecdotal::where('case_status', 0)->whereBetween('created_at',  [$startYear, $endYear])
//         ->where('grade_level', 'like', $classroom->first_letter.'%')
//         ->count();

//     $totalOGSH = Anecdotal::where('case_status', 1)
//         ->where('grade_level', 'like', $classroom->first_letter.'%')->whereBetween('created_at',  [$startYear, $endYear])
//         ->count();

//     $totalResSH = Anecdotal::where('case_status', 2)
//         ->where('grade_level', 'like', $classroom->first_letter.'%')->whereBetween('created_at',  [$startYear, $endYear])
//         ->count();

//     $totalFollowSH = Anecdotal::where('case_status', 3)
//     ->where('grade_level', 'like', $classroom->first_letter.'%')->whereBetween('created_at',  [$startYear, $endYear])
//     ->count();

//     $totalRefferSH = Anecdotal::where('case_status', 4)
//         ->where('grade_level', 'like', $classroom->first_letter.'%')->whereBetween('created_at',  [$startYear, $endYear])
//         ->count();


//     $pendingSH[$classroom->first_letter] =  $totalPendingSH;
//     $ongoingSH[$classroom->first_letter] = $totalOGSH;
//     $ResolveSH[$classroom->first_letter] = $totalResSH;
//     $FollowSH[$classroom->first_letter] = $totalFollowSH;
//     $RefferSh[$classroom->first_letter] = $totalRefferSH;
// }
public function datasource(): Builder
    {
        if (Route::is('admin.reports')){
        return Anecdotal::query()
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select(
                'anecdotal.*',
                'anecdotal.id as AnecdotalID',
                'anecdotal.created_at',
                'students.created_at as created',
                'offenses.created_at as created_offense',
                'offenses.offenses',
                'offenses.id as OffenseID',
                'students.id as StudentID'
            );
        }elseif (Route::is('admin.reports.pending')){
            return Anecdotal::query()
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select(
                'anecdotal.*',
                'anecdotal.id as AnecdotalID',
                'anecdotal.created_at',
                'students.created_at as created',
                'offenses.created_at as created_offense',
                'offenses.offenses',
                'offenses.id as OffenseID',
                'students.id as StudentID'
            )->where('case_status', 0);
        }elseif (Route::is('admin.reports.ongoing')){
            return Anecdotal::query()
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select(
                'anecdotal.*',
                'anecdotal.id as AnecdotalID',
                'anecdotal.created_at',
                'students.created_at as created',
                'offenses.created_at as created_offense',
                'offenses.offenses',
                'offenses.id as OffenseID',
                'students.id as StudentID'
            )->where('case_status', 1);
        }elseif (Route::is('admin.reports.resolved')){
            return Anecdotal::query()
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select(
                'anecdotal.*',
                'anecdotal.id as AnecdotalID',
                'anecdotal.created_at',
                'students.created_at as created',
                'offenses.created_at as created_offense',
                'offenses.offenses',
                'offenses.id as OffenseID',
                'students.id as StudentID'
            )->where('case_status', 2);
        }
    }
