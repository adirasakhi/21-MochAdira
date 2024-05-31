<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;





Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::match(['get', 'post'], '/cars', [CarController::class, 'index'])->name('cars.index');
Route::middleware('auth')->group(function () {
Route::get('/cars/{slug}', [CarController::class, 'show'])->name('cars.show');
Route::post('/apply-rent', [RentalController::class, 'store'])->name('apply-rent');
Route::resource('rentals', RentalController::class);
Route::get('/profile', [UserController::class, 'profile'])->name('profile.show');
Route::get('/profile/edit', [UserController::class, 'edit_profile'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'update_profile'])->name('profile.update');

});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin dashboard placeholder route
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('cars', AdminCarController::class);
    Route::resource('rentals', AdminRentalController::class);
    Route::patch('rentals/{rental}/approve-paid', [AdminRentalController::class, 'approvePaid'])->name('rentals.approvePaid');
    Route::patch('rentals/{rental}/approve-success', [AdminRentalController::class, 'approveSuccess'])->name('rentals.approveSuccess');
});

// 404 Not Found placeholder route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

