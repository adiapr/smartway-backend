<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\CheckoutDocumentationController;
use App\Http\Controllers\Api\DocumentationServiceController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MenuWisataController;
use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\Api\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::options('/{any}', function() {
    return response()->json([], 200);
})->where('any', '.*');

// paket wisata 
Route::get('/menu-wisata-domestik', [MenuWisataController::class, 'domestik']);
Route::get('/menu-wisata-internasional', [MenuWisataController::class, 'internasional']);

// tours 
Route::get('/menu-wisata', [MenuWisataController::class, 'all']);
Route::get('/menu-wisata/{slug}', [MenuWisataController::class, 'show']);

// Car 
Route::get('/rent-car', [CarController::class, 'index']);
Route::get('/rent-car/{slug}', [CarController::class, 'show']);

// Login 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ambil data lokasi 
Route::get('/location', [LocationController::class, 'index']);

// Article 
Route::get('/article', [ArticleController::class, 'index']);
Route::get('/article/{slug}', [ArticleController::class, 'show']);

// Content
Route::get('/slider', [SliderController::class, 'index']);
Route::get('/testimony', [SliderController::class, 'testimony']);

// Cart 
Route::get('/cart/{uuid}', [CheckoutController::class, 'cart']);

// create order 
Route::post('/transaction', [MidtransController::class, 'create']);

// midtrans 
Route::post('/order/midtrans', [MidtransController::class, 'callback']);

// Route::middleware(['cors'])->group(function () {
//     Route::post('/create-transaction', [MidtransController::class, 'createOrder']);
// });

// FAQ 
Route::get('/faq-doc', [FaqController::class, 'api']);

// Layanan dokumentasi 
Route::get('/layanan-dokumentasi', [DocumentationServiceController::class, 'index']);
Route::get('/layanan-dokumentasi/{slug}', [DocumentationServiceController::class, 'show']);
Route::get('/harga-dokumentasi/{id}', [DocumentationServiceController::class, 'price']);

// checkout documentation 
Route::post('/checkout-documentation', [CheckoutDocumentationController::class, 'store']);
Route::get('/order-documentation', [CheckoutDocumentationController::class, 'index']);
Route::post('/order-documentation-checkout', [CheckoutDocumentationController::class, 'checkout']);