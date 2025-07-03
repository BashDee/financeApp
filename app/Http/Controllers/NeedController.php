<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class NeedController extends Controller
{
    public function index()
    {
        $needs = Need::where('user_id', Auth::id())->latest()->get();
        return Inertia::render('NeedsWants', [
            'needs' => $needs,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'nullable|numeric',
        ]);
        $need = Need::create([
            'user_id' => Auth::id(),
            ...$validated,
        ]);
        return redirect()->route('needs.index');
    }

    public function destroy(Need $need)
    {
        $this->authorize('delete', $need);
        $need->delete();
        return redirect()->route('needs.index');
    }
} 