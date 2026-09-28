<?php

namespace App\Http\Controllers;

class DashboardController
{
    public function index()
    {
        $usuario = auth()->user();

        if ($usuario->role === 'coach') {
            return redirect()->route('coach.dashboard');
        }

        if ($usuario->role === 'athlete') {
            return redirect()->route('athlete.dashboard');
        }

        abort(403);
    }
}