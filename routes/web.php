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
Route::get('/report/{id}','HomeController@angular');
Route::get('/query','HomeController@query');
Route::get('/.well-known/acme-challenge/jVnSQs-5qZUr97QNwqeS5YAvynIS02NkpjzvWfKL50M','HomeController@ssl');




Route::group(['prefix' => 'api'], function () {
    Route::get('pie-report/{id}', 'ServicesController@show');
    Route::get('variable-report/{id}', 'ServicesController@rentVariable');
    Route::get('/query','HomeController@query');

});
