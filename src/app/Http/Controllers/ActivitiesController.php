<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of activities
     */
    public function index()
    {
        $activities = Activity::where('date', '>', date('Y-m-d H:i:s'))
            ->orderBy('date', 'asc')->get();

        return view('activities', compact('activities'));
    }

    public function past()
    {
        $activities	 = Activity::where('date', '<', date('Y-m-d H:i:s'))
            ->orderBy('date', 'desc')
            ->limit(20)
            ->get();

        return view('past-activities', compact('activities'));
    }

    public function load(Request $request, $offset) {
        $activities	= Activity::where('date', '<', date('Y-m-d H:i:s'))
            ->orderBy('date', 'desc')
            ->offset($offset)
            ->limit(20)
            ->with('image')
            ->get();

        return response()->json($activities);
    }
}
