<?php

use App\Http\Controllers\AccountProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::get('/account/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:account'])->name('account.dashboard');

Route::middleware('auth:account')->group(function () {
    Route::get('/account/profile', [AccountProfileController::class, 'edit'])->name('account.profile.edit');
    Route::patch('/account/profile', [AccountProfileController::class, 'update'])->name('account.profile.update');
    Route::delete('/account/profile', [AccountProfileController::class, 'destroy'])->name('account.profile.destroy');
});

Route::get('/account/login', [AccountAuthController::class, 'showLoginForm'])->name('account.login');
Route::post('/account/login', [AccountAuthController::class, 'login']);