<?php

namespace App\Http\Controllers\Adviser;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use View;

class StudentProfileController extends Controller
{
    public function show($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return redirect()->route('error')->with('message', 'Student Profile not found.');
        }

        return view('staff.profile.view', compact('profile'));
    }

}
