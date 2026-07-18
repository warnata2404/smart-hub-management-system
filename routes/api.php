<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */

    Route::post('/register', function () {
        //
    });

    Route::post('/login', function () {
        //
    });

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', function () {
            //
        });

        Route::get('/user', function () {
            //
        });
    });
});
