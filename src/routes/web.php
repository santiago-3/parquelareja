<?php

use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\PriceItemController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationExtraController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ReservationsController;


Route::get('el-parque', function() {
    return view('el-parque');
});

Route::get('producciones', function() {
    return view('productions');
});

Route::get('otros-parques', function() {
    return view('other-parks');
});

Route::get('uso-de-instalaciones', function() {
    return view('uso-de-instalaciones');
});

Route::get('como-llegar', function() {
    return view('como-llegar');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('calendario-de-uso', [CalendarController::class, 'index']);
Route::get('actividades', [ActivitiesController::class, 'index']);
Route::get('contacto', [ContactController::class, 'index']);
Route::post('contacto', [ContactController::class, 'index']);
Route::get('actividades-pasadas', [ActivitiesController::class, 'past']);
Route::get('reservas', [ReservationsController::class, 'index']);

//data
Route::get('load-activities/{offset}', [ActivitiesController::class, 'load']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::resource('activities', AdminActivityController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('people', PersonController::class);
    Route::resource('states', StateController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('reservation-extras', ReservationExtraController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('price-items', PriceItemController::class);
});

require __DIR__.'/auth.php';
