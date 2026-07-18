<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\BookingItemController;
use App\Http\Controllers\Api\V1\BorrowingScheduleController;
use App\Http\Controllers\Api\V1\CheckInController;
use App\Http\Controllers\Api\V1\EquipmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Authentication Routes
    |--------------------------------------------------------------------------
    */

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/user', [AuthController::class, 'user']);

        /*
        |--------------------------------------------------------------------------
        | Equipment
        |--------------------------------------------------------------------------
        */

        Route::apiResource('equipments', EquipmentController::class);

        /*
        |--------------------------------------------------------------------------
        | Borrowing Schedule
        |--------------------------------------------------------------------------
        */

        Route::apiResource('borrowing-schedules', BorrowingScheduleController::class);

        /*
        |--------------------------------------------------------------------------
        | Booking
        |--------------------------------------------------------------------------
        */

        Route::apiResource('bookings', BookingController::class);

        /*
        |--------------------------------------------------------------------------
        | Booking Item
        |--------------------------------------------------------------------------
        */

        Route::apiResource('booking-items', BookingItemController::class);

        /*
        |--------------------------------------------------------------------------
        | Check In
        |--------------------------------------------------------------------------
        */

        Route::apiResource('check-ins', CheckInController::class);
    });
});
