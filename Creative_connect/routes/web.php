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
Route::get('/Creative-createComs','creativeCommercials@index')->name('CREATECOM');
Route::get('/Creative-createLots','creativeLot@index')->name('CREATELOT');
Route::get('/Creative-createWrcs','creativeWrc@index')->name('CREATEWRC');

Route::get('/Creative_commercialView', 'creativeCommercials@view')->name('viewCOM');
Route::get('/Creative-viewLots','creativeLot@view')->name('viewLOT');
Route::get('/Creative-viewWrcs','creativeWrc@view')->name('viewWRC');


/****************  Commercial views routing   **************/
Route::post('/Creative-createComs', 'creativeCommercials@create')->name('SAVECOMS'); // for save Commercial

Route::get('/Creative-createCatalog', 'catalogCommercials@index')->name('CREATECATALOG'); // for Commercials Create Catalog  Form

Route::post('/Creative-createCatalog','catalogCommercials@create')->name('SAVECATALOG'); // For save Commercials Catalog  Log

Route::get('/Creative-CatalogView', 'catalogCommercials@view')->name('viewCommercial'); // for Commercials Create Catalog  Form



/********** Ajax calling ********/
Route::post('/get-brand', 'AjaxController@getBrand');
