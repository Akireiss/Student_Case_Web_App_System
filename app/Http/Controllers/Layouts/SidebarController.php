<?php

namespace App\Http\Controllers\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SidebarController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function reports()
    {
        return view('livewire.student.report');
    }


}
