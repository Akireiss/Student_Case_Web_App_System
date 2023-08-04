<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OffenseRequest;
use App\Models\Offenses;
use Illuminate\Http\Request;

class OffensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.offenses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.offenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offenses $offense)
    {
        return view('admin.settings.offenses.edit', compact('offense'));
    }

    public function update(Request $request, string $id)
    {
      // Validate the form data
      $validatedData = $request->validate([
        'offenses' => 'required',
        'status' => 'required|in:0,1',
        'description' => 'required',
    ]);

    // Find the offense by ID
    $offense = Offenses::findOrFail($id);

    // Update the offense with the validated data
    $offense->update($validatedData);

    // Redirect back or to any other page you desire
    return redirect('admin/settings/offenses')
    ->with('message', 'Offense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
