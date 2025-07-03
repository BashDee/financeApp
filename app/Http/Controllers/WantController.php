<?php

namespace App\Http\Controllers;

use App\Models\Want;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class WantController extends Controller
{
    public function index()
    {
        $wants = Want::where('user_id', Auth::id())->latest()->get();
        return Inertia::render('NeedsWants', [
            'wants' => $wants,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'nullable|numeric',
        ]);
        $want = Want::create([
            'user_id' => Auth::id(),
            ...$validated,
        ]);
        return redirect()->route('wants.index');
    }

    public function destroy(Want $want)
    {
        $this->authorize('delete', $want);
        $want->delete();
        return redirect()->route('wants.index');
    }
} 