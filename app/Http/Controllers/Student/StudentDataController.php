<?php

namespace App\Http\Controllers\Student;

use App\Models\Profile;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentDataController extends Controller
{
    public function index($form_id) {
        $form = Profile::findOrFail($form_id);
        return view('student.profile-data.index', ['form' => $form]);
    }


    public function view($form_id) {
        $profile = Profile::findOrFail($form_id);
        return view('student.profile.view', compact('profile'));
    }

    // public function viewCases() {
    //     return view('');
    // }



}
