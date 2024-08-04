<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\frontend\CoursesController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\InstractorsController;
use App\Http\Controllers\frontend\CategoriesController;
use App\Http\Controllers\frontend\StripeController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controller\Auth\AuthController;




Route::group(['prefix'=>'courses'], function() {
    Route::get('get-courses', [CoursesController::class, 'getCourses']);
    Route::get('get-course-data/{id}/{user_id?}', [CoursesController::class, 'getCourseData']);
    Route::post('search', [CoursesController::class, 'search']);
});


Route::group(['prefix'=>'instractors'], function() {
    Route::get('get-instractors', [InstractorsController::class, 'getInstractors']);
});

Route::group(['prefix'=>'categories'], function() {
    Route::get('get-categories', [CategoriesController::class, 'getCategories']);
});

Route::group(['prefix' => 'cart', 'middleware' => 'auth:sanctum'], function() {
    Route::get('get-cart-courses', [CartController::class, 'getCartCourses']);
    Route::post('add-to-cart', [CartController::class, 'addToCart']);
    Route::post('remove-to-cart', [CartController::class, 'removeToCart']);
    Route::get('get-user-cart-courses-number', [CartController::class, 'getCartProductsNumber']);

});

Route::group(['prefix'=>'stripe', 'middleware' => 'auth:sanctum'], function() {
    Route::post('checkout', [StripeController::class, 'checkout']);
    Route::post('success', [StripeController::class, 'success']);
    // Route::post('cancel', [StripeController::class, 'cancel']);
});

Route::group(['prefix'=>'profile', 'middleware' => 'auth:sanctum'], function() {
    Route::get('get-user-data', [ProfileController::class, 'getUserData']);
    Route::get('get-user-courses', [ProfileController::class, 'getUserCourses']);
});

Route::group(['prefix'=>'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});




