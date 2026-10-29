<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kritik;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with statistics.
     */
    public function index()
    {
        $stats = [
            'films'   => Film::count(),
            'genres'  => Genre::count(),
            'casts'   => Cast::count(),
            'users'   => User::count(),
            'kritiks' => Kritik::count(),
            'rating_avg' => round(Kritik::avg('rating'), 1),
        ];

        $latestFilms = Film::with('genre')->latest()->limit(5)->get();
        $latestKritiks = Kritik::with(['user', 'film'])->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'latestFilms', 'latestKritiks'));
    }
}
