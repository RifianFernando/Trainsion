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

// Route::middleware(['auth:sanctum', 'isAdmin'])->group(function(){
//     Route::prefix('/history')->group(function(){
//         Route::post('/create', [HistoryController::class, 'createHistory'])->name('createHistory');
//         Route::post('/update/{id}', [HistoryController::class, 'updateHistory'])->name('updateHistory');
//         Route::delete('/delete/{id}', [HistoryController::class, 'deleteHistory'])->name('deleteHistory');
//         Route::post('/search', [HistoryController::class, 'searchHistory'])->name('searchHistory');
//         Route::get('/count', [HistoryController::class, 'countHistory'])->name('countHistory');
//     });

//     Route::prefix('/structure')->group(function(){
//         Route::post('/create', [StructureController::class, 'createStructure'])->name('createStructure');
//         Route::post('/update/{id}', [StructureController::class, 'updateStructure'])->name('updateStructure');
//         Route::delete('/delete/{id}', [StructureController::class, 'deleteStructure'])->name('deleteStructure');
//         Route::post('/search', [StructureController::class, 'searchStructure'])->name('searchStructure');
//         Route::get('/count', [StructureController::class, 'countStructure'])->name('countStructure');
//     });

//     Route::prefix('/events')->group(function(){
//         Route::post('/create', [EventController::class, 'createEvent'])->name('createEvent');
//         Route::post('/update/{id}', [EventController::class, 'updateEvent'])->name('updateEvent');
//         Route::delete('/delete/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
//         Route::post('/search', [EventController::class, 'searchEvent'])->name('searchEvent');
//         Route::get('/count', [EventController::class, 'countEvent'])->name('countEvent');
//     });

//     Route::prefix('/achievements')->group(function(){
//         Route::post('/create', [AchievementController::class, 'createAchievement'])->name('createAchievement');
//         Route::post('/update/{id}', [AchievementController::class, 'updateAchievement'])->name('updateAchievement');
//         Route::delete('/delete/{id}', [AchievementController::class, 'deleteAchievement'])->name('deleteAchievement');
//         Route::get('/count', [AchievementController::class, 'countAchievement'])->name('countAchievement');
//     });

//     Route::prefix('/photo')->group(function(){
//         Route::post('/create', [PhotoController::class, 'createPhoto'])->name('createPhoto');
//         Route::post('/update/{id}', [PhotoController::class, 'updatePhoto'])->name('updatePhoto');
//         Route::delete('/delete/{id}', [PhotoController::class, 'deletePhoto'])->name('deletePhoto');
//         Route::post('/search', [PhotoController::class, 'searchPhoto'])->name('searchPhoto');
//         Route::get('/count', [PhotoController::class, 'countPhoto'])->name('countPhoto');
//     });

// });

Route::prefix('/trains')->group(function(){
    Route::post('', [BookingTrainController::class, 'create'])->name('createTrainBooking');
    Route::get('', [BookingTrainController::class, 'getTrainBookings'])->name('getTrainBookings');
    Route::get('/{id}', [BookingTrainController::class, 'getTrainBookingById'])->name('getTrainBookingById');
    Route::put('/{id}', [BookingTrainController::class, 'updateTrainBooking'])->name('updateTrainBooking');
    Route::delete('/{id}', [BookingTrainController::class, 'deleteTrainBooking'])->name('deleteTrainBooking');
});

Route::prefix('/history')->group(function(){
    Route::get('/view', [HistoryController::class, 'getHistories'])->name('getHistories');
    Route::get('/view/{id}', [HistoryController::class, 'getHistoryById'])->name('getHistoryById');
});

Route::prefix('/structure')->group(function(){
    Route::get('/view/{id}',[StructureController::class, 'getStructureById'])->name('getStructureById');
    Route::get('/view',[StructureController::class, 'getStructures'])->name('getStructures');
    Route::get('/region/{region}', [StructureController::class, 'getStructureByRegion'])->name('getStructureByRegion');
    Route::get('/region/structured/{region}', [StructureController::class, 'getStructuredRegionByDivision'])->name('getStructuredRegionByDivision');
});

Route::prefix('/events')->group(function(){
    Route::get('/view', [EventController::class, 'getEvents'])->name('getEvents');
    Route::get('/view/{id}', [EventController::class, 'getEventbyId'])->name('getEventbyId');
    Route::get('/view/region/{region}', [EventController::class, 'getEventbyRegion'])->name('getEventbyRegion');
});

Route::prefix('/achievements')->group(function(){
    Route::get('/view', [AchievementController::class, 'getAchievements'])->name('getAchievements');
    Route::get('/view/{id}', [AchievementController::class, 'getAchievementbyId'])->name('getAchievementbyId');
});

Route::post('/contact', [ContactUsController::class, 'sendContactEmail']);
