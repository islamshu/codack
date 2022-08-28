<?php

use App\Http\Controllers\Api\HomeController;
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
// Route::group(['namespace' => 'Api'], function () {
    Route::get('/chack_code', [HomeController::class, 'check']);
    Route::get('/use_code', [HomeController::class, 'use_code']);
    Route::get('get_all_copoun',[HomeController::class, 'get_all']);
    

    // });
