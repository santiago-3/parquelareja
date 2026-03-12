<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionsController extends Controller
{
    /**
     * Display a listing of productions
     */
    public function index()
    {
        return view('productions.index');
    }
}
