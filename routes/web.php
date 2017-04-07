<?php

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


/*Laravel admin routes*/
Auth::routes();
Route::get('/','HomeController@index')->middleware('auth');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/query','HomeController@query');
Route::get('/not-found','HomeController@NotFound');


/* SSL Certificate confirm */
Route::get('/.well-known/acme-challenge/ffLSWapq-DGViMBAyUwBJgDbbEohI2gdqCBfoeDMCXQ','HomeController@ssl');


/*Angular front routes*/
Route::get('/report/{CodigoOyd}/{Fecha}','HomeController@angular')->middleware('auth');


/*Laravel API routes*/
Route::group(['prefix' => 'api'], function () {
    Route::get('pie-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio');
    Route::get('variable-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio_renta_variable');
    Route::get('fija-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio_renta_fija');
    Route::get('fics-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio_renta_fics');
    Route::get('opc-report/{CodigoOyd}/{Fecha}', 'ServicesController@OPC');
    Route::get('opl-report/{CodigoOyd}/{Fecha}', 'ServicesController@OPL');
    Route::get('client-report/{CodigoOyd}/{Fecha_start}/{Fecha_end}', 'ServicesController@ClientReport');
    Route::get('cache/{CodigoOyd}', 'ServicesController@CACHE');
    Route::get('/query','HomeController@query');

});
