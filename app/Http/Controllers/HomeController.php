<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->user()) {
            return Inertia::render('home-auth');
        }

        return Inertia::render('home-guest', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    }
}
