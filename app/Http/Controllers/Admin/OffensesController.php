<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OffenseRequest;
use App\Models\Offenses;
use Illuminate\Http\Request;

class OffensesController extends Controller
{
    public function index()
    {
        return view('admin.settings.offenses.index');
    }

    public function view($offense) {
        $offense = Offenses::findOrFail($offense);
        return view('admin.settings.offenses.view',compact('offense'));
    }


}
