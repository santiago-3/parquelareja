<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductionsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ActivitiesController;

// Home/Park routes
Route::get('/el-parque', [HomeController::class, 'park'])->name('park');
Route::get('/otros-parques', [HomeController::class, 'otherParks'])->name('other.parks');
Route::get('/contacto', [HomeController::class, 'contact'])->name('contact');

// Productions routes
Route::get('/producciones', [ProductionsController::class, 'index'])->name('productions.index');

// Calendar routes
Route::get('/calendario-de-uso', [CalendarController::class, 'index'])->name('calendar.index');

// Reservations routes
Route::get('/reservas', [ReservationsController::class, 'index'])->name('reservations.index');

// Activities routes
Route::get('/actividades', [ActivitiesController::class, 'index'])->name('activities.index');
