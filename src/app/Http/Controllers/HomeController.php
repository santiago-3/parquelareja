<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the park page
     */
    public function park()
    {
        return view('park');
    }

    /**
     * Show the other parks page
     */
    public function otherParks()
    {
        return view('other-parks');
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        return view('contact');
    }
}	
