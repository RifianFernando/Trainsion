<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BookingTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\BookingTrainController;
use App\Http\Controllers\TicketPaymentController;
use App\Http\Controllers\TrainStationController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('/trains')->group(function () {
            Route::post('', [BookingTrainController::class, 'create'])->name('createTrainBooking');
            Route::delete('/{tid}', [BookingTrainController::class, 'destroy'])->name('deleteTrainBooking');
            Route::post('/update/{tid}', [BookingTrainController::class, 'update'])->name('updateBookingTrain');
        });

        Route::prefix('/booking-ticket')->group(function () {
            Route::get('/admin', [BookingTicketController::class, 'adminIndex'])->name('getAllBookingTicketUser');
        });

        Route::prefix('/payment')->group(function () {
            Route::post('/handle/{tid}', [TicketPaymentController::class, 'handleRejectAndAcceptPaymentStatus'])->name('chandleRejectAndAcceptPaymentStatusancelBookingTicket');
        });
    });

    Route::prefix('/booking-ticket')->group(function () {
        Route::get('', [BookingTicketController::class, 'index'])->name('getUserSessionBookingTicket');
        Route::get('/{btid}', [BookingTicketController::class, 'getUserSessionBookingTicketByID'])->name('getBookingTicketByID');
        Route::post('', [BookingTicketController::class, 'create'])->name('createBookingTicket');
    });

    Route::prefix('/payment')->group(function () {
        Route::post('', [TicketPaymentController::class, 'payBookingTicket'])->name('payBookingTicket');
        Route::delete('/{tid}', [TicketPaymentController::class, 'destroy'])->name('cancelBookingTicket');
    });
});

Route::prefix('/trains')->group(function () {
    Route::get('', [BookingTrainController::class, 'index'])->name('listTrain');
    Route::get('/{tid}', [BookingTrainController::class, 'getBookingTrainByID'])->name('listTrain');
});

Route::prefix('/station')->group(function () {
    Route::get('', [TrainStationController::class, 'index'])->name('listStation');
});
