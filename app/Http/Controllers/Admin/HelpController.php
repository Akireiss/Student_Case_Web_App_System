<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index() {
        return view('admin.help.index');
    }

    public function show(Activity $activity) {
        $activityData = json_decode($activity->properties, false);
        return view('admin.settings.audit-trail.view', compact('activityData', 'activity'));
    }
}
