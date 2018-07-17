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

Route::resource('users', 'UsersController');

Route::get('/','HomeController@index')->middleware('auth');
Route::get('/home', 'HomeController@home')->name('home');

Route::get('/query','HomeController@query');
Route::get('/not-found','HomeController@NotFound');
// Route::get('/download/{id_movimientos}','HomeController@download');
// #Route::get('/download-fics/{id_movimientos}','HomeController@download_fics');
// Route::get('/download-fics/{id_movimientos}','HomeController@download_fics');
//
// Route::get('/download-fics-extrac/{id}/{fondo}/{encargo}/{fecha}','HomeController@extract_fondos_inversion');
// Route::get('/download-firma-extrac/{id}/{fecha}','HomeController@extract_firma');
// Route::get('/download-renta/2016','HomeController@extract_renta');




/* SSL Certificate confirm */
#Route::get('/.well-known/acme-challenge/ffLSWapq-DGViMBAyUwBJgDbbEohI2gdqCBfoeDMCXQ','HomeController@ssl');
/* SSL Certificate confirm */
Route::get('/ssl','HomeController@ssl');


/*Angular front routes*/
#Route::get('/report/{CodigoOyd}/{Fecha}','HomeController@angular')->middleware('auth');

Route::get('/report/{CodigoOyd}/{Fecha}','HomeController@angular');


/*Devel Routes*/
Route::get('/php/devel','DevelController@index')->name('devel.index');



/*Laravel API routes*/
Route::group(['prefix' => 'api'], function () {

    Route::get('variable-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio_renta_variable');
    Route::get('fija-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio_renta_fija');
    Route::get('fics-report/{CodigoOyd}/{Fecha}', 'ServicesController@portafolio_renta_fics');
    Route::get('fondos-de-inversion-report/{CodigoOyd}/{Fecha}', 'ServicesController@fondos_de_inversion');

    Route::get('extracto-fondos-de-inversion-report/{Fondo}/{Encargo}/{Fecha_start}/{Fecha_end}', 'ServicesController@portafolio_fondos_de_inversion');

    Route::get('opc-report/{CodigoOyd}/{Fecha}', 'ServicesController@OPC');
    Route::get('opl-report/{CodigoOyd}/{Fecha}', 'ServicesController@OPL');

    Route::get('client-report/{CodigoOyd}/{Fecha_start}/{Fecha_end}', 'ServicesController@ClientReport');

    Route::get('cache/{CodigoOyd}', 'ServicesController@CACHE');
    Route::get('/query','HomeController@query');
    Route::get('/file-exist/{CodigoOyd}','HomeController@verifyFile');
    Route::get('/file-exist-operations/{CodigoOyd}','HomeController@verifyFileOperations');
    Route::get('/certificado-tenencia/{CodigoOyd}/{Fecha}/{Dirigida}','HomeController@downloadCertificadoTenencia');

    Route::get('portafolio/{identification}/{date}', 'ServicesController@getPortafolio');
    Route::get('portafolio-renta-variable/{identification}/{date}', 'ServicesController@getPortafolioRentaVariable');
    Route::get('portafolio-renta-fija/{identification}/{date}', 'ServicesController@getPortafolioRentaFija');
    Route::get('portafolio-renta-fics/{identification}/{date}', 'ServicesController@getPortafolioRentaFics');
    Route::get('portafolio-operaciones-por-cumplir/{identification}/{date}', 'ServicesController@getOperacionesPorCumplir');
    Route::get('portafolio-operaciones-de-liquidez/{identification}/{date}', 'ServicesController@getOperacionesDeLiquidez');

    Route::get('reporte-movimientos/{identification}/{date_start}/{date_end}', 'ServicesController@getExtractoMovimientos');
    Route::get('reporte-fondos-de-inversion/{identification}', 'ServicesController@getReportFondosInversion');
    Route::get('reporte-fondos-de-inversion-por-fondo/{Fondo}/{Encargo}/{Fecha_start}/{Fecha_end}', 'ServicesController@getExtractoFondoyFideicomisoDadosMovimiento');


});

Route::group(['prefix' => 'download'], function () {
  Route::get('/reporte-movimientos/{identification}/{date_start}/{date_end}','ServicesController@downloadExtractoMovimientos');
  Route::get('/reporte-movimientos-fics/{Fondo}/{Encargo}/{Fecha_start}/{Fecha_end}','ServicesController@downloadExtractoMovimientosFics');
  Route::get('/reporte-firma-comisionista/{identification}/{date}','ServicesController@getExtractFirmaComisionista');
  Route::get('/reporte-fondos-de-inversion/{identification}/{fondo}/{encargo}/{fecha}','ServicesController@getExtractFondosInversion');


  #Route::get('/download-fics/{id_movimientos}','HomeController@download_fics');
  #Route::get('/download-fics/{id_movimientos}','HomeController@download_fics');

  Route::get('/download-fics-extrac/{id}/{fondo}/{encargo}/{fecha}','HomeController@extract_fondos_inversion');
  Route::get('/download-firma-extrac/{id}/{fecha}','HomeController@extract_firma');
  Route::get('/download-renta/2016','HomeController@extract_renta');
});



// api/variable-report/3002008/2018-04-15
// personal.service.ts:52 api/fija-report/3002008/2018-04-15
// personal.service.ts:72 api/opl-report/3002008/2018-04-15
// personal.service.ts:65 api/opc-report/3002008/2018-04-15
