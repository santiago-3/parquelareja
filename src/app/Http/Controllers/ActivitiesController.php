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
        $next_activities = Activity::where('date', '>', date('Y-m-d H:i:s'))->orderBy('date', 'asc')->get();
        $old_activities	 = Activity::where('date', '<', date('Y-m-d H:i:s'))->orderBy('date', 'desc')->limit(8)->get();

        return view('activities', compact('next_activities', 'old_activities'));
    }
}
