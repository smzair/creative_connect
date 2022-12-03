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

Route::get('/Creative-viewComs','creativeCommercials@view')->name('viewCOM');
Route::get('/Creative-viewLots','creativeLot@view')->name('viewLOT');
Route::get('/Creative-viewWrcs','creativeWrc@view')->name('viewWRC');
