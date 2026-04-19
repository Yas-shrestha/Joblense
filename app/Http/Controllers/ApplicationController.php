<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'applications' => Application::where('user_id', Auth::id())
                ->latest()
                ->get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'role' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);

        Application::create([
            'user_id' => Auth::id(),
            'company' => $request->company,
            'role'    => $request->role,
            'status'  => $request->status,
            'date'    => now()->format('M d'),
        ]);

        return redirect()->back();
    }
    public function update(Request $request, Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Applied,Interview,Offer,Rejected',
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->back();
    }

    public function destroy(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }
        $application->delete();
        return redirect()->back();
    }
}
