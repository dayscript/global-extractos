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

Route::get('/','HomeController@index');
Route::get('/report/{CodigoOyd}/{Fecha}','HomeController@angular');
Route::get('/query','HomeController@query');
Route::get('/.well-known/acme-challenge/ffLSWapq-DGViMBAyUwBJgDbbEohI2gdqCBfoeDMCXQ','HomeController@ssl');
Route::get('/not-found','HomeController@NotFound');



Route::group(['prefix' => 'api'], function () {
    Route::get('pie-report/{CodigoOyd}/{Fecha}', 'ServicesController@show');
    Route::get('variable-report/{CodigoOyd}/{Fecha}', 'ServicesController@rentVariable');
    Route::get('fija-report/{CodigoOyd}/{Fecha}', 'ServicesController@rentFija');
    Route::get('fics-report/{CodigoOyd}/{Fecha}', 'ServicesController@fics');
    Route::get('opc-report/{CodigoOyd}/{Fecha}', 'ServicesController@OPC');
    Route::get('opl-report/{CodigoOyd}/{Fecha}', 'ServicesController@OPL');
    Route::get('cache/{CodigoOyd}', 'ServicesController@CACHE');



    Route::get('/query','HomeController@query');

});
