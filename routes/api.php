<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/categories', '\App\Http\Controllers\GetAllCategoriesController');
Route::get('/products', '\App\Http\Controllers\ProductController@index');
Route::get('/products/{product}', '\App\Http\Controllers\ProductController@get');
Route::post('/products', '\App\Http\Controllers\ProductController@store');
Route::post('/variants', '\App\Http\Controllers\CreateVariantController');

Route::group(['middleware' => ['auth:api', 'can:admin']], function() {

});

