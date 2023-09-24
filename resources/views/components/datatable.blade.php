@if(request()->is('admin/reports'))
    <div>
        Table: Student Cases
    </div>
@endif

@if(request()->is('admin/student-profile'))
    <div>
        Table: Student Profile
    </div>
@endif

@if(request()->is('admin/settings/classrooms'))
    <div>
        Table: Classrooms
    </div>
@endif

@if(request()->is('admin/settings/teachers'))
    <div>
        Table: Teachers Adviser/Non Advicee
    </div>
@endif



@if(request()->is('admin/settings/students'))
    <div>
        Table: Students
    </div>
@endif


@if(request()->is('admin/settings/offenses'))
    <div>
        Table: Offenses
    </div>
@endif



@if(request()->is('admin/settings/report/history'))
    <div>
        Table: Report History
    </div>
@endif


@if(request()->is('admin/settings/audit-trail'))
    <div>
        Table: Audit Trail
    </div>
@endif



