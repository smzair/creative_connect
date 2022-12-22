<?php

use App\Http\Controllers\CreativeAllocationController;
use App\Http\Controllers\CatalogAllocationController;
use App\Http\Controllers\CatlaogQcController;
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

//////////////// Creative Commercial AND Catalog  Routes /////////////////

/****************  Commercial views routing  **************/

Route::get('/Creative-createComs','creativeCommercials@index')->name('CREATECOM');
Route::post('/Creative-createComs', 'creativeCommercials@create')->name('SAVECOMS'); // for save Commercial
Route::get('/Creative_commercialView', 'creativeCommercials@view')->name('viewCOM'); // for view Commercial
Route::get('/Creative-createComs/{id}', 'creativeCommercials@edit')->name('EDITCOMS'); // for save Commercial
Route::post('/Creative-updateComs', 'creativeCommercials@update')->name('UPDATECOMS'); // for save Commercial


Route::get('/Creative-createCatalog', 'catalogCommercials@index')->name('CREATECATALOG'); // for Commercials Create Catalog  Form
Route::post('/Creative-createCatalog', 'catalogCommercials@create')->name('SAVECATALOG'); // For save Commercials Catalog  Log
Route::get('/Creative-CatalogView', 'catalogCommercials@view')->name('viewCommercial'); // for Commercials Create Catalog  Form
Route::get('/Creative-createCatalog/{id}', 'catalogCommercials@edit')->name('EDITCATALOG'); // for Commercials Create Catalog  Form
Route::post('/Creative-updateCatalog', 'catalogCommercials@update')->name('UPDATECATALOG'); // For Update Commercials Catalog  Log



//////////////// Creative Lots Routes VIEWLOTCATALOG /////////////////
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
Route::get('/Creative-viewLots','creativeLot@view')->name('viewLOT');


Route::get('/Creative-createLotCatalog', 'CatalogLotsController@index')->name('CREATELOTCATALOG');

Route::post('/Creative-createLotCatalog', 'CatalogLotsController@create')->name('SAVELOTSCATALOG'); // For save Lots Catalog  Log
Route::get('/Creative-lotsCatalogView', 'CatalogLotsController@view')->name('VIEWLOTCATALOG'); // for Listing Lots Catalog
Route::get('/Creative-createLotCatalog/{id}', 'CatalogLotsController@edit')->name('EDITLOTCATALOG'); // for Lots Catalog edit Form
Route::post('/Creative-UpdateLotCatalog', 'CatalogLotsController@update')->name('UPDATELOTSCATALOG'); // For save Lots Catalog  Log


//////////////// Creative Wrc Routes /////////////////
Route::get('/Creative-viewWrcs','creativeWrc@view')->name('viewWRC');
Route::get('/Creative-createWrcs','creativeWrc@index')->name('CREATEWRC');

// rajesh wrc route start

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
/****************catalog-wrc-create **************/
Route::get('/Catalog-Wrc-Create', 'catalogWrcController@index')->name('CREATECATLOGWRC');
Route::get('/Catalog-viewWrcs', 'catalogWrcController@view')->name('viewCatalogWRC');
Route::post('/Catalog-Wrc-Create', 'catalogWrcController@store')->name('STORECATLOGWRC');
Route::get('/Catalog-Wrc-Create/{id}', 'catalogWrcController@edit');
Route::post('/Catlog-updateWrc', 'catalogWrcController@update')->name('UPDATECATLOGWRC');
#ajax
Route::post('/get-catlog-brand', 'catalogWrcController@getBrand');
Route::post('/get-catlog-lot-number', 'catalogWrcController@getLotNumber');

//creative rework store
Route::post('/Creative-Qc','CreativeQcController@storeUserDataForRework')->name('CREATIVE_REWORK_STORE');
// rajesh wrc route end

/********** Ajax calling /{id} ********/
Route::post('/get-brand', 'AjaxController@getBrand');

/****** Allocation Route  set-catalog-allocation  set-catalog-allocation-start *********/
// Route::get('catalog-allocation' , 'CatalogAllocationController@index')->name('CATALOG_ALLOCT'); // 
Route::get('catalog-allocation', [CatalogAllocationController::class, 'index'])->name('CATALOG_ALLOCT'); // 
Route::get('catalog-allocated-details', [CatalogAllocationController::class, 'details'])->name('CATALOG_ALLOCTED_DETAILS'); // 
Route::get('catalog-upload', [CatalogAllocationController::class, 'upload'])->name('CATALOG_UPLOAD'); //

Route::post('set-catalog-allocation', [CatalogAllocationController::class, 'save']); // for save catalog allocation
Route::post('catalog-allocated-sku-count', [CatalogAllocationController::class, 'alocated_sku_count']); // for list of allocated catalog WRC sku count ajax
Route::post('set-catalog-allocation-start', [CatalogAllocationController::class, 'set_tast_start']); // for start catalog allocation Wrc
Route::post('catalog-upload-link', [CatalogAllocationController::class, 'upload_catalog_link']); // for upload catalog WRC link 
Route::post('get-catalog_upload_links', [CatalogAllocationController::class, 'get_catalog_link']); // for get-catalog_upload_links 


// QC route  get-catalog-users_list qc-rework completed-qc-wrc

Route::get('catalog-qc', [CatlaogQcController::class, 'index'])->name('QcList'); // Qc List 
Route::post('get-catalog-users_list', [CatlaogQcController::class, 'userlist'])->name('userlist'); // Qc List 
Route::post('qc-rework', [CatlaogQcController::class, 'set_qc_rework'])->name('QCREWORK'); // Qc List 
Route::post('completed-qc-wrc', [CatlaogQcController::class, 'completed_qc_wrc'])->name('QCCOMPWRC'); // completed-qc-wrc



