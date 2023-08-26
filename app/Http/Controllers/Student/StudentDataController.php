<?php

namespace App\Http\Controllers\Student;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentDataController extends Controller
{
    public function index($form_id) {
        $form = Profile::findOrFail($form_id); // Assuming "Profile" is your model class

        // Pass the retrieved form data to the view
        return view('student.profile-data.index', ['form' => $form]);
    }


}
