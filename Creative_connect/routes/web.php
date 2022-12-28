<?php

use App\Http\Controllers\CreativeAllocationController;
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
Route::post('/Creative-viewWrcsBatchPanel','creativeWrc@storeNewBatch')->name('INVERD_NEW_BATCH');
Route::get('/Creative-createWrcs/{id}','creativeWrc@edit');
Route::post('/Creative-updateWrc','creativeWrc@update')->name('UPDATEWRC');
Route::get('/Creative-viewWrcs','creativeWrc@view')->name('viewWRC');

/****************  Creative-createWrc-Batch-Panel  **************/
Route::get('/Creative-viewWrcsBatchPanel','creativeWrc@viewBatchPanel')->name('viewWRCBatchPanel');

/****************catalog-wrc-create **************/
Route::get('/Catalog-Wrc-Create','catalogWrcController@index')->name('CREATECATLOGWRC');
Route::get('/Catalog-viewWrcs','catalogWrcController@view')->name('viewCatalogWRC');
Route::post('/Catalog-Wrc-Create', 'catalogWrcController@store')->name('STORECATLOGWRC');
Route::get('/Catalog-Wrc-Create/{id}','catalogWrcController@edit');
Route::post('/Catlog-updateWrc','catalogWrcController@update')->name('UPDATECATLOGWRC');
#ajax
Route::post('/get-catlog-brand', 'catalogWrcController@getBrand');
Route::post('/get-catlog-lot-number', 'catalogWrcController@getLotNumber');

/****************  Creative-Allocation  **************/
//creative allocation create
Route::get('/Creative-allocation-create' , [CreativeAllocationController::class , 'index'])->name('CREATIVE_ALLOCATION_CREATE');
//creative reallocation create
Route::get('/Creative-Reallocation-create' , [CreativeAllocationController::class , 'indexForReAllocation'])->name('CREATIVE_REALLOCATION_CREATE');
//creative allocation get
Route::get('/Creative-allocation-get' , [CreativeAllocationController::class , 'CreativeAllocationGet'])->name('CREATIVE_ALLOCATION_GET');
// store creative allocation
Route::post('/Creative-allocation-create', 'CreativeAllocationController@store')->name('CREATIVE_ALLOCATION_STORE');

//creative allocation get
Route::get('/Upload-Creative' , [CreativeAllocationController::class , 'uploadCreative'])->name('UPLOAD_CREATIVE_PANEL');

//update start time
Route::post('/set-creative-allocation-start' , [CreativeAllocationController::class , 'setCreativeAllocationStart']);

// store creative allocation upload data
Route::post('/Upload-Creative', 'CreativeAllocationController@storeUploaddata')->name('CREATIVE_ALLOCATION_UPLOAD_STORE');

// creative qc get
Route::get('/Creative-Qc', 'CreativeQcController@getDataForQcList')->name('CREATIVE_QC_GET');

// get user list for rework in qc approval create// ajax api
Route::post('/get-user-for-rework','CreativeQcController@getUserListForRework');

//creative rework store
Route::post('/Creative-Qc','CreativeQcController@storeUserDataForRework')->name('CREATIVE_REWORK_STORE');

//check_completed_wrc
Route::post('/check_completed_wrc','CreativeQcController@checkCompletedWrc');



