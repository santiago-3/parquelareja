<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of reservations
     */
    public function index()
    {
        return view('reservations.index');
    }
}
