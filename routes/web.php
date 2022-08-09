<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    // Route::resource('roles','RoleController');
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('stores', 'App\Http\Controllers\StoresController');
    Route::resource('country', 'App\Http\Controllers\CountryController');
    Route::resource('famoustype', 'App\Http\Controllers\FamousTypeController');
    Route::resource('soical', 'App\Http\Controllers\SoicalTypeController');
    Route::resource('famous', 'App\Http\Controllers\FamousController');
    Route::get('general', 'App\Http\Controllers\HomeController@general')->name('generalinfo.index');
    Route::post('general', 'App\Http\Controllers\HomeController@store')->name('generalinfo.store');
    Route::post('stores/{id}/update', 'App\Http\Controllers\StoresController@update_stores')->name('update_stores');
    Route::post('country/{id}/update', 'App\Http\Controllers\CountryController@update_country')->name('update_country');
    Route::post('get_form_stores', 'App\Http\Controllers\StoresController@get_form_stores')->name('get_form_stores');
    Route::post('get_form_country', 'App\Http\Controllers\CountryController@get_form_country')->name('get_form_country');
    Route::post('get_form_famoustype', 'App\Http\Controllers\FamousTypeController@get_form_famoustype')->name('get_form_famoustype');
    Route::post('famoustype/{id}/update', 'App\Http\Controllers\FamousTypeController@update_famoustype')->name('update_famoustype');
    Route::post('soicaltype/{id}/update', 'App\Http\Controllers\SoicalTypeController@update_soical')->name('update_soical');
    Route::post('get_form_soical', 'App\Http\Controllers\SoicalTypeController@get_form_soical')->name('get_form_soical');
    Route::get('get_country_code', 'App\Http\Controllers\FamousController@get_country_code')->name('get_country_code');
    Route::post('store_country_for_famous', 'App\Http\Controllers\CountryController@store_country_for_famous')->name('store_country_for_famous');
    Route::post('store_scope_for_famous', 'App\Http\Controllers\FamousTypeController@store_scope_for_famous')->name('store_scope_for_famous');
    Route::get('logout', 'App\Http\Controllers\UserController@logout')->name('logout');
    Route::get('wallet', 'App\Http\Controllers\UserController@wallet')->name('wallet');
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('admin-dashboard');
    // Route::resource('users','UserController');
    Route::get('home', function () {
        return view('dashboard.index');
    })->name('home');
});
Route::group(['middleware' => ['auth:famous'], 'prefix' => 'dashboard'], function () {
    // Route::resource('roles','RoleController');
    Route::get('wallet', 'App\Http\Controllers\UserController@wallet')->name('wallet');

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('famous-dashboard');   
    Route::post('send_bank_data','App\Http\Controllers\UserController@send_bank_data')->name('send_bank_data');
Route::get('edit_profile', 'App\Http\Controllers\UserController@edit_profile')->name('edit_profile');
Route::post('update_my_profile', 'App\Http\Controllers\UserController@update_my_profile')->name('update_my_profile');
Route::get('edit_bank_profile', 'App\Http\Controllers\UserController@edit_bank_profile')->name('edit_bank_profile');



});
Route::get('admin-login', 'App\Http\Controllers\UserController@admin_login')->name('admin_login');
Route::get('login', 'App\Http\Controllers\UserController@famous_login')->name('famous_login');
Route::post('admin-login', 'App\Http\Controllers\UserController@process_login')->name('process_login');
Route::post('famous_login', 'App\Http\Controllers\UserController@famous_login_post')->name('famous_login_post');
Route::post('check_otp', 'App\Http\Controllers\UserController@check_otp')->name('check_otp');



    
// Auth::routes();
