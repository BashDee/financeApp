<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Need;
use App\Models\Want;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $needs = Need::where('user_id', Auth::id())->latest()->take(5)->get();
        $wants = Want::where('user_id', Auth::id())->latest()->take(5)->get();
        $needSum = Need::where('user_id', Auth::id())->sum('amount');
        $wantSum = Want::where('user_id', Auth::id())->sum('amount');
        return Inertia::render('Dashboard', [
            'needs' => $needs,
            'wants' => $wants,
            'needSum' => $needSum,
            'wantSum' => $wantSum,
        ]);
    }
} 