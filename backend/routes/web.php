<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Define the admin route
Route::get('/admin/{any?}', function ($any = null) {
    // Handle admin-specific logic here
    return response('Admin route: ' . $any);
})->where('any', '.*'); // Allow any subpaths under /admin

// Define the api route
Route::get('/api/{any?}', function ($any = null) {
    // Handle API-specific logic here
    return response('API route: ' . $any);
})->where('any', '.*'); // Allow any subpaths under /api

Route::get('/{any?}', function ($any = null) {
    $path = public_path() . '/app/';
    $path .= $any ? $any . '/index.html' : 'index.html';

    if (File::exists($path)) {
        return File::get($path);
    }

    abort(404); // Return a 404 error if the file doesn't exist
})->where('any', '^(?!admin|api).*$');
