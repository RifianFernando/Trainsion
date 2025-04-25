<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AchievementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\BookingTrainController;

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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::prefix('/trains')->group(function () {
        Route::post('', [BookingTrainController::class, 'create'])->name('createTrainBooking');
    });
});
Route::prefix('/trains')->group(function () {
    Route::get('', [BookingTrainController::class, 'index'])->name('listTrain');
});
