<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', function () {    
    return redirect()->route('home');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('movies/{movie}/{date?}', [App\Http\Controllers\HomeController::class, 'showMovie'])->name('movies.show');

Route::group(['middleware' => 'auth'], function() {
    Route::get('bookings/my-bookings', [App\Http\Controllers\BookingController::class, 'getMyBookings'])->name('bookings.my-bookings');
    Route::post('bookings/cancel', [App\Http\Controllers\BookingController::class, 'cancelMyBookings'])->name('bookings.cancel');
    Route::get('bookings/book/{show}', [App\Http\Controllers\BookingController::class, 'showBookingForm'])->name('bookings.booking-form');
    Route::post('bookings/book/{show}', [App\Http\Controllers\BookingController::class, 'bookShow'])->name('bookings.book-a-show');
});
