<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::post('/rooms/book', [RoomController::class, 'bookRoom'])->name('rooms.book');
Route::post('/rooms', [RoomController::class, 'storeCheckIn'])->name('rooms.storeCheckIn');
Route::post('/rooms/check-out', [RoomController::class, 'storeCheckOut'])->name('rooms.storeCheckOut');
// routes/web.php

Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::patch('/bookings/{booking}/checkout', [BookingController::class, 'checkOut'])->name('bookings.checkout');
Route::get('rooms/{room}/check-in', 'RoomController@checkIn')->name('rooms.check-in');
