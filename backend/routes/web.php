<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/app/');
});

Route::get('/app', function() {
    return File::get(public_path() . '/app/index.html');
});

Route::get('/app/{any}', function($any) {
    return File::get(public_path() .  '/app/'.$any.'/index.html');
})->where('any', '.+');
