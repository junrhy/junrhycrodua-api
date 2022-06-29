<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VoucherController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('agents', AgentController::class);
    Route::apiResource('animals', AnimalController::class);
    Route::apiResource('barangays', BarangayController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('bookings', BookingController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('campaigns', CampaignController::class);
    Route::apiResource('cards', CardController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('contacts', ContactController::class);
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('couriers', CourierController::class);
    Route::apiResource('families', FamilyController::class);
    Route::apiResource('features', FeatureController::class);
    Route::apiResource('files', FileController::class);
    Route::apiResource('hobbies', HobbyController::class);
    Route::apiResource('inventories', InventoryController::class);
    Route::apiResource('items', ItemController::class);
    Route::apiResource('leads', LeadController::class);
    Route::apiResource('logins', LoginController::class);
    Route::apiResource('logistics', LogisticController::class);
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('persons', PersonController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('plants', PlantController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('promotions', PromotionController::class);
    Route::apiResource('provinces', ProvincesController::class);
    Route::apiResource('real_estates', RealEstateController::class);
    Route::apiResource('sales', SaleController::class);
    Route::apiResource('schedules', ScheduleController::class);
    Route::apiResource('states', StateController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::apiResource('taxes', TaxController::class);
    Route::apiResource('templates', TemplateController::class);
    Route::apiResource('towns', TownController::class);
    Route::apiResource('vehicles', VehicleController::class);
    Route::apiResource('vendors', VendorController::class);
    Route::apiResource('vouchers', VouchersController::class);
});