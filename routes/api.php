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
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// User routes
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/activeUser/{email}', 'UserController@activeUser');
Route::post('/checkEmail', 'UserController@checkEmail');
Route::post('/updateUserDate', 'UserController@updateUserDate');
Route::post('/resetPassword/{email}', 'UserController@resetPassword');
Route::get('/resendMailforResetPassword/{email}', 'UserController@resendMailForResetPassword');
Route::get('/resendConformationEmail/{email}', 'UserController@resendConfirmationEmail');
Route::get('/addtoCartCheck/{user_id}', 'UserController@addToCartCheck');
Route::get('/getBrandSetting', 'UserController@getBrandSetting');

// Category route
Route::get('/listCategory', 'CategoryController@listCategory');

// Products routes
Route::get('/listProductAttachedtoCategory/{category_id}', 'ProductController@listProductAttachedToCategory');
Route::get('/productDetails/{product_id}', 'ProductController@productDetails');
Route::get('/listFeatureProduct', 'ProductController@listFeatureProduct');
Route::get('/getProducts', 'ProductController@getProducts');

// Order routes
Route::post('/createOrder', 'OrderController@createOrder');
Route::post('/checkPromoCode', 'OrderController@checkPromoCode');
Route::get('/listDeliveryFees', 'OrderController@listDeliveryFees');
Route::get('/getOrders/{user_id}', 'OrderController@getOrders');
