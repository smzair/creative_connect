<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatalogWrcMasterSheet extends Model
{
    use HasFactory;
    public static function CatalogWrcMasterList(){

        $CatalogWrcMasterList = CatlogWrc::leftJoin('catalog_wrc_batches', 'catalog_wrc_batches.wrc_id', 'catlog_wrc.id')->
        leftJoin(
            'catalog_allocation',
            function ($join) {
                $join->on('catalog_allocation.wrc_id', '=', 'catalog_wrc_batches.wrc_id');
                $join->on('catalog_allocation.batch_no', '=', 'catalog_wrc_batches.batch_no');
            }
        )->
        leftJoin(
            'catalog_submissions',
            function ($join) {
                $join->on('catalog_submissions.wrc_id', '=', 'catalog_wrc_batches.wrc_id');
                $join->on('catalog_submissions.batch_no', '=', 'catalog_wrc_batches.batch_no');
            }
        )->
        leftJoin('catalog_time_hash', 'catalog_time_hash.allocation_id', 'catalog_allocation.id')->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        leftJoin('create_commercial_catalog as cc_catalog', 'cc_catalog.id', 'catlog_wrc.commercial_id')->
        leftJoin('users', 'lots_catalog.user_id', 'users.id')->
        leftJoin('brands', 'brands.id', '=', 'lots_catalog.brand_id')->
        leftJoin('users as u1', 'catalog_allocation.user_id', 'u1.id')->
        select(
            'catlog_wrc.id as wrc_id',
            'catlog_wrc.wrc_number',
            'catlog_wrc.sku_qty as tot_sku_qty',
            'catlog_wrc.alloacte_to_copy_writer',
            'catlog_wrc.commercial_id',
            'catlog_wrc.modeOfDelivary',
            'catlog_wrc.status',
            'catlog_wrc.img_recevied_date',
            'catlog_wrc.missing_info_notify_date',
            'catlog_wrc.missing_info_recived_date',
            'catlog_wrc.confirmation_date',
            'catlog_wrc.work_brief',
            'catlog_wrc.guidelines',
            'catlog_wrc.created_at as wrc_created_at',
            'catlog_wrc.lot_id',
            'catalog_time_hash.allocation_id',
            'catalog_time_hash.task_status',
            'catalog_time_hash.rework_count',
            DB::raw('GROUP_CONCAT(catalog_time_hash.allocation_id) as allocation_id_list'),
            DB::raw('GROUP_CONCAT(catalog_time_hash.rework_count) as rework_count_list'),
            'catalog_time_hash.spent_time',
            'catalog_time_hash.ini_start_time',
            'catalog_time_hash.ini_end_time',
            'lots_catalog.lot_number',
            'lots_catalog.serviceType',
            'lots_catalog.requestType',
            'lots_catalog.reqReceviedDate',
            'lots_catalog.imgReceviedDate as rawimgReceviedDate',
            'catalog_submissions.id as submission_id',
            'catalog_submissions.submission_date',
            'catalog_submissions.ar_status',
            'catalog_submissions.rejection_reason',
            'catalog_submissions.action_date',
            'users.Company',
            'users.am_email',
            'brands.name as brand_name',
            'cc_catalog.market_place',
            'cc_catalog.type_of_service as kind_of_service',
            DB::raw('SUM(CASE WHEN user_role = 0 THEN allocated_qty else 0 END)  as cataloger_sum'),
            DB::raw('SUM(CASE WHEN user_role = 1 THEN allocated_qty else 0 END)  as cp_sum'),
            DB::raw('GROUP_CONCAT(u1.name) as ass_users'),
            DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as ass_cataloger'),
            'catalog_wrc_batches.batch_no',
            'catalog_wrc_batches.work_initiate_date',
            'catalog_wrc_batches.work_committed_date',
            'catalog_wrc_batches.id as wrc_batch_id',
            'catalog_wrc_batches.sku_count as sku_qty',
        )
        ->selectRaw('(SELECT batch from catalog_wrc_skus WHERE catalog_wrc_skus.batch_no = catalog_wrc_batches.batch_no AND catalog_wrc_batches.wrc_id = catalog_wrc_skus.wrc_id limit 1) as "batch"')
        ->groupBy('catalog_wrc_batches.wrc_id')
        ->groupBy('catalog_wrc_batches.batch_no')
        ->get()->toArray();
        return $CatalogWrcMasterList;
    }

    public static function wrc_skus_CountList(){
        $wrc_skus_CountList = CatalogWrcSku::
            select(
                'wrc_id',
                'batch_no',
                DB::raw('GROUP_CONCAT(catalog_wrc_skus.type_of_service) as type_of_service'),
                DB::raw('GROUP_CONCAT(catalog_wrc_skus.sku_code) as wrc_sku_sku_codes'),
                DB::raw('GROUP_CONCAT(catalog_wrc_skus.style) as wrc_sku_styles'),
                DB::raw('GROUP_CONCAT(catalog_wrc_skus.id) as wrc_sku_ids'),
                DB::raw("SUM(CASE WHEN catalog_wrc_skus.style = 'parent' THEN 1 else 0 END)  as style_count"),
            )
            ->groupBy('catalog_wrc_skus.wrc_id')
            ->groupBy('catalog_wrc_skus.batch_no')
            ->get()->toArray();
        return $wrc_skus_CountList;
    }
}
