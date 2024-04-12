<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripePaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/homepage', function (Request $request) {
//     return $request->user();
// });
// Route::get('/showuserpost', [HomeController::class, 'showuserpost']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/showuserpost', [HomeController::class, 'showuserpost']);
    Route::post('/addpost', [HomeController::class, 'addpost']);
    Route::get('/deleteuserpost/{id}', [HomeController::class, 'deleteuserpost']);
    Route::get('/edituserpost/{id}', [HomeController::class, 'edituserpost']);
    Route::post('/updateuserpost/{id}', [HomeController::class, 'updateuserpost']);
    
    Route::post('stripe', [StripePaymentController::class, 'stripe']);
});

Route::get('/homepage', [HomeController::class, 'homepage']);
Route::get('/detail_post/{id}', [HomeController::class, 'detail_post']);
Route::post('/addComment/{id}', [HomeController::class, 'addComment']);
Route::post('/postLike', [HomeController::class, 'postLike']);

// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('stripe','stripe')->name('stripe.index');
//     Route::get('stripe/checkout','stripeCheckout')->name('stripe.checkout');
//     Route::get('stripe/checkout/success','stripeCheckoutSuccess')->name('stripe.checkout.success');
// });