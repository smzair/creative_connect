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
use App\Http\Controllers\ConsolidatedLotController;
use App\Http\Controllers\CreativeAllocationController;
use App\Http\Controllers\CreativeQcController;
use App\Http\Controllers\CreativeSubmissionController;
use App\Http\Controllers\creativeWrc;
use App\Http\Controllers\EditingAllocationController;
use App\Http\Controllers\EditingUploadLinkController;
use App\Http\Controllers\EditingWrcController;
use App\Http\Controllers\editorLotController;
use App\Http\Controllers\EditorsCommercialController;
use App\Http\Controllers\NewCommercial;
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

//////////////// Creative Commercial AND Catalog  Routes /////////////////
Route::get('/Creative-createComs', 'creativeCommercials@index')->name('CREATECOM');
Route::post('/Creative-createComs', 'creativeCommercials@create')->name('SAVECOMS'); // for save Commercial
Route::get('/Creative_commercialView', 'creativeCommercials@view')->name('viewCOM'); // for view Commercial
Route::get('/Creative-createComs/{id}', 'creativeCommercials@edit')->name('EDITCOMS'); // for save Commercial
Route::post('/Creative-updateComs', 'creativeCommercials@update')->name('UPDATECOMS'); // for save Commercial


Route::get('/Creative-createCatalog', 'catalogCommercials@index')->name('CREATECATALOG'); // for Commercials Create Catalog  Form
Route::post('/Creative-createCatalog', 'catalogCommercials@create')->name('SAVECATALOG'); // For save Commercials Catalog  Log
Route::get('/Creative-CatalogView', 'catalogCommercials@view')->name('viewCommercial'); // for Commercials Create Catalog  Form
Route::get('/Creative-createCatalog/{id}', 'catalogCommercials@edit')->name('EDITCATALOG'); // for Commercials Create Catalog  Form
Route::post('/Creative-updateCatalog', 'catalogCommercials@update')->name('UPDATECATALOG'); // For Update Commercials Catalog  Log



/****************  Creative-createLots  **************/
Route::get('/Creative-createLots','creativeLot@index')->name('CREATELOT');
Route::post('/Creative-createLots', 'creativeLot@store')->name('STORELOTS');
Route::get('/Creative-viewLots','creativeLot@view')->name('viewLOT');
Route::get('/Creative-editLots/{id}','creativeLot@edit');
Route::post('/Creative-updateLots','creativeLot@update')->name('UPDATELOT');

/****************  Catalog- create Lots  **************/

Route::get('/Creative-createLotCatalog', 'CatalogLotsController@index')->name('CREATELOTCATALOG');
Route::post('/Creative-createLotCatalog', 'CatalogLotsController@create')->name('SAVELOTSCATALOG'); // For save Lots Catalog  Log
Route::get('/Creative-lotsCatalogView', 'CatalogLotsController@view')->name('VIEWLOTCATALOG'); // for Listing Lots Catalog
Route::get('/Creative-createLotCatalog/{id}', 'CatalogLotsController@edit')->name('EDITLOTCATALOG'); // for Lots Catalog edit Form
Route::post('/Creative-UpdateLotCatalog', 'CatalogLotsController@update')->name('UPDATELOTSCATALOG'); // For save Lots Catalog  Log

// --rajesh routing creative and editing panel---start
/****************  Creative-createWrc  **************/
Route::get('/Creative-createWrcs','creativeWrc@index')->name('CREATEWRC');
Route::post('/Creative-createWrcs', 'creativeWrc@store')->name('STOREWRC');
Route::get('/Creative-createWrcs/{id}','creativeWrc@edit');
Route::post('/Creative-viewWrcs','creativeWrc@update')->name('UPDATEWRC');
Route::get('/Creative-viewWrcs','creativeWrc@view')->name('viewWRC');

/****************  Creative-createWrc-Batch-Panel  **************/
Route::get('/Creative-viewWrcsBatchPanel','creativeWrc@viewBatchPanel')->name('viewWRCBatchPanel');
Route::post('/Creative-viewWrcsBatchPanel','creativeWrc@storeNewBatch')->name('INVERD_NEW_BATCH');

/****************  Creative-Allocation  **************/
Route::get('/Creative-allocation-create' , [CreativeAllocationController::class , 'index'])->name('CREATIVE_ALLOCATION_CREATE');//creative allocation create
Route::get('/Creative-Reallocation-create' , [CreativeAllocationController::class , 'indexForReAllocation'])->name('CREATIVE_REALLOCATION_CREATE');//creative reallocation create
Route::get('/Creative-allocation-get' , [CreativeAllocationController::class , 'CreativeAllocationGet'])->name('CREATIVE_ALLOCATION_GET');//creative allocation get
Route::get('/Creative-allocation-get' , [CreativeAllocationController::class , 'CreativeAllocationGet'])->name('CREATIVE_ALLOCATION_GET');
Route::post('/Creative-allocation-create', 'CreativeAllocationController@store')->name('CREATIVE_ALLOCATION_STORE');// store creative allocation

/****************  Creative-Uploading (Tasking)  **************/
Route::get('/Upload-Creative' , [CreativeAllocationController::class , 'uploadCreative'])->name('UPLOAD_CREATIVE_PANEL');//creative allocation get
Route::post('/set-creative-allocation-start' , [CreativeAllocationController::class , 'setCreativeAllocationStart']);//update start time
Route::post('/Upload-Creative', 'CreativeAllocationController@storeUploaddata')->name('CREATIVE_ALLOCATION_UPLOAD_STORE');// store creative allocation upload data

/****************  Creative-Qc Panel  **************/
Route::get('/Creative-Qc', [CreativeQcController::class , 'getDataForQcList'])->name('CREATIVE_QC_GET');// creative qc get
Route::post('/get-user-for-rework','CreativeQcController@getUserListForRework');// get user list for rework in qc approval create// ajax api
Route::post('/Creative-Qc','CreativeQcController@storeUserDataForRework')->name('CREATIVE_REWORK_STORE');//creative rework store
Route::post('/check_completed_wrc','CreativeQcController@checkCompletedWrc');//check_completed_wrc
Route::post('/cw_check_completed_wrc','CreativeQcController@cwCheckCompletedWrc');//cw_check_completed_wrc
Route::post('/get-sku-list' , [CreativeAllocationController::class , 'getSkuList']);//get sku based on wrc id and batch no

/****************creative Submission **************/
Route::get('/Creative-Submission' , [CreativeSubmissionController::class , 'getCreativeSubmission'])->name('CREATIVE_SUBMISSION_GET');//get sku based on wrc id and batch no
Route::post('/Creative-Submission' , [CreativeSubmissionController::class , 'addCreativeSubmission'])->name('add_ready_for_submission');//Add Ready For Submission

/****************creative Submission done**************/
Route::get('/Creative-Submission-Done' , [CreativeSubmissionController::class , 'getDataForCreativeSubmissionDone'])->name('CREATIVE_SUBMISSION_DONE');// get wrc list for submission done
Route::post('/Creative-Submission-Done' , [CreativeSubmissionController::class , 'addCreativeSubmissionDone'])->name('add_submission_done');//Add  Submission Done


/****************creative Client-Approval-Rejection**************/
Route::get('/Creative-WRC-Client-Approval-Rejection' , [CreativeSubmissionController::class , 'creativeWrcClientApprovalRejection'])->name('CREATIVE_WRC_CLIENT_APPROVAL_REJECTION');//CREATIVE_WRC_CLIENT_APPROVAL_REJECTION
Route::post('/Creative-WRC-Client-Approval-Rejection' , [CreativeSubmissionController::class , 'creativeWrcApprove'])->name('creative_wrc_approve');// approve action for wrc
Route::post('/Creative-WRC-Client-Rejection' , [CreativeSubmissionController::class , 'creativeWrcReject'])->name('creative_wrc_reject');// reject action for wrc
Route::get('/set-creative-allocation-pause' , [CreativeAllocationController::class , 'setCreativeAllocationPause']);//cron api for update pause time when task is start
Route::get('/Creative-Wrc-Detail-Master-Sheet' , [CreativeSubmissionController::class , 'getCreativeWrcDetail'])->name('get_creative_wrc_detail');//get creative wrc detail ( master sheet)
Route::get('/Creative-wrcs-status-view' , [creativeWrc::class , 'wrcStatusView'])->name('creative_wrc_status_view');//creative wrc status view listing


/****************consolidated lot panel**************/
Route::get('/Consolidated-Lot' , [ConsolidatedLotController::class , 'view'])->name('consolidated_lot_panel');//consolidated lot panel
Route::post('/Consolidated-Lot' , [ConsolidatedLotController::class , 'create'])->name('create_consolidated_lot');//create consolidated lot
Route::get('/Consolidated-Lot/{id}' , [ConsolidatedLotController::class , 'continueTask']);//continue task on  consolidated lot
Route::get('/Consolidated-Lot-List' , [ConsolidatedLotController::class , 'list'])->name('consolidated_lot_view');//view consolidated lot
Route::post('/Consolidated-Lot-Shoot' , [ConsolidatedLotController::class , 'createConsolidatedShoot'])->name('create_consolidated_shoot');//create  consolidated shoot
Route::post('/Consolidated-Lot-Creative-Graphics' , [ConsolidatedLotController::class , 'createConsolidatedCreativeGraphics'])->name('create_consolidated_creative_graphics');// create consolidated Creative
Route::post('/Consolidated-Lot-Catlog' , [ConsolidatedLotController::class , 'createConsolidatedCatlog'])->name('create_consolidated_catlog');// create consolidated catlog
Route::post('/Consolidated-Lot-Editor' , [ConsolidatedLotController::class , 'createConsolidatedEditorLot'])->name('create_consolidated_editor_lot');// create create_consolidated_editor_lot



Route::get('/Creative-Update-Invoice-Number' , [WrcInvoiceNumber::class , 'index'])->name('update_invoice_number_panel');// Update Invoice Number Panel
Route::post('/Creative-Update-Invoice-Number' , [WrcInvoiceNumber::class , 'updateWrcInvoice'])->name('update_wrc_invoice_no');// update Wrc Invoice No

/****************Editor Panel**************/

Route::get('/Editor-Create-Lot' , [editorLotController::class , 'index'])->name('editor_create_lot');// Editor Create Lot
Route::post('/Editor-Create-Lot', [editorLotController::class , 'store'])->name('store_editor_lot');
Route::get('/Editor-Lot-View', [editorLotController::class , 'getEditorLotData'])->name('get_editor_lot_data');// editor lot listing
Route::get('/Editor-editLots/{id}',[editorLotController::class, 'edit']);// editor lot edit
Route::post('/Editor-Lot-View',[editorLotController::class, 'update'])->name('editor_update_lot');// editor lot update
// --rajesh routing creative and editing panel---end

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
Route::post('/get-lot-number', 'creativeWrc@getLotNumber');


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
Route::post('set-wrc-qc-pending', [CatlaogQcController::class, 'set_wrc_qc_pending'])->name('QCWRCPending'); // completed-qc-wrc

// Submission Route comp-submission catalog-submission-details CATA_CLIENT_AR
Route::get('catalog-ready-for-submission', [CatalogSubmissionController::class, 'index'])->name('C_READYFORSUB'); // Qc List 
Route::post('comp-submission', [CatalogSubmissionController::class, 'comp_submission'])->name('Comp-submission'); // completed-qc-wrc
Route::get('catalog-submission-done', [CatalogSubmissionController::class, 'catalog_submission_done'])->name('C_SUB_DONE'); // Qc List 
Route::post('catalog-submission-details', [CatalogSubmissionController::class, 'comp_submission_details'])->name('Submission-details'); // completed-qc-wrc

// client approval rejection Route 
Route::get('catalog-client-ar', [CatalogClientARController::class, 'index'])->name('CATA_CLIENT_AR'); // Qc List 
Route::post('client-catalog-wrc-reject', [CatalogClientARController::class, 'wrc_reject_approve_wrc'])->name('wrc_reject_approve_wrc'); // reject-wrc

// catalog - wrc - master - sheet . blade
Route::get('catalog-wrc-master-sheet', [CatalogWrcMasterSheetController::class, 'index'])->name('CatalogWrcMasterSheet');

// New Panel for WRCs Status
Route::get('catalog-wrc-status', [CatalogWrcController::class, 'CatalogWrcStatus'])->name('CatalogWrcStatus');

// NewCommercial Routing 
Route::get('/newCommercial', [NewCommercial::class, 'index'])->name('NewCommercial'); // NewCommercial Form 
Route::POST('/newCommercial', [NewCommercial::class, 'create'])->name('SaveNewCommercial'); // Save NewCommercial And genrating data
Route::get('/newCommercialList', [NewCommercial::class, 'view'])->name('ViewNewCommercial'); // Listing For NewCommercial
Route::get('/newCommercial/{id}', [NewCommercial::class, 'Edit'])->name('EditNewCommercial'); // Edit   

Route::POST('/UpdateNewCommercial', [NewCommercial::class, 'update'])->name('UpdateNewCommercial'); // Save NewCommercial And genrating data
Route::POST('/saveShootCommercial', [NewCommercial::class, 'saveShootCommercial'])->name('saveShootCommercial'); // Save SaveShootCommercial And genrating data
Route::POST('/saveCreativeCommercial', [NewCommercial::class, 'SaveCreativeCommercial'])->name('SaveCreativeCommercial'); // Save SaveCreativeCommercial And genrating data
Route::POST('/saveCatalogingCommercial', [NewCommercial::class, 'SaveCatalogingCommercial'])->name('SaveCatalogingCommercial'); // Save SaveCatalogingCommercial And genrating data
Route::POST('/saveEditorCommercial', [NewCommercial::class, 'SaveEditorCommercial'])->name('SaveEditorCommercial'); // Save SaveCatalogingCommercial And genrating data

Route::get('/catalog-Invoice', [CatalogInvoiceController::class, 'index'])->name('CatalogInvoice'); // Listing For NewCommercial
Route::POST('/save-Catalog-invoice-number', [CatalogInvoiceController::class, 'SaveCatalogInvoiceNumber'])->name('SaveCatalogInvoiceNumber'); // Save SaveCatalogingCommercial And genrating data
Route::POST('/catalog-Invoice', [CatalogInvoiceController::class, 'SaveCataLogBulkInvoice'])->name('SaveCataLogBulkInvoice'); // Save SaveCatalogingCommercial And genrating data
// SaveCataLogInvoice

// 
Route::get('/Commercial-Editor', [EditorsCommercialController::class, 'create'])->name('CommercialEditor'); // Create Commercial-Editor
Route::POST('/Commercial-Editor', [EditorsCommercialController::class, 'store'])->name('SaveCommercialEditor'); // Save Commercial-Editor
Route::get('/Commercial-Editor-List', [EditorsCommercialController::class, 'index'])->name('ViewCommercialEditor'); // View Commercial-Editor
Route::get('/Commercial-Editor/{id}', [EditorsCommercialController::class, 'edit'])->name('EditCommercialEditor'); // Create Commercial-Editor
Route::POST('/Update-Commercial-Editor', [EditorsCommercialController::class, 'update'])->name('UpdateCommercialEditor'); // Save Commercial-Editor

// Editing WRC Routeing SRS
Route::get('/Editing-Wrc-Create', [EditingWrcController::class, 'create'])->name('EditingWrcCreate'); // For create New Wrc for Editing
Route::post('/get-Editing-lot-number', [EditingWrcController::class, 'getLotNumber']);
Route::POST('/Editing-Wrc-Create', [EditingWrcController::class, 'store'])->name('SaveEditingWrcCreate'); // Save Wrc for Editing
Route::get('/Editing-Wrc-List', [EditingWrcController::class, 'index'])->name('EditingWrcView'); 
Route::get('/Editing-Wrc-Create/{id}', [EditingWrcController::class, 'edit'])->name('EditingWrcEdit'); 
Route::POST('/Update-Editing-Wrc-Create', [EditingWrcController::class, 'update'])->name('UpdateEditingWrcCreate'); // Update Wrc for Editing
// Route::post('/Catalog-Wrc-marketplace-Credentials-list', [CatalogWrcController::class, 'marketplace_Credentials_List'])->name('M-P-C-List');
// Route::post('/save-wrc-Credentials', [CatalogWrcController::class, 'save_wrc_Credentials'])->name('S-W-Credentials');

/* ---------- Editing Panel Allocation -------------*/
Route::get('Editing-allocation', [EditingAllocationController::class, 'index'])->name( 'Editing_Allocation'); // 
Route::get('Editing-Re-Allocation', [EditingAllocationController::class, 'Editing_Re_Allocation'])->name('Editing_Re_Allocation'); // 

Route::post('set-Editing-allocation', [EditingAllocationController::class, 'save']); // for save Editing allocation
Route::get('Editing-Allocation-details', [EditingAllocationController::class, 'Editing_Allocation_Details'])->name('Editing_Allocation_Details'); // 

// Editing Panel Upload/Tasking
Route::get('editing-upload', [EditingUploadLinkController::class, 'upload'])->name('Editing_Upload'); //
Route::post('Editing-upload-link', [EditingUploadLinkController::class, 'Editing_upload_link']); // for upload Editing WRC link 
Route::post('get-editing_upload_links', [EditingUploadLinkController::class, 'get_Editing_Uploaded_link']); // for get Editing uploaded link 



