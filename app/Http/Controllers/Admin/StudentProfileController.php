<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Models\Anecdotal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentProfileController extends Controller
{

    public function index()
    {
        return view('admin.student-profile.index');
    }

    public function show($id)
    {
        $profile = Profile::with('family')->find($id);

        if(!$profile)
        {
            abort(403);
        }


        if (auth()->check()) {
            // User is authenticated
            return view('admin.student-profile.view', compact('profile'));
        } else {
            // Guest user
            return view('student.profile.view', compact('profile'));
        }

    }

}
