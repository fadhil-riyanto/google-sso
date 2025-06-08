<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\DashboardController;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('index');
});


// Route::prefix('api')->group(function () {
//     Route::prefix('v1')->group(function () {
//         // NOTE: use POST in future, we want handle it using ajax
//         Route::get('/generate_sso_login', function () {
//             return Socialite::driver("google")->redirect();
//         });
//         Route::get('/oauth_callback', );

//     });
//     // api v2 here, for future
// });

Route::prefix('auth')->group(function () {
    Route::get('/redirect', [GoogleAuthController::class, 'redirect']);
    Route::get('/callback', [GoogleAuthController::class, 'handle_oauth_callback']);
});

Route::prefix('dashboard')->group(function () {
    Route::get('/index', [DashboardController::class, 'index']);
    // Route::get('/callb', [GoogleAuthController::class, 'handle_oauth_callback']);
});



Route::prefix('debug')->group(function () {
    Route::get('/upsert', [DebugController::class, 'debug_upsert']);
    Route::get('/custom_guard', [DebugController::class, 'debug_custom_guard']);
    Route::get('/auth_guard', [DebugController::class, 'debug_auth_guard']);
    
    
});


Route::get('/login', function() {
    return view("login");
});