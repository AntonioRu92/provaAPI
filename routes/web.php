<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/klaviyo/test', [\App\Http\Controllers\KlaviyoController::class, 'sendTest']);
