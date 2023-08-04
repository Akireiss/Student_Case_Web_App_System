<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anecdotal;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{

    public function index()
    {
        return view('admin.student-profile.index');
    }

    public function show()
    {
    return('dsds');
    }

}
