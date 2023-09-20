<?php

namespace App\Http\Controllers\Student;

use App\Models\Profile;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Student;

class AuthController extends Controller
{
    public function login($profileId) {
        // You can remove this line since $profileId is already passed as a parameter
        // $profileId = Profile::findOrFail($profileId);

        // Assuming you want to load the login view here
        return view('student.profile-data.auth', compact('profileId'));
    }
    public function auth(Request $request, $profileId) {
        $profile = Profile::findOrFail($profileId);
        $studentLrn = $profile->student->lrn;
        $lrnInput = $request->input('lrn');

        // Get the last 4 digits of the student's LRN
        $studentLast4Digits = substr($studentLrn, -4);


        if ($lrnInput === $studentLast4Digits) {
            // If they match, redirect to the student's profile page
            return redirect()->route('student.profile.data', $profile->id);
        } else {
            // If they don't match, show an error message and redirect back to the login form
            return redirect()->route('student.login', ['profileId' => $profileId])->with('error', 'Invalid LRN');
        }
    }


}
