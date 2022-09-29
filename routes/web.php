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


Route::group(['middleware' => ['role:Admin'], 'prefix' => 'dashboard'], function () {
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('famous', 'App\Http\Controllers\FamousController');
    Route::get('general', 'App\Http\Controllers\HomeController@general')->name('generalinfo.index');
    Route::post('general', 'App\Http\Controllers\HomeController@store')->name('generalinfo.store');
    Route::get('changes', 'App\Http\Controllers\UserController@changes')->name('changes.index');
    Route::put('changes/{id}', 'App\Http\Controllers\UserController@update_changes')->name('changes.update');
    Route::get('changes/{id}/edit', 'App\Http\Controllers\UserController@edit_changes')->name('changes.edit');
    Route::get('my_order_admin', 'App\Http\Controllers\UserController@my_order_admin')->name('my_order_admin');
    Route::get('show_order_money/{id}', 'App\Http\Controllers\UserController@show_order_money')->name('show_order_money');
    Route::post('status_ok_order', 'App\Http\Controllers\UserController@status_ok_order')->name('status_ok_order');
    Route::resource('copouns', 'App\Http\Controllers\CouponController');
    Route::get('update_copoun_status', 'App\Http\Controllers\CouponController@updateStatus')->name('copoun.update.status');
    Route::post('get_form_copoun', 'App\Http\Controllers\CouponController@get_form_copoun')->name('get_form_copoun');
    Route::post('get_form_total', 'App\Http\Controllers\CodeController@get_form_total')->name('get_form_total');
    Route::post('store_total','App\Http\Controllers\CodeController@store_total')->name('store_total');
    Route::post('get_form_income', 'App\Http\Controllers\CodeController@get_form_income')->name('get_form_income');
    Route::post('store_income','App\Http\Controllers\CodeController@store_income')->name('store_income');
    Route::post('copoun/{id}/update', 'App\Http\Controllers\CouponController@update_copoun')->name('update_copoun');
    Route::get('history_for_total','App\Http\Controllers\CodeController@history_for_total')->name('history_for_total');
    Route::get('history_for_income','App\Http\Controllers\CodeController@history_for_income')->name('history_for_income');


    


    
});
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    // Route::resource('roles','RoleController');
    Route::get('wallet', 'App\Http\Controllers\UserController@wallet')->name('wallet');
   
    Route::get('/', function () {
        return view('dashboard.part_new.index');
    })->name('famous-dashboard');
    Route::resource('stores', 'App\Http\Controllers\StoresController');
    Route::resource('country', 'App\Http\Controllers\CountryController');
    Route::resource('famoustype', 'App\Http\Controllers\FamousTypeController');
    Route::resource('soical', 'App\Http\Controllers\SoicalTypeController');
    Route::resource('codes', 'App\Http\Controllers\CodeController');

    Route::post('stores/{id}/update', 'App\Http\Controllers\StoresController@update_stores')->name('update_stores');
    Route::post('country/{id}/update', 'App\Http\Controllers\CountryController@update_country')->name('update_country');
    Route::post('code/{id}/update', 'App\Http\Controllers\CodeController@update_code')->name('update_code');

    Route::post('get_form_stores', 'App\Http\Controllers\StoresController@get_form_stores')->name('get_form_stores');
    Route::post('get_form_country', 'App\Http\Controllers\CountryController@get_form_country')->name('get_form_country');
    Route::post('get_form_code', 'App\Http\Controllers\CodeController@get_form_code')->name('get_form_code');
    Route::get('get_waalet_transfare','App\Http\Controllers\CodeController@wallet_transfare')->name('get_waalet_transfare');
    

    
    Route::post('get_form_famoustype', 'App\Http\Controllers\FamousTypeController@get_form_famoustype')->name('get_form_famoustype');
    Route::post('famoustype/{id}/update', 'App\Http\Controllers\FamousTypeController@update_famoustype')->name('update_famoustype');
    Route::post('soicaltype/{id}/update', 'App\Http\Controllers\SoicalTypeController@update_soical')->name('update_soical');
    Route::post('get_form_soical', 'App\Http\Controllers\SoicalTypeController@get_form_soical')->name('get_form_soical');
    Route::get('get_country_code', 'App\Http\Controllers\FamousController@get_country_code')->name('get_country_code');
    Route::post('store_country_for_famous', 'App\Http\Controllers\CountryController@store_country_for_famous')->name('store_country_for_famous');
    Route::post('store_socail_for_famous', 'App\Http\Controllers\SoicalTypeController@store_socail_for_famous')->name('store_socail_for_famous');

    Route::post('store_scope_for_famous', 'App\Http\Controllers\FamousTypeController@store_scope_for_famous')->name('store_scope_for_famous');
    Route::get('logout', 'App\Http\Controllers\UserController@logout')->name('logout');
   
    Route::post('update_back_info_by_admin', 'App\Http\Controllers\UserController@update_back_info_by_admin')->name('update_back_info_by_admin');
    Route::post('send_bank_data', 'App\Http\Controllers\UserController@send_bank_data')->name('send_bank_data');
    Route::get('edit_profile', 'App\Http\Controllers\UserController@edit_profile')->name('edit_profile');
    Route::post('update_my_profile', 'App\Http\Controllers\UserController@update_my_profile')->name('update_my_profile');
    Route::get('edit_bank_profile', 'App\Http\Controllers\UserController@edit_bank_profile')->name('edit_bank_profile');
    Route::post('update_back_info', 'App\Http\Controllers\UserController@update_back_info')->name('update_back_info');
    Route::get('my_order_money', 'App\Http\Controllers\UserController@my_order_money')->name('my_order_money');
    Route::get('get_soucal_info', 'App\Http\Controllers\UserController@get_soucal_info')->name('get_soucal_info');
    Route::get('check_code','App\Http\Controllers\CodeController@check_code')->name('check_code');
    Route::post('get_wallet_order','App\Http\Controllers\CodeController@get_wallet_order')->name('get_wallet_order');
    
    Route::get('show_notification/{id}','App\Http\Controllers\HomeController@notification')->name('show.notification');
    Route::get('read_all_notofication','App\Http\Controllers\HomeController@read_all_notofication')->name('read_all_notofication');


    // Route::resource('users','UserController');
    Route::get('home', function () {
        return view('dashboard.index');
    })->name('home');





    Route::get('edit_profile', 'App\Http\Controllers\UserController@edit_profile')->name('edit_profile');
    Route::get('order_for_edit_bankinfo', 'App\Http\Controllers\UserController@my_order_edit')->name('my_order_edit');

    Route::post('update_my_profile', 'App\Http\Controllers\UserController@update_my_profile')->name('update_my_profile');
    Route::get('edit_bank_profile', 'App\Http\Controllers\UserController@edit_bank_profile')->name('edit_bank_profile');
    Route::post('update_back_info', 'App\Http\Controllers\UserController@update_back_info')->name('update_back_info');
    

    Route::get('wallet', 'App\Http\Controllers\UserController@wallet')->name('wallet');
});
Route::get('admin-login', 'App\Http\Controllers\UserController@admin_login')->name('admin_login');
Route::get('login', 'App\Http\Controllers\UserController@famous_login')->name('famous_login');
Route::post('admin-login', 'App\Http\Controllers\UserController@process_login')->name('process_login');
Route::post('famous_login', 'App\Http\Controllers\UserController@famous_login_post')->name('famous_login_post');
Route::post('check_otp', 'App\Http\Controllers\UserController@check_otp')->name('check_otp');



    
// Auth::routes();
