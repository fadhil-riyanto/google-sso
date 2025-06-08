<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthAPI;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('/generate_sso_login', [GoogleAuthAPI::class, '']);

    });
    // api v2 here, for future
});