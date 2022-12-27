<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreativeWrcModel extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'creative_wrc';
    protected $fillable=['lot_id', 'wrc_number', 'commercial_id', 'order_qty', 'work_brief', 'guidelines', 'document1', 'document2', 'status'];

    public static function getDataForCreativeAllocation(){

        // Graphic Designer  list
        $graphic_designer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', 15]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);   

        // dd(dump($graphic_designer_users_data));

        $copy_writer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', 16]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

        // dd(dump($copy_writer_users_data));

        $gd_user_id_data = [];
        $cw_user_id_data = [];

        foreach($graphic_designer_users_data as $key => $val){
            array_push($gd_user_id_data,$val->id);
        }

        foreach($copy_writer_users_data as $ckey => $cval){
            array_push($cw_user_id_data,$cval->id);
        }

        // dd($gd_user_id_data);
        // dd($cw_user_id_data);


        $resData = CreativeWrcModel::orderBy('creative_wrc.id','DESC')
        ->leftJoin('creative_lots as cl', 'cl.id', 'creative_wrc.lot_id')
        ->leftJoin('users as users', 'users.id', 'cl.user_id')
        ->leftJoin('brands as brands', 'brands.id', 'cl.brand_id')
        ->leftJoin('create_commercial', function($join){
                    $join->on('create_commercial.user_id', '=', 'cl.user_id');
                    $join->on('create_commercial.brand_id', '=', 'cl.brand_id');
                    $join->on('create_commercial.id', '=', 'creative_wrc.commercial_id');
                })
        ->select('creative_wrc.id as wrc_id','creative_wrc.lot_id', 'creative_wrc.wrc_number', 'creative_wrc.commercial_id', 'creative_wrc.order_qty', 'creative_wrc.work_brief', 'creative_wrc.guidelines', 'creative_wrc.document1', 'creative_wrc.document2', 'creative_wrc.status', 'cl.user_id', 'cl.brand_id', 'cl.lot_number', 'cl.project_name', 'cl.work_initiate_date', 'cl.Comitted_initiate_date', 'users.Company as Company', 'brands.name as brand_name','create_commercial.project_name', 'create_commercial.kind_of_work','creative_wrc.alloacte_to_copy_writer','creative_wrc.sku_count')
        ->groupBy('creative_wrc.id')->get();

        foreach($resData as $rkey=> $rdata){
            // calculate copy writer allocated qty
            $rdata['cw_allocated_qty'] = DB::table('creative_allocation')->whereIn('user_id',$cw_user_id_data)->where('wrc_id',$rdata['wrc_id'])->sum('allocated_qty');

            // calculate graphics designer allocated qty
            $rdata['gd_allocated_qty'] = DB::table('creative_allocation')->whereIn('user_id',$gd_user_id_data)->where('wrc_id',$rdata['wrc_id'])->sum('allocated_qty');
        }        

         return [
            "resData"                     => $resData,
            "graphic_designer_users_data" => $graphic_designer_users_data,
            "copy_writer_users_data"      => $copy_writer_users_data
         ];
         
    }
}