@if(request()->is('admin/reports'))
    <div>
        <p class="text-2xl">
        Table: Student Cases
        </p>
    </div>
@endif

@if(request()->is('admin/student-profile'))
    <div>
        <p class="text-2xl">
        Table: Student Profile
        </p>
    </div>
@endif

@if(request()->is('admin/settings/classrooms'))
    <div>
        <p class="text-2xl">
        Table: Classrooms
        </p>
    </div>
@endif

@if(request()->is('admin/settings/teachers'))
    <div>
        <p class="text-2xl">
        Table: Teachers Adviser/Non Advicee
        </p>
    </div>
@endif

@if(request()->is('admin/settings/students'))
    <div>
        <p class="text-2xl">
        Table: Students
        </p>
    </div>
@endif

@if(request()->is('admin/settings/offenses'))
    <div>
        <p class="text-2xl">
        Table: Offenses
        </p>
    </div>
@endif

@if(request()->is('admin/settings/report/history'))
    <div>
        <p class="text-2xl">
        Table: Report History
        </p>
    </div>
@endif

@if(request()->is('admin/settings/audit-trail'))
    <div>
        <p class="text-2xl">
        Table: Audit Trail
        </p>
    </div>
@endif

@if(request()->is('admin/user/accounts'))
    <div>
        <p class="text-2xl">
        Table: User Accounts
        </p>
    </div>
@endif



