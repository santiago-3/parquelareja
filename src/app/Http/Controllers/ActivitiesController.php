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

        for($i = 0; $i < count($next_activities); $i++){
            if (!is_null($next_activities[$i]->picture)){
                $next_activities[$i]['image_path'] = $next_activities[$i]->picture->getPath();
            }
        }

        for($i = 0; $i < count($old_activities); $i++){
            if (!is_null($old_activities[$i]->picture)){
                $old_activities[$i]['image_path'] = $old_activities[$i]->picture->getPath();
            }
        }

        // $this->addJs('assets/js/activities.js');
        return view('activities', compact('next_activities', 'old_activities'));
    }
}
