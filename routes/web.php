<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestHouseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('bookings', BookingController::class)->only(['index', 'show', 'destroy']);
    Route::get('/bookings/create/{guest_house}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/{guest_house}', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('guest-houses', GuestHouseController::class);
});

Route::get('/guest-houses/{guest_house}', [GuestHouseController::class, 'show'])->name('guest-houses.show');
Route::get('/guest-houses', [GuestHouseController::class, 'index'])->name('guest-houses.index');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return view('dashboard.admin', [
            'totalBookings' => \App\Models\Booking::count(),
            'pendingBookings' => \App\Models\Booking::where('status', 'pending')->count(),
            'confirmedBookings' => \App\Models\Booking::where('status', 'confirmed')->count(),
            'totalGuestHouses' => \App\Models\GuestHouse::count(),
            'recentBookings' => \App\Models\Booking::with(['user', 'guestHouse'])->latest()->take(5)->get()
        ]);
    }
    return view('dashboard.user', [
        'myBookings' => \App\Models\Booking::with('guestHouse')->where('user_id', $user->id)->latest()->take(5)->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
