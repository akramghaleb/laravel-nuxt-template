<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/{any?}', function ($any = null) {
    $path = public_path() . '/app/';
    $path .= $any ? $any . '/index.html' : 'index.html';

    if (File::exists($path)) {
        return File::get($path);
    }

    abort(404); // Return a 404 error if the file doesn't exist
})->where('any', '^(?!admin|api).*$');
