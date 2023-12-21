<?php

use App\Models\Students;
use Illuminate\Support\Facades\Route;
if (Route::is('admin.settings.students')){

return Students::query()
->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
->select(
    'students.*',
    'students.created_at',
    'students.status',
    'classrooms.grade_level as grade_level',
    'classrooms.section as section'
);
}elseif(Route::is('admin.settings.students.filtered.male')){

return Students::query()
->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
->select(
    'students.*',
    'students.created_at',
    'students.status',
    'classrooms.grade_level as grade_level',
    'classrooms.section as section'
)->where('students.gender', '=', 0)->where('students.status', '=',  0);
}elseif(Route::is('admin.settings.students.filtered.female')){

return Students::query()
->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
->select(
    'students.*',
    'students.created_at',
    'students.status',
    'classrooms.grade_level as grade_level',
    'classrooms.section as section'
)->where('students.gender', '=', 1)->where('students.status', '=',  0);
}
