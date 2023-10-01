<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HelpController extends Controller
{
    public function index()
    {
        return view('admin.help.index');
    }


public function show(Activity $activity)
{
    $activityData = json_decode($activity->properties, true);
    $formattedOld = $this->formatProperties($activityData['old'] ?? []);
    $formattedNew = $this->formatProperties($activityData['attributes'] ?? []);

    return view('admin.settings.audit-trail.view', compact('activity', 'formattedOld', 'formattedNew'));
}

private function formatProperties($properties)
{
    return collect($properties)
        ->map(function ($value, $key) {
            return Str::ucfirst($key) . ': ' . $value;
        })
        ->implode(', ');
}


}
