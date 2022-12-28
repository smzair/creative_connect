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
        'lot_id', 'wrc_number', 'commercial_id', 'status', 'img_recevied_date', 'missing_info_notify_date', 'missing_info_recived_date', 'confirmation_date', 'work_brief', 'guidelines', 'document1', 'document2', 'sku_qty'
    ];


    public static function getcatalog_allocation_list(){   

        $wrcList = CatlogWrc::leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')
        ->leftJoin('users', 'lots_catalog.user_id', 'users.id')
        ->leftJoin('brands', 'brands.id', '=', 'lots_catalog.brand_id')
        ->leftJoin(
                'create_commercial_catalog as cc_catalog',
                function ($join) {
            $join->on('cc_catalog.user_id', '=', 'lots_catalog.user_id');
            $join->on('cc_catalog.brand_id', '=', 'lots_catalog.brand_id');
        })
        ->leftJoin('catalog_allocation' , 'catalog_allocation.wrc_id' , 'catlog_wrc.id')
        ->leftJoin('users as u1', 'catalog_allocation.user_id', 'u1.id')
        ->select(
            'sku_qty',
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
            'catlog_wrc.id',
            'lots_catalog.lot_number',
            'users.Company',
            'brands.name',
            'cc_catalog.market_place',
            'cc_catalog.type_of_service',
            DB::raw('SUM(CASE  	WHEN user_role = 0 THEN allocated_qty else 0 END)  as cataloger_sum'),
            DB::raw('SUM(CASE  	WHEN user_role = 1 THEN allocated_qty else 0 END)  as cp_sum'),
            DB::raw('GROUP_CONCAT(u1.name) as ass_users'),
            DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as ass_cataloger'),

            )
        ->groupBy('catlog_wrc.id')
        ->get()->toArray();
        return $wrcList;

    }
}
