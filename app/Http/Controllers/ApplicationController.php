<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'application' => Application::query()->latest()->get()
        ]);
    }
    public function store(Request $request)
}
