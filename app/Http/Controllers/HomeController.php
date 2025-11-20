<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     */
    public function index()
    {
        return view('home');
    }
}
