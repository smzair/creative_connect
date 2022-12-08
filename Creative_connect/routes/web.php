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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//////////////// Creative Routes /////////////////

/****************  Commercial views routing  **************/
Route::get('/Creative-createComs','creativeCommercials@index')->name('CREATECOM');
Route::post('/Creative-saveCom', 'creativeCommercials@create')->name( 'SAVECOMS');
Route::get('/Creative-viewComs','creativeCommercials@view')->name('viewCOM');



/********** Ajax calling ********/
Route::post('/get-brand', 'creativeLot@getBrand');
Route::post('/get-lot-number', 'creativeWrc@getLotNumber');


/****************  Creative-createLots  **************/
Route::get('/Creative-createLots','creativeLot@index')->name('CREATELOT');
Route::post('/Creative-createLots', 'creativeLot@store')->name('STORELOTS');
Route::get('/Creative-viewLots','creativeLot@view')->name('viewLOT');
Route::get('/Creative-editLots/{id}','creativeLot@edit');
Route::post('/Creative-updateLots','creativeLot@update')->name('UPDATELOT');

/****************  Creative-createWrc  **************/
Route::get('/Creative-createWrcs','creativeWrc@index')->name('CREATEWRC');
Route::post('/Creative-createWrcs', 'creativeWrc@store')->name('STOREWRC');
Route::get('/Creative-createWrcs/{id}','creativeWrc@edit');
Route::post('/Creative-updateWrc','creativeWrc@update')->name('UPDATEWRC');
Route::get('/Creative-viewWrcs','creativeWrc@view')->name('viewWRC');


/****************catalog-wrc-create **************/
Route::get('/Catalog-Wrc-Create','catalogWrcController@index')->name('CREATECATLOGWRC');
Route::get('/Catalog-viewWrcs','catalogWrcController@view')->name('viewCatalogWRC');
Route::post('/Catalog-Wrc-Create', 'catalogWrcController@store')->name('STORECATLOGWRC');
Route::get('/Catalog-Wrc-Create/{id}','catalogWrcController@edit');
Route::post('/Catlog-updateWrc','catalogWrcController@update')->name('UPDATECATLOGWRC');
#ajax
Route::post('/get-catlog-brand', 'catalogWrcController@getBrand');
Route::post('/get-catlog-lot-number', 'catalogWrcController@getLotNumber');
