<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of activities
     */
    public function index()
    {
        return view('activities');
    }
}
