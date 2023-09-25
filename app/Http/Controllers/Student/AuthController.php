<?php

namespace App\Http\Controllers\Student;

use App\Models\Profile;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Student;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login($profileId)
    {
        return view('student.profile-data.auth', compact('profileId'));
    }

    public function auth(Request $request, $profileId)
    {
        $profile = Profile::findOrFail($profileId);
        $lrnInput = $request->input('lrn');
        $studentLrn = $profile->student->lrn;
        $studentLast4Digits = substr($studentLrn, -4);

        if ($lrnInput === $studentLast4Digits) {
            Session::put('authenticated_profile_id', $profile->id);
            return redirect()->route('student.profile.data', $profile->id);
        } else {
            return redirect()->route('student.login', ['profileId' => $profileId])->with('message', 'Invalid LRN');
        }
    }

}
