<?php

use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'appName' => 'JobLens',
        'applications' => [
            ['id' => 1, 'company' => 'Stripe',    'role' => 'Backend Engineer',    'status' => 'Interview', 'date' => 'Apr 10'],
            ['id' => 2, 'company' => 'Notion',    'role' => 'Full Stack Developer', 'status' => 'Applied',   'date' => 'Apr 12'],
            ['id' => 3, 'company' => 'Vercel',    'role' => 'Laravel Developer',   'status' => 'Rejected',  'date' => 'Apr 14'],
            ['id' => 4, 'company' => 'Shopify',   'role' => 'Vue.js Developer',    'status' => 'Offer',     'date' => 'Apr 15'],
            ['id' => 5, 'company' => 'Basecamp',  'role' => 'Software Engineer',   'status' => 'Applied',   'date' => 'Apr 17'],
        ],
    ]);
});
