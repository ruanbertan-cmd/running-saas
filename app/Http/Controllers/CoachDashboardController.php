<?php

namespace App\Http\Controllers;

use App\Models\User;

class CoachDashboardController
{
    public function index()
    {
        $coach = auth()->user();

        $assessoria = $coach->assessoria;

        $atletas = $coach->athletes;

        return view('coach.dashboard', compact(
            'coach',
            'assessoria',
            'atletas'
        ));
    }

    public function athlete(User $athlete)
    {
        return view('coach.athlete', compact('athlete'));
    }
}