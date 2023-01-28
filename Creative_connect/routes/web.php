<?php

use App\Http\Controllers\CatalogAllocationController;
use App\Http\Controllers\CatalogClientARController;
use App\Http\Controllers\CatalogInvoiceController;
use App\Http\Controllers\CatalogSubmissionController;
use App\Http\Controllers\CatalogUploadedMarketplaceCountController;
use App\Http\Controllers\CatalogWrcBatchController;
use App\Http\Controllers\CatalogWrcController;
use App\Http\Controllers\CatalogWrcMasterSheetController;
use App\Http\Controllers\CatlaogQcController;
use App\Http\Controllers\NewCommercial;
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
Route::get('/Catalog-Wrc-Create', [CatalogWrcController::class, 'index'])->name('CREATECATLOGWRC');
Route::post('/Catalog-Wrc-marketplace-Credentials-list', [CatalogWrcController::class, 'marketplace_Credentials_List'])->name('M-P-C-List');
Route::post('/save-wrc-Credentials', [CatalogWrcController::class, 'save_wrc_Credentials'])->name('S-W-Credentials');

// Route::get( '/Catalog-marketplace-list', [CatalogWrcController::class, 'catalog_marketplace_Credentials_List'])->name('MarketPlace');
Route::get('/Catalog-marketplace-list', [CatalogWrcController::class, 'MarketPlace'])->name('MarketPlace');
Route::post('/get-marketplace_c_list', [CatalogWrcController::class, 'marketplace_Credentials_details']); // marketplace_Credentials_details list based on company and brand

Route::get('/Catalog-viewWrcs', [CatalogWrcController::class, 'view'])->name('viewCatalogWRC');
Route::post('/Catalog-Wrc-Create', [CatalogWrcController::class, 'store'])->name('STORECATLOGWRC');
Route::get('/Catalog-Wrc-Create/{id}', [CatalogWrcController::class, 'edit'])->name('EDITCATLOGWRC');
Route::post('/Catlog-updateWrc', [CatalogWrcController::class, 'update'])->name('UPDATECATLOGWRC');

Route::get('/Catalog-wrc-batch', [CatalogWrcBatchController::class, 'index'])->name('CatalogWrcBatch'); // Catalog Wrc's Batch Panel 
Route::post('/Catlog-wrc-inverd-new-batch', [CatalogWrcBatchController::class, 'storeNewBatch'])->name('WRC_INVERD_NEW_BATCH');

#ajax
Route::post('/get-catlog-brand', [CatalogWrcController::class, 'getBrand']);
Route::post('/get-catlog-lot-number', [CatalogWrcController::class, 'getLotNumber']);

/********** Ajax calling /{id} ********/
Route::post('/get-brand', 'AjaxController@getBrand');

/****** Allocation Route  set-catalog-allocation  set-catalog-allocation-start *********/
Route::get('catalog-allocation', [CatalogAllocationController::class, 'index'])->name('CATALOG_ALLOCT'); // 
Route::get('catalog-re-allocation', [CatalogAllocationController::class, 'catalog_re_allocation'])->name('CATALOG_RE_ALLOCT'); // 
Route::get('catalog-allocated-details', [CatalogAllocationController::class, 'details'])->name('CATALOG_ALLOCTED_DETAILS'); // 
Route::get('catalog-upload', [CatalogAllocationController::class, 'upload'])->name('CATALOG_UPLOAD'); //

Route::post('set-catalog-allocation', [CatalogAllocationController::class, 'save']); // for save catalog allocation
Route::post('catalog-allocated-sku-count', [CatalogAllocationController::class, 'alocated_sku_count']); // for list of allocated catalog WRC sku count ajax
Route::post('set-catalog-allocation-start', [CatalogAllocationController::class, 'set_task_start']); // for start catalog allocation Wrc
Route::post('set-catalog-allocation-pause', [CatalogAllocationController::class, 'set_task_pause']); // for Pause catalog allocation Wrc

Route::post('catalog-upload-link', [CatalogAllocationController::class, 'upload_catalog_link']); // for upload catalog WRC link 
Route::post('get-catalog_upload_links', [CatalogAllocationController::class, 'get_catalog_link']); // for get-catalog_upload_links 

Route::post('get-uploaded_Marketplace_count', [CatalogUploadedMarketplaceCountController::class, 'get_uploaded_Marketplace_count']); // for get-uploaded_Marketplace_count   
Route::post('save-Marketplace-approved-Count', [CatalogUploadedMarketplaceCountController::class, 'save_Marketplace_approved_Count']); // for get-uploaded_Marketplace_count   

Route::POST('get-Sub-Marketplace-count', [CatalogUploadedMarketplaceCountController::class, 'get_sub_Marketplace_count']); // for get-uploaded_Marketplace_count   
// QC route  get-catalog-users_list qc-rework completed-qc-wrc  

Route::get('catalog-qc', [CatlaogQcController::class, 'index'])->name('QcList'); // Qc List 
Route::post('get-catalog-users_list', [CatlaogQcController::class, 'userlist'])->name('userlist'); // Qc List 
Route::post('qc-rework', [CatlaogQcController::class, 'set_qc_rework'])->name('QCREWORK'); // Qc List 
Route::post('set-wrc-qc-completed', [CatlaogQcController::class, 'completed_qc_wrc'])->name('QCCOMPWRC'); // completed-qc-wrc
Route:: post('set-wrc-qc-pending', [CatlaogQcController::class, 'set_wrc_qc_pending'])->name('QCWRCPending'); // completed-qc-wrc

// Submission Route comp-submission catalog-submission-details CATA_CLIENT_AR
Route::get('catalog-ready-for-submission', [CatalogSubmissionController::class, 'index'])->name('C_READYFORSUB'); // Qc List 
Route::post( 'comp-submission', [CatalogSubmissionController::class, 'comp_submission'])->name('Comp-submission'); // completed-qc-wrc
Route::get('catalog-submission-done', [CatalogSubmissionController::class, 'catalog_submission_done'])->name('C_SUB_DONE'); // Qc List 
Route:: post('catalog-submission-details', [CatalogSubmissionController::class, 'comp_submission_details'])->name('Submission-details'); // completed-qc-wrc

// client approval rejection Route 
Route::get('catalog-client-ar', [CatalogClientARController::class, 'index'])->name('CATA_CLIENT_AR'); // Qc List 
Route::post('client-catalog-wrc-reject', [CatalogClientARController::class, 'wrc_reject_approve_wrc'])->name('wrc_reject_approve_wrc'); // reject-wrc

// catalog - wrc - master - sheet . blade
Route::get('catalog-wrc-master-sheet', [CatalogWrcMasterSheetController::class , 'index'])->name('CatalogWrcMasterSheet');

// New Panel for WRCs Status
Route::get('catalog-wrc-status', [CatalogWrcController::class , 'CatalogWrcStatus'])->name('CatalogWrcStatus');

// NewCommercial Routing
Route::get( '/newCommercial', [NewCommercial::class, 'index'])->name('NewCommercial'); // NewCommercial Form 
Route::POST('/newCommercial', [NewCommercial::class, 'create'])->name('SaveNewCommercial'); // Save NewCommercial And genrating data
Route::get('/newCommercialList', [NewCommercial::class, 'view'])->name('ViewNewCommercial'); // Listing For NewCommercial
Route::get('/newCommercial/{id}', [NewCommercial::class, 'Edit'])->name('EditNewCommercial'); // Edit   

Route::POST('/UpdateNewCommercial', [NewCommercial::class, 'update'])->name('UpdateNewCommercial'); // Save NewCommercial And genrating data
Route::POST('/saveShootCommercial', [NewCommercial::class, 'saveShootCommercial'])->name('saveShootCommercial'); // Save SaveShootCommercial And genrating data
Route::POST('/saveCreativeCommercial', [NewCommercial::class, 'SaveCreativeCommercial'])->name('SaveCreativeCommercial'); // Save SaveCreativeCommercial And genrating data
Route::POST('/saveCatalogingCommercial', [NewCommercial::class, 'SaveCatalogingCommercial'])->name('SaveCatalogingCommercial'); // Save SaveCatalogingCommercial And genrating data

Route::get('/catalog-Invoice', [CatalogInvoiceController::class, 'index'])->name('CatalogInvoice'); // Listing For NewCommercial
Route::POST('/save-Catalog-invoice-number', [CatalogInvoiceController::class, 'SaveCatalogInvoiceNumber'])->name('SaveCatalogInvoiceNumber'); // Save SaveCatalogingCommercial And genrating data
// 

