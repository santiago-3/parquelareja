<?php

use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\PriceItemController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationExtraController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ActivityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ActivityController::class, 'index']);
    Route::resource('activities', ActivityController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('people', PersonController::class);
    Route::resource('states', StateController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('reservation-extras', ReservationExtraController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('price-items', PriceItemController::class);
});

require __DIR__.'/auth.php';
