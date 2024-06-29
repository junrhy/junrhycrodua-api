<?php

use App\Http\Controllers\AccountProfileController;
use App\Http\Controllers\AccountAuthController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\OrderController;
use App\Http\Controllers\Account\SaleController;
use App\Http\Controllers\Account\InventoryController;
use App\Http\Controllers\Account\HelpController;
use Illuminate\Support\Facades\Route;

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

// require __DIR__.'/auth.php';

Route::middleware('auth:account')->group(function () {
    Route::get('/account/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    
    Route::get('/account/orders', [OrderController::class, 'index'])->name('account.orders');
    
    Route::get('/account/sales', [SaleController::class, 'index'])->name('account.sales');

    Route::resource('/account/inventory', InventoryController::class);

    Route::get('/account/help', [HelpController::class, 'index'])->name('account.help');
    
    Route::get('/account/profile', [AccountProfileController::class, 'edit'])->name('account.profile.edit');
    Route::patch('/account/profile', [AccountProfileController::class, 'update'])->name('account.profile.update');
    Route::delete('/account/profile', [AccountProfileController::class, 'destroy'])->name('account.profile.destroy');
    Route::put('/account/reset-password', [AccountProfileController::class, 'updatePassword'])->name('account.password.update');
});

Route::get('/account/login', [AccountAuthController::class, 'showLoginForm'])->name('account.login');
Route::post('/account/login', [AccountAuthController::class, 'login']);
Route::post('/account/logout', [AccountAuthController::class, 'logout'])->name('account.logout');