<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatalogSubmission extends Model
{
    use HasFactory;
    protected $table = 'catalog_submission';
    protected $fillable = [
        'user_id', 'wrc_id', 'user_role', 'allocated_qty'
    ];

    public static function catalog_Wrc_list_for_Submission()
    {

    //    GROUP_CONCAT(catalog_upload_links.catalog_link) as 'catalog_links' , GROUP_CONCAT(catalog_upload_links.copy_link) as 'copy_links' , COUNT(catalog_upload_links.catalog_link) as 'catalog_link_cnt'

        $catalog_Wrc_list_for_Submission = CatalogAllocation::
        select(
            'catalog_allocation.wrc_id',
            'catalog_allocation.allocated_qty',
            DB::raw('GROUP_CONCAT(catalog_allocation.wrc_id) as wrc_ids'),
            DB::raw('GROUP_CONCAT(catalog_allocation.user_role) as user_roles'),
            DB::raw('COUNT(catalog_allocation.wrc_id) as wrc_cnt'),
            DB::raw('sum(catalog_allocation.allocated_qty) as tot_sku_qty'),
            DB::raw('SUM(CASE  	WHEN catalog_allocation.user_role = 0 THEN catalog_allocation.allocated_qty else 0 END)  as cataloger_allocated_qty'),
            DB::raw('SUM(CASE WHEN catalog_allocation.user_role = 1 THEN catalog_allocation.allocated_qty else 0 END)  as cp_allocated_qty'),
            'catalog_time_hash.task_status',
            'catalog_time_hash.spent_time',
            'catalog_time_hash.rework_count',
            DB::raw('GROUP_CONCAT(catalog_time_hash.spent_time) as tot_spent_time'),
            DB::raw('GROUP_CONCAT(catalog_upload_links.catalog_link) as catalog_links'),
            DB::raw('GROUP_CONCAT(catalog_upload_links.copy_link) as copy_links'),
            'catlog_wrc.lot_id',
            'catlog_wrc.wrc_number',
            'catlog_wrc.commercial_id',
            'catlog_wrc.alloacte_to_copy_writer',
            'catlog_wrc.sku_qty', 
            'catlog_wrc.work_brief',
            'lots_catalog.brand_id',
            'lots_catalog.lot_number',
            'lots_catalog.serviceType as kind_of_work',
            'users.Company as company',
            'users.c_short',
            DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as allocated_users_id'),
            DB::raw('GROUP_CONCAT(allocated_users.id) as allo_users_id'),
            DB::raw('GROUP_CONCAT(allocated_users.name) as allocated_users_name'),
            'brands.name as brands_name',
            'brands.short_name',
        )->
        leftJoin('catalog_time_hash', 'catalog_time_hash.allocation_id', 'catalog_allocation.id')->
        leftJoin('catalog_upload_links', 'catalog_upload_links.allocation_id', 'catalog_allocation.id')->
        leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        leftJoin('users', 'users.id', 'lots_catalog.user_id')->
        leftJoin('users as allocated_users', 'allocated_users.id', 'catalog_allocation.user_id')->
        leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')->
        WHERE('catalog_time_hash.task_status' , '=', '2')->
        groupBy(['catalog_allocation.wrc_id'])->
        get()->toArray();
        return $catalog_Wrc_list_for_Submission;
    }
}
