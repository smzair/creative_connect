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
        'user_id', 'wrc_id'
    ];


    public static function catalog_allocationList(){

        // catalog_allocation.id , catalog_allocation.wrc_id , catalog_allocation.user_id ,

        // , DB::raw('SUM(catlog_wrc.sku_qty) as as sum_sku_qty')
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
    
}
