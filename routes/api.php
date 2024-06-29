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
// Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/sms', [App\Http\Controllers\SMSController::class, 'sendMessage']);

    Route::apiResource('addresses', App\Http\Controllers\Api\AddressController::class);
    Route::apiResource('agents', App\Http\Controllers\Api\AgentController::class);
    Route::apiResource('animals', App\Http\Controllers\Api\AnimalController::class);
    Route::apiResource('barangays', App\Http\Controllers\Api\BarangayController::class);
    Route::apiResource('books', App\Http\Controllers\Api\BookController::class);
    Route::apiResource('bookings', App\Http\Controllers\Api\BookingController::class);
    Route::apiResource('brands', App\Http\Controllers\Api\BrandController::class);
    Route::apiResource('contacts', App\Http\Controllers\Api\ContactController::class);
    Route::apiResource('countries', App\Http\Controllers\Api\CountryController::class);
    Route::apiResource('inventories', App\Http\Controllers\Api\InventoryController::class);
    Route::apiResource('items', App\Http\Controllers\Api\ItemController::class);
    Route::apiResource('leads', App\Http\Controllers\Api\LeadController::class);
    Route::apiResource('logins', App\Http\Controllers\Api\LoginController::class);
    Route::apiResource('logistics', App\Http\Controllers\Api\LogisticController::class);
    Route::apiResource('payments', App\Http\Controllers\Api\PaymentController::class);
    Route::apiResource('persons', App\Http\Controllers\Api\PersonController::class);
    Route::apiResource('plants', App\Http\Controllers\Api\PlantController::class);
    Route::apiResource('provinces', App\Http\Controllers\Api\ProvinceController::class);
    Route::apiResource('real_estates', App\Http\Controllers\Api\RealEstateController::class);
    Route::apiResource('sales', App\Http\Controllers\Api\SaleController::class);
    Route::apiResource('schedules', App\Http\Controllers\Api\ScheduleController::class);
    Route::apiResource('states', App\Http\Controllers\Api\StateController::class);
    Route::apiResource('statuses', App\Http\Controllers\Api\StatusController::class);
    Route::apiResource('subscriptions', App\Http\Controllers\Api\SubscriptionController::class);
    Route::apiResource('towns', App\Http\Controllers\Api\TownController::class);
});