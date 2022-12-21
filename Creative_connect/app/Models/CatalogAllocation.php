<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatalogAllocation extends Model
{
    use HasFactory;
    protected $table = 'catalog_allocation';
    protected $fillable = [
        'user_id', 'wrc_id' , 'user_role', 'allocated_qty'
    ];

    // list of catalog wrc allocated users
    public static function catalog_allocated_users_list(){

        $catalog_allocated_users_list = CatalogAllocation::
        leftJoin('users', 'catalog_allocation.user_id', 'users.id')->
        select(
            'catalog_allocation.id',
            'catalog_allocation.wrc_id',
            'catalog_allocation.user_id',
            'users.name as editor',
        )->
        groupBy('catalog_allocation.user_id')->
        get()->toArray();

        return $catalog_allocated_users_list;
    }


    // catalog allocated user List by lot numbers

    public static function catalog_allocation_List_by_lot_numbers()
    {

        $catalog_allocation_List_by_lot_numbers = CatalogAllocation::
        leftJoin('users', 'catalog_allocation.user_id', 'users.id')->
        leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        select(
                'catalog_allocation.id',
                'catalog_allocation.wrc_id',
                'catalog_allocation.user_id',
                'users.name as editor',
                'catlog_wrc.sku_qty',
                'catlog_wrc.lot_id',
                'lots_catalog.lot_number',
                DB::raw('GROUP_CONCAt(catalog_allocation.wrc_id) as wrc_ids'),
                DB::raw('GROUP_CONCAt(catlog_wrc.wrc_number) as wrc_numbers'),
                DB::raw('COUNT(catalog_allocation.wrc_id) as wrc_cnt'),
                DB::raw('sum(catalog_allocation.allocated_qty) as tot_sku_qty')
            )->groupBy(['catalog_allocation.user_id', 'lots_catalog.id'])->
            get()->
            toArray();
        return $catalog_allocation_List_by_lot_numbers;
    }

    // catalog list for allocated user  
    public static function catalog_allocationList(){

        $allocationList = CatalogAllocation::
        leftJoin('users', 'catalog_allocation.user_id', 'users.id')->
        leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        select('catalog_allocation.id' , 'catalog_allocation.wrc_id' , 
        'catalog_allocation.user_id' , 'users.name as editor' , 'catlog_wrc.wrc_number' ,
        'catlog_wrc.sku_qty' , 'catlog_wrc.lot_id' ,
        'lots_catalog.lot_number' ,
        DB::raw('GROUP_CONCAt(catlog_wrc.wrc_number) as wrc_ids '),
        DB::raw('GROUP_CONCAt(lots_catalog.lot_number) as lot_numbers '),
        DB::raw('COUNT(catalog_allocation.wrc_id) as wrc_cnt'),
        DB::raw('SUM(catlog_wrc.sku_qty) as tot_sku_qty') 
        )->
        groupBy('catalog_allocation.user_id')->
        get()->toArray();
        return $allocationList;
    }

    // allocated list for upload 

    public static function allocated_wrc_list_by_user($login_user_id_is)
    {

        // LEFT JOIN catlog_wrc on catlog_wrc.id = catalog_allocation.wrc_id
// LEFT JOIN create_commercial_catalog on create_commercial_catalog.id = catlog_wrc.commercial_id

//  catlog_wrc.lot_id , catlog_wrc.wrc_number, catlog_wrc.commercial_id ,create_commercial_catalog.market_place , create_commercial_catalog.type_of_service
        $login_user_id = $login_user_id_is;
        $allocated_wrc_list_by_user = CatalogAllocation::
        leftJoin('catalog_time_hash', 'catalog_time_hash.allocation_id', 'catalog_allocation.id')->
        leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        leftJoin('create_commercial_catalog', 'create_commercial_catalog.id', 'catlog_wrc.commercial_id')->
        where('catalog_allocation.user_id', $login_user_id)->
        select(
            'catalog_allocation.id',
            'catalog_allocation.wrc_id',
            'catalog_allocation.allocated_qty',
            'catalog_allocation.user_role',
            'catlog_wrc.lot_id',
            'catlog_wrc.wrc_number',
            'create_commercial_catalog.market_place as kind_of_work',
            'create_commercial_catalog.type_of_service as project_type',
            'catalog_time_hash.start_time',
            'catalog_time_hash.end_time',
            'catalog_time_hash.id as time_hash_id',
            'catalog_time_hash.task_status',
            'catalog_time_hash.is_rework',
            'catalog_time_hash.rework_count',
            'catalog_time_hash.spent_time',            
        )->
        get()->toArray();

        return $allocated_wrc_list_by_user;


    }

    public static function getcatalog_allocation_list()
    {
        $catalog_allocated_list = CatalogAllocation::
        leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        leftJoin('users', 'users.id', 'lots_catalog.user_id')->
        leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')->
       
        
        select(
            'catalog_allocation.wrc_id',
            'catlog_wrc.wrc_number',
            'users.Company',
            'brands.name as brand_name',
            'lots_catalog.lot_number',
            
            DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as ass_cataloger'),
            DB::raw('GROUP_CONCAT(catalog_allocation.user_role) as user_roles'),
            DB::raw('GROUP_CONCAT(catalog_allocation.id) as allocation_ids'),        
            'catlog_wrc.work_brief',
            'catlog_wrc.guidelines',
            'catlog_wrc.document1',
            'catlog_wrc.document2',
            'catlog_wrc.sku_qty',
            'catlog_wrc.lot_id',
            'catalog_allocation.created_at',
        )->
        groupBy('catalog_allocation.wrc_id')->    
        get()->toArray();
        return $catalog_allocated_list;
    }
    
}
