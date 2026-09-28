<?php

namespace App\Http\Controllers;

class AthleteDashboardController
{
    public function index()
    {
        return view('athlete.dashboard');
    }
}