<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     */
    public function index()
    {
        // Widok resources/views/home.blade.php
        return view('home');
    }
}
