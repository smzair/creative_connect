<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatlaogQc extends Model
{
    use HasFactory;
    // get catalog allocated wrc list
    public static function get_catalog_allocated_wrc_list(){  
        
        $catalog_allocated_list = CatalogAllocation::
        leftJoin('catlog_wrc', 'catlog_wrc.id', 'catalog_allocation.wrc_id')->
        leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')->
        leftJoin('users', 'users.id', 'catalog_allocation.user_id')->
        leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')->
        leftJoin('catalog_upload_links', 'catalog_upload_links.allocation_id', 'catalog_allocation.id')->
        leftJoin('catalog_time_hash', 'catalog_time_hash.allocation_id', 'catalog_allocation.id')->
        // ,catalog_upload_links.catalog_link , catalog_upload_links.copy_link , GROUP_CONCAT(catalog_upload_links.catalog_link) as 'catalog_link_list' 
        select(
            'catalog_allocation.id as catalog_allocation_id',
            'catalog_allocation.wrc_id',
            'catalog_allocation.user_id',
            'catalog_allocation.user_role',
            'catalog_allocation.allocated_qty',
            DB::raw('GROUP_CONCAT(catalog_allocation.user_id) as ass_cataloger'),
            DB::raw('GROUP_CONCAT(catalog_allocation.user_role) as user_roles'),
            DB::raw('GROUP_CONCAT(catalog_allocation.id) as allocation_ids'),
            
            'catlog_wrc.wrc_number',
            'catlog_wrc.sku_qty',
            'catlog_wrc.id as catlog_wrc_id',
            'lots_catalog.id as lots_catalog_id',
            'lots_catalog.lot_number',
            'users.Company',
            'users.name as user_name',
            DB::raw('GROUP_CONCAT(users.id) as user_ids'),
            DB::raw('GROUP_CONCAT(users.name) as user_list'),
            'brands.id as brands_id',
            'brands.name as brands_name',

            'catalog_upload_links.catalog_link',
            'catalog_upload_links.copy_link',
            DB::raw('COUNT(catalog_upload_links.catalog_link) as catalog_links'),
            DB::raw('COUNT(catalog_upload_links.copy_link) as copy_links'),
            DB::raw('GROUP_CONCAT(catalog_upload_links.catalog_link) as catalog_link_list'),
            DB::raw('GROUP_CONCAT(catalog_upload_links.copy_link) as copy_link_list'),
            DB::raw('GROUP_CONCAT(catalog_time_hash.id) as time_hash_ids'),
            DB::raw('GROUP_CONCAT(catalog_time_hash.task_status) as task_status_is'),


           
        )->
        groupBy('catalog_allocation.wrc_id')->
        get()->toArray();
        return $catalog_allocated_list;
    }

    //  get_userlist for re work 
    public static function get_userlist($wrc_id, $role_id_is){
        $get_userlist = CatalogAllocation::
        leftJoin('users', 'users.id', 'catalog_allocation.user_id')->
        where('catalog_allocation.user_role', '=', $role_id_is)->
        where('catalog_allocation.wrc_id', '=', $wrc_id)->
        select(
            'catalog_allocation.id as catalog_allocation_id',
            'catalog_allocation.wrc_id',
            'catalog_allocation.user_id',
            'catalog_allocation.user_role',
            'users.name as user_name',
        )->
        get()->toArray();
        return json_encode($get_userlist);
    }

    // Set Qc Rework
    public static function set_qc_rework($wrc_id, $role_id_is, $catalog_allocation_id , $comments){

        $message = "Somthing Went Wrong";
        $status = 0;
        // $catalog_allocation_id = 99;
        $data = CatalogTimeHash::where('allocation_id', $catalog_allocation_id)->get()->first();

        if($data == NULL){
            $status = 3;
            $message = "Wrc Not started by user No need for rework!!";
        }else{
            $rework_count = $data->rework_count +1;
            $spent_time = $data->spent_time;
            $start_time = $data->start_time;
            $end_time = $data->end_time;
            $task_status = $data->task_status;
            $is_rework = $data->is_rework;
            $end_time = "0000-00-00 00:00:00";
            $start_time = "0000-00-00 00:00:00";
            if($task_status == 1 && $is_rework == 0){
                // rework alloted
                $status =  CatalogTimeHash::
                where('allocation_id', $catalog_allocation_id)->
                update(['end_time' => $end_time , 'start_time' => $start_time ,'task_status' => '0',  'is_rework' => 1 , 'rework_count' => $rework_count , 'spent_time' => $spent_time ]);

                if($status){
                    $message = "Rework Done!!";

                    $commentsData = new CatalogQcCommentsTable();
                    $commentsData->allocation_id = $catalog_allocation_id;
                    $commentsData->comments = $comments;
                    $commentsData->save();
                }
            }else if($task_status == 0 && $is_rework == 1){
                // task alloted to rework but not started
                $status = 2;
                $message = "Wrc Already in Rework state. work not started";
            }else{
                $status = 4;
                $message = "Wrc Not Completed No need for rework";
            }
        }
        return json_encode(array(
            'status' => $status,
            'message' => $message
        ));
    }

}
