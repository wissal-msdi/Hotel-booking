<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated and Verified Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes (Only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Room Routes
// Public route to view available rooms
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});

// Authenticated users can access room creation
Route::middleware('auth')->group(function () {
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
});

// Admin-only room management (CRUD)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('rooms', RoomController::class)->except(['index', 'create', 'store']);
    Route::get('/admin/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations.index');
});

// Reservation Routes (Authenticated users)
Route::resource('reservations', ReservationController::class)->middleware('auth');

// Auth scaffolding
require __DIR__.'/auth.php';
