<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

// Public routes
Route::get('/', [RoomController::class, 'index'])->name('home');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/booking/{room_id}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes (with auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/rooms', [RoomController::class, 'adminIndex'])->name('admin.rooms.index');
    Route::get('/admin/rooms/create', [RoomController::class, 'adminCreate'])->name('admin.rooms.create');
    Route::post('/admin/rooms', [RoomController::class, 'adminStore'])->name('admin.rooms.store');
    Route::get('/admin/rooms/{id}/edit', [RoomController::class, 'adminEdit'])->name('admin.rooms.edit');
    Route::put('/admin/rooms/{id}', [RoomController::class, 'adminUpdate'])->name('admin.rooms.update');
    Route::delete('/admin/rooms/{id}', [RoomController::class, 'adminDestroy'])->name('admin.rooms.destroy');
    
    Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::put('/admin/bookings/{id}/approve', [AdminController::class, 'approveBooking'])->name('admin.bookings.approve');
    Route::put('/admin/bookings/{id}/cancel', [AdminController::class, 'cancelBooking'])->name('admin.bookings.cancel');
    Route::delete('/admin/bookings/{id}', [AdminController::class, 'deleteBooking'])->name('admin.bookings.delete');
});
