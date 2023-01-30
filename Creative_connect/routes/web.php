<?php

use App\Http\Controllers\ConsolidatedLotController;
use App\Http\Controllers\CreativeAllocationController;
use App\Http\Controllers\CreativeSubmissionController;
use App\Http\Controllers\CreativeQcController;
use App\Http\Controllers\creativeWrc;
use App\Http\Controllers\editorLotController;
use App\Http\Controllers\WrcInvoiceNumber;
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
Route::post('/Creative-viewWrcs','creativeWrc@update')->name('UPDATEWRC');
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
Route::get('/Creative-Qc', [CreativeQcController::class , 'getDataForQcList'])->name('CREATIVE_QC_GET');

// get user list for rework in qc approval create// ajax api
Route::post('/get-user-for-rework','CreativeQcController@getUserListForRework');

//creative rework store
Route::post('/Creative-Qc','CreativeQcController@storeUserDataForRework')->name('CREATIVE_REWORK_STORE');

//check_completed_wrc
Route::post('/check_completed_wrc','CreativeQcController@checkCompletedWrc');

//cw_check_completed_wrc
Route::post('/cw_check_completed_wrc','CreativeQcController@cwCheckCompletedWrc');

//get sku based on wrc id and batch no
Route::post('/get-sku-list' , [CreativeAllocationController::class , 'getSkuList']);

/****************creative Submission **************/

//get sku based on wrc id and batch no
Route::get('/Creative-Submission' , [CreativeSubmissionController::class , 'getCreativeSubmission'])->name('CREATIVE_SUBMISSION_GET');

//Add Ready For Submission
Route::post('/Creative-Submission' , [CreativeSubmissionController::class , 'addCreativeSubmission'])->name('add_ready_for_submission');

// CREATIVE_SUBMISSION_DONE

// get wrc list for submission done 
Route::get('/Creative-Submission-Done' , [CreativeSubmissionController::class , 'getDataForCreativeSubmissionDone'])->name('CREATIVE_SUBMISSION_DONE');

//Add  Submission Done
Route::post('/Creative-Submission-Done' , [CreativeSubmissionController::class , 'addCreativeSubmissionDone'])->name('add_submission_done');


//CREATIVE_WRC_CLIENT_APPROVAL_REJECTION
Route::get('/Creative-WRC-Client-Approval-Rejection' , [CreativeSubmissionController::class , 'creativeWrcClientApprovalRejection'])->name('CREATIVE_WRC_CLIENT_APPROVAL_REJECTION');

// approve action for wrc
Route::post('/Creative-WRC-Client-Approval-Rejection' , [CreativeSubmissionController::class , 'creativeWrcApprove'])->name('creative_wrc_approve');

// reject action for wrc
Route::post('/Creative-WRC-Client-Rejection' , [CreativeSubmissionController::class , 'creativeWrcReject'])->name('creative_wrc_reject');

//cron api for update pause time when task is start
Route::get('/set-creative-allocation-pause' , [CreativeAllocationController::class , 'setCreativeAllocationPause']);


//get creative wrc detail ( master sheet)
Route::get('/Creative-Wrc-Detail-Master-Sheet' , [CreativeSubmissionController::class , 'getCreativeWrcDetail'])->name('get_creative_wrc_detail');

//creative wrc status view listing
Route::get('/Creative-wrcs-status-view' , [creativeWrc::class , 'wrcStatusView'])->name('creative_wrc_status_view');

//consolidated lot panel
Route::get('/Consolidated-Lot' , [ConsolidatedLotController::class , 'view'])->name('consolidated_lot_panel');

//create consolidated lot
Route::post('/Consolidated-Lot' , [ConsolidatedLotController::class , 'create'])->name('create_consolidated_lot');

//continue task on  consolidated lot
Route::get('/Consolidated-Lot/{id}' , [ConsolidatedLotController::class , 'continueTask']);


//view consolidated lot
Route::get('/Consolidated-Lot-List' , [ConsolidatedLotController::class , 'list'])->name('consolidated_lot_view');

//create  consolidated shoot
Route::post('/Consolidated-Lot-Shoot' , [ConsolidatedLotController::class , 'createConsolidatedShoot'])->name('create_consolidated_shoot');

// create consolidated Creative
Route::post('/Consolidated-Lot-Creative-Graphics' , [ConsolidatedLotController::class , 'createConsolidatedCreativeGraphics'])->name('create_consolidated_creative_graphics');

// create consolidated catlog
Route::post('/Consolidated-Lot-Catlog' , [ConsolidatedLotController::class , 'createConsolidatedCatlog'])->name('create_consolidated_catlog');

// Update Invoice Number Panel
Route::get('/Creative-Update-Invoice-Number' , [WrcInvoiceNumber::class , 'index'])->name('update_invoice_number_panel');


// update Wrc Invoice No
Route::post('/Creative-Update-Invoice-Number' , [WrcInvoiceNumber::class , 'updateWrcInvoice'])->name('update_wrc_invoice_no');

/* ----------Editor Panel-------------*/

// Editor Create Lot
Route::get('/Editor-Create-Lot' , [editorLotController::class , 'index'])->name('editor_create_lot');

Route::post('/Editor-Create-Lot', [editorLotController::class , 'store'])->name('store_editor_lot');

// editor lot listing
Route::get('/Editor-Lot-View', [editorLotController::class , 'getEditorLotData'])->name('get_editor_lot_data');
