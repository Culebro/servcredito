<?php

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

//Solicitudes
Route::post('solicitud/save', 'SolicitudesController@save');
Route::post('solicitud/getAll', 'SolicitudesController@getAll');
Route::post('solicitud/searchPersonStatus', 'SolicitudesController@searchPersonStatus');
Route::post('solicitud/updateCredit', 'SolicitudesController@updateCredit');
Route::post('solicitud/getPersona', 'SolicitudesController@getPersona');

//Aprobaciones
Route::post('aprobaciones/getAll', 'AprobacionesController@getAll');
Route::post('aprobaciones/getSolicitud', 'AprobacionesController@getSolicitud');
Route::post('aprobaciones/dropSolicitud', 'AprobacionesController@dropSolicitud');
Route::post('aprobaciones/apruebaCredito', 'AprobacionesController@apruebaCredito');
Route::post('aprobaciones/dropCredito', 'AprobacionesController@dropSolicitud');
Route::post('aprobaciones/tablaAmortizacion', 'AprobacionesController@tablaAmortizacion');
Route::post('aprobaciones/uploadDocument', 'AprobacionesController@uploadDocument');
Route::post('aprobaciones/getDocuments', 'AprobacionesController@getDocuments');
Route::post('aprobaciones/dropDocument', 'AprobacionesController@dropDocument');

//Abonos
Route::post('abonos/getAmortizacion', 'AbonosController@getAmortizacion');
Route::post('abonos/aplicaPago', 'AbonosController@aplicaPago');
Route::post('abonos/aplicaCondonacion', 'AbonosController@aplicaCondonacion');
Route::post('abonos/aplicaLiquidacion', 'AbonosController@aplicaLiquidacion');

//Parametros
Route::post('parametros/get', 'ParametrosController@getParametros');
Route::post('parametros/save', 'ParametrosController@saveParametros');
Route::post('parametros/slider', 'ParametrosController@slider');

//Herramientas
Route::post('tools/upload', 'ToolsController@upload');
Route::post('tools/getClientes', 'ToolsController@getClientes');
Route::post('tools/getParametros', 'ToolsController@getParametros');

//Catclientes
Route::post('catclientes/saveCliente', 'ClientesController@saveCliente');
Route::post('catclientes/getCliente', 'ClientesController@getCliente');
Route::post('catclientes/getClientes', 'ClientesController@showClientes');

//Personal
Route::post('catpersonal/showPersonal', 'PersonalController@showPersonal');
Route::post('catpersonal/getPersonal', 'PersonalController@getPersonal');
Route::post('catpersonal/savePersonal', 'PersonalController@savePersonal');
Route::post('catpersonal/delPersonal', 'PersonalController@delPersonal');

//Productos
Route::post('catproductos/showProductos', 'ProductosController@showProductos');
Route::post('catproductos/getProducto', 'ProductosController@getProducto');
Route::post('catproductos/saveProducto', 'ProductosController@saveProducto');
Route::post('catproductos/delProducto', 'ProductosController@delProducto');

//Reportes


Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('solicitudes', 'SolicitudesController@index')->name('solicitudes')->middleware('auth');
Route::get('catclientes', 'ClientesController@index')->name('clientes')->middleware('auth');
Route::get('aprobaciones', 'AprobacionesController@index')->name('aprobaciones')->middleware('auth');
Route::get('abonos', 'AbonosController@index')->name('abonos')->middleware('auth');
Route::get('catproductos', 'ProductosController@index')->name('catproductos')->middleware('auth');
Route::get('sysparametros', 'ParametrosController@index')->name('sysparametros')->middleware('auth');
Route::get('catpersonal', 'PersonalController@index')->name('catpersonal')->middleware('auth');
Route::get('repclientes', 'ReportesController@clientes')->name('repclientes')->middleware('auth');
Route::get('repcobranza', 'ReportesController@cobranza')->name('repcobranza')->middleware('auth');
Route::get('repcreditos', 'ReportesController@creditos')->name('repcreditos')->middleware('auth');
Route::get('repcxc', 'ReportesController@cxc')->name('repcxc')->middleware('auth');
Route::get('repfinanzas', 'ReportesController@finanzas')->name('repfinanzas')->middleware('auth');
Route::get('rutas', 'RutasController@index')->name('rutas')->middleware('auth');

