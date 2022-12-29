<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatalogClientApprovalRejection extends Model
{
    use HasFactory;
    // catalog Wrc list for Submission
    public static function catalog_client_cr_list()
    {

        // SELECT catalog_submissions.wrc_id , catalog_submissions.submission_date 
        // , catlog_wrc.wrc_number , catlog_wrc.alloacte_to_copy_writer , catlog_wrc.ar_status , catlog_wrc.sku_qty , catlog_wrc.lot_id 
        // , lots_catalog.id , lots_catalog.lot_number , lots_catalog.user_id , lots_catalog.brand_id , lots_catalog.serviceType , lots_catalog.requestType
        // , users.Company  , users.c_short , brands.name , brands.short_name
        

        $catalog_client_cr_list = CatalogSubmission::
            leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_submissions.wrc_id')->
            leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
            leftJoin('users', 'users.id', 'lots_catalog.user_id')->
            leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')->
        select(
            'catalog_submissions.id as submission_id',
            'catalog_submissions.wrc_id',
            'catalog_submissions.submission_date',
            'catlog_wrc.wrc_number',
            'catlog_wrc.commercial_id',
            'catlog_wrc.alloacte_to_copy_writer',
            'catlog_wrc.sku_qty',
            'catlog_wrc.work_brief',
            'catlog_wrc.ar_status',
            'lots_catalog.brand_id',
            'lots_catalog.lot_number',
            'lots_catalog.serviceType as kind_of_work',
            'lots_catalog.requestType',
            'users.Company as company',
            'users.c_short',
            'brands.name as brands_name',
            'brands.short_name',
        )->
        get()->toArray();



        // $catalog_Wrc_list_for_Submission = CatalogAllocation::
        // select(
        //     'catalog_allocation.wrc_id',
        //     'catalog_allocation.allocated_qty',
        //     DB::raw('GROUP_CONCAT(catalog_allocation.wrc_id) as wrc_ids'),
        //     DB::raw('GROUP_CONCAT(catalog_allocation.user_role) as user_roles'),
        //     DB::raw('COUNT(catalog_allocation.wrc_id) as wrc_cnt'),
        //     DB::raw('COUNT(catalog_allocation.user_role) as cnt_user_role'),
        //     DB::raw('sum(catalog_allocation.allocated_qty) as tot_sku_qty'),
        //     DB::raw('SUM(CASE  	WHEN catalog_allocation.user_role = 0 THEN catalog_allocation.allocated_qty else 0 END)  as cataloger_allocated_qty'),
        //     DB::raw('SUM(CASE WHEN catalog_allocation.user_role = 1 THEN catalog_allocation.allocated_qty else 0 END)  as cp_allocated_qty'),
        //     'catalog_time_hash.task_status',
        //     'catalog_time_hash.spent_time',
        //     'catalog_time_hash.rework_count',
        //     DB::raw('GROUP_CONCAT(catalog_time_hash.spent_time) as tot_spent_time'),
        //     DB::raw('GROUP_CONCAT(catalog_time_hash.ini_rejection_reason) as ini_start_times'),
        //     DB::raw('GROUP_CONCAT(catalog_time_hash.ini_end_time) as ini_end_times'),
        //     DB::raw('GROUP_CONCAT(catalog_upload_links.catalog_link) as catalog_links'),
        //     DB::raw('GROUP_CONCAT(catalog_upload_links.copy_link) as copy_links'),
        //     'catlog_wrc.lot_id',
        //     'catlog_wrc.wrc_number',
        //     'catlog_wrc.commercial_id',
        //     'catlog_wrc.alloacte_to_copy_writer',
        //     'catlog_wrc.sku_qty',
        //     'catlog_wrc.work_brief',
        //     'lots_catalog.brand_id',
        //     'lots_catalog.lot_number',
        //     'lots_catalog.serviceType as kind_of_work',
        //     'users.Company as company',
        //     'users.c_short',
        //     DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as allocated_users_id'),
        //     DB::raw('GROUP_CONCAT(catalog_allocation.id) as catalog_allocation_ids'),
        //     DB::raw('GROUP_CONCAT(allocated_users.id) as allo_users_id'),
        //     DB::raw('GROUP_CONCAT(allocated_users.name) as allocated_users_name'),
        //     'brands.name as brands_name',
        //     'brands.short_name',
        // )->
        // leftJoin('catalog_time_hash', 'catalog_time_hash.allocation_id', 'catalog_allocation.id')->
        // leftJoin('catalog_upload_links', 'catalog_upload_links.allocation_id', 'catalog_allocation.id')->
        // leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        // leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        // leftJoin('users', 'users.id', 'lots_catalog.user_id')->
        // leftJoin('users as allocated_users', 'allocated_users.id', 'catalog_allocation.user_id')->
        // leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')->
        // WHERE('catalog_time_hash.task_status', '=', $tsak_status_is)->
        // groupBy(['catalog_allocation.wrc_id'])->get()->toArray();
        return $catalog_client_cr_list;
    }

    public static function wrc_reject_approve_wrc($wrc_id, $ar_status, $rejection_reason){


        $rejection_reason = $rejection_reason == NULL ? '' : $rejection_reason;

        $storeData = CatlogWrc::find($wrc_id);
        $storeData->ar_status = $ar_status;
        $storeData->rejection_reason = $rejection_reason;
        $update_status = $storeData->update();

        $response = array(
            'wrc_id' => $wrc_id,
            'ar_status' => $ar_status,
            'update_status' => $update_status,
            'rejection_reason' => $rejection_reason,
        );

        return json_encode($response);

    }
}
