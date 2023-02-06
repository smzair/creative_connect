<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditingAllocation extends Model
{
    use HasFactory;
    protected $table = 'editing_allocations';
    protected $fillable = [
        'user_id', 'wrc_id', 'user_role', 'allocated_qty'
    ];

    // Function for Get WRC list for allocation 
    public static function get_wrc_list_for_allocation()
    {
        $wrcList = EditingWrc::
        // leftJoin('catalog_wrc_batches', 'catalog_wrc_batches.wrc_id', 'editing_wrcs.id')->
        // leftJoin(
        //     'editing_allocations',
        //     function ($join) {
        //         $join->on('editing_allocations.wrc_id', '=', 'catalog_wrc_batches.wrc_id');
        //         $join->on('editing_allocations.batch_no', '=', 'catalog_wrc_batches.batch_no');
        //     }
        // )->
        leftJoin('editor_lots', 'editor_lots.id', 'editing_wrcs.lot_id')->
        leftJoin('editors_commercials', 'editors_commercials.id', 'editing_wrcs.commercial_id')->
        leftJoin('users', 'editor_lots.user_id', 'users.id')->
        leftJoin('brands', 'brands.id', '=', 'editor_lots.brand_id')->
        // leftJoin('users as u1', 'editing_allocations.user_id', 'u1.id')->
        select(
            'editing_wrcs.id',
            'editing_wrcs.lot_id',
            'editing_wrcs.wrc_number',
            'editing_wrcs.commercial_id',
            'editing_wrcs.imgQty',
            'editing_wrcs.documentType',
            'editing_wrcs.documentUrl',
            'editing_wrcs.work_initiate_date',
            'editing_wrcs.work_committed_date',
            'editing_wrcs.created_at',
            'editing_wrcs.id as wrc_id',
            'editor_lots.lot_number',
            'users.Company',
            'brands.name',
            'editors_commercials.type_of_service',
            // DB::raw('SUM(CASE WHEN user_role = 0 THEN allocated_qty else 0 END)  as cataloger_sum'),
            // DB::raw('SUM(CASE WHEN user_role = 1 THEN allocated_qty else 0 END)  as cp_sum'),
            // DB::raw('GROUP_CONCAT(u1.name) as ass_users'),
            // DB::raw('GROUP_CONCAT(editing_allocations.user_id) as ass_cataloger'),
            // 'catalog_wrc_batches.batch_no',
            // 'catalog_wrc_batches.id as wrc_batch_id',
            // 'catalog_wrc_batches.work_initiate_date',
            // 'catalog_wrc_batches.work_committed_date',
            // 'catalog_wrc_batches.sku_count as sku_qty',
        )->
        groupBy('editing_wrcs.id')->
        get()->toArray();
        return $wrcList;
    }

}
