<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }



   public function circuito()
    {
        return view('circuito');
    }

    public function tours()
    {
        return view('tours');
    }

    public function hotel()
    {
        return view('hotel');
    }



}
