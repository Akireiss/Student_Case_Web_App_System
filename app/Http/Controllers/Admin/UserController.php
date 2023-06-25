<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('admin.user.add-user');
    }
    public function update_acc() {
        return view('admin.user.update-acc');
    }



}
