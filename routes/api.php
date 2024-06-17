<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

// Public routes
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/sms', [App\Http\Controllers\SMSController::class, 'sendMessage']);

    Route::apiResource('addresses', App\Http\Controllers\AddressController::class);
    Route::apiResource('agents', App\Http\Controllers\AgentController::class);
    Route::apiResource('animals', App\Http\Controllers\AnimalController::class);
    Route::apiResource('barangays', App\Http\Controllers\BarangayController::class);
    Route::apiResource('books', App\Http\Controllers\BookController::class);
    Route::apiResource('bookings', App\Http\Controllers\BookingController::class);
    Route::apiResource('brands', App\Http\Controllers\BrandController::class);
    Route::apiResource('contacts', App\Http\Controllers\ContactController::class);
    Route::apiResource('countries', App\Http\Controllers\CountryController::class);
    Route::apiResource('inventories', App\Http\Controllers\InventoryController::class);
    Route::apiResource('items', App\Http\Controllers\ItemController::class);
    Route::apiResource('leads', App\Http\Controllers\LeadController::class);
    Route::apiResource('logins', App\Http\Controllers\LoginController::class);
    Route::apiResource('logistics', App\Http\Controllers\LogisticController::class);
    Route::apiResource('payments', App\Http\Controllers\PaymentController::class);
    Route::apiResource('persons', App\Http\Controllers\PersonController::class);
    Route::apiResource('plants', App\Http\Controllers\PlantController::class);
    Route::apiResource('provinces', App\Http\Controllers\ProvinceController::class);
    Route::apiResource('real_estates', App\Http\Controllers\RealEstateController::class);
    Route::apiResource('sales', App\Http\Controllers\SaleController::class);
    Route::apiResource('schedules', App\Http\Controllers\ScheduleController::class);
    Route::apiResource('states', App\Http\Controllers\StateController::class);
    Route::apiResource('statuses', App\Http\Controllers\StatusController::class);
    Route::apiResource('subscriptions', App\Http\Controllers\SubscriptionController::class);
    Route::apiResource('towns', App\Http\Controllers\TownController::class);
});