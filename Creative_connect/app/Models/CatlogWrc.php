<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatlogWrc extends Model
{
    use HasFactory;
    protected $table = 'catlog_wrc';
    protected $fillable = [
        'lot_id', 'wrc_number', 'commercial_id', 'status', 'ar_status' , 'rejection_reason', 'img_recevied_date', 'missing_info_notify_date', 'missing_info_recived_date', 'confirmation_date', 'work_brief', 'guidelines', 'document1', 'document2', 'sku_qty'
    ];


    // AND catalog_allocation.batch_no
    public static function getcatalog_allocation_list(){   
        $wrcList = CatlogWrc::
        leftJoin('catalog_wrc_batches', 'catalog_wrc_batches.wrc_id', 'catlog_wrc.id')->
        leftJoin(
        'catalog_allocation',
        function ($join) {
            $join->on('catalog_allocation.wrc_id', '=', 'catalog_wrc_batches.wrc_id');
            $join->on('catalog_allocation.batch_no', '=', 'catalog_wrc_batches.batch_no');
        })->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        leftJoin('create_commercial_catalog as cc_catalog' , 'cc_catalog.id' , 'catlog_wrc.commercial_id')->
        leftJoin('users', 'lots_catalog.user_id', 'users.id')->
        leftJoin('brands', 'brands.id', '=', 'lots_catalog.brand_id')->
        leftJoin('users as u1', 'catalog_allocation.user_id', 'u1.id')->
        select(
            'catlog_wrc.id',
            'catlog_wrc.sku_qty as tot_sku_qty',
            'catlog_wrc.lot_id',
            'catlog_wrc.wrc_number',
            'catlog_wrc.alloacte_to_copy_writer',
            'catlog_wrc.commercial_id',
            'catlog_wrc.status',
            'catlog_wrc.img_recevied_date',
            'catlog_wrc.missing_info_notify_date',
            'catlog_wrc.missing_info_recived_date',
            'catlog_wrc.confirmation_date',
            'catlog_wrc.work_brief',
            'catlog_wrc.guidelines',
            'catlog_wrc.created_at',
            'catlog_wrc.id as wrc_id',
            'lots_catalog.lot_number',
            'users.Company',
            'brands.name',
            'cc_catalog.market_place',
            'cc_catalog.type_of_service',
            DB::raw('SUM(CASE WHEN user_role = 0 THEN allocated_qty else 0 END)  as cataloger_sum'),
            DB::raw('SUM(CASE WHEN user_role = 1 THEN allocated_qty else 0 END)  as cp_sum'),
            DB::raw('GROUP_CONCAT(u1.name) as ass_users'),
            DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as ass_cataloger'),
            'catalog_wrc_batches.batch_no',
            'catalog_wrc_batches.sku_count as sku_qty',
            )
        ->groupBy('catlog_wrc.id')
        ->groupBy('catalog_wrc_batches.batch_no')
        ->get()->toArray();
        return $wrcList;

    }
}
