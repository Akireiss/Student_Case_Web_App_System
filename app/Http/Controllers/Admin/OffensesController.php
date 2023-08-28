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

    public function create()
    {
        return view('admin.settings.offenses.create');
    }

    public function store(OffenseRequest $request)
    {
        $validatedData = $request->validated();

        $offenses = new Offenses;
        $offenses->offenses = $validatedData['offenses'];
        $offenses->description = $validatedData['description'];
        $offenses->status = $request->status == true ? '1' : '0';

        $offenses->save();

        return redirect('admin/settings/offenses')->with('message', 'Upload Succesfull');

    }

    public function view($offense) {
        $offense = Offenses::findOrFail($offense);
        return view('admin.settings.offenses.view',compact('offense'));
    }


}
