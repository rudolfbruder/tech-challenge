<?php

use App\Http\Controllers\Client\Bookings\ClientBookingController;
use App\Http\Controllers\Client\Journal\ClientJournalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('client/{client}/bookings', [ClientBookingController::class,'index']);
    Route::delete('client/{client}/booking/{booking}', [ClientBookingController::class,'destroy']);
});

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('client/{client}/journals', [ClientJournalController::class,'index']);
    Route::post('client/{client}/journal', [ClientJournalController::class,'store']);
    Route::delete('client/{client}/journal/{journal}', [ClientJournalController::class,'destroy']);
});
