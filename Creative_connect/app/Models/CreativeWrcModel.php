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
        $gd_role_data = DB::table('roles')->where('name','=','GD')->first(['id']);
        $cw_role_data = DB::table('roles')->where('name','=','CW')->first(['id']);
        $gd_id = $gd_role_data != null ? $gd_role_data->id : 0;
        $cw_id = $cw_role_data != null ? $cw_role_data->id : 0;

        $graphic_designer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', $gd_id]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);   

        // dd(dump($graphic_designer_users_data));

        $copy_writer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', $cw_id]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

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
        ->leftJoin('creative_wrc_batch as creative_wrc_batch', 'creative_wrc_batch.wrc_id', 'creative_wrc.id')
        ->leftJoin('creative_lots as cl', 'cl.id', 'creative_wrc.lot_id')
        ->leftJoin('users as users', 'users.id', 'cl.user_id')
        ->leftJoin('brands as brands', 'brands.id', 'cl.brand_id')
        ->leftJoin('create_commercial', function($join){
                    $join->on('create_commercial.user_id', '=', 'cl.user_id');
                    $join->on('create_commercial.brand_id', '=', 'cl.brand_id');
                    $join->on('create_commercial.id', '=', 'creative_wrc.commercial_id');
                })
        ->select('creative_wrc.id as wrc_id','creative_wrc.lot_id', 'creative_wrc.wrc_number', 'creative_wrc.commercial_id', 'creative_wrc.order_qty', 'creative_wrc.work_brief', 'creative_wrc.guidelines', 'creative_wrc.document1', 'creative_wrc.document2', 'creative_wrc.status', 'cl.user_id', 'cl.brand_id', 'cl.lot_number', 'cl.project_name', 'cl.work_initiate_date', 'cl.Comitted_initiate_date', 'cl.client_bucket', 'users.Company as Company', 'brands.name as brand_name','create_commercial.project_name', 'create_commercial.kind_of_work','creative_wrc.alloacte_to_copy_writer','creative_wrc.sku_count','creative_wrc_batch.order_qty as batch_order_qty','creative_wrc_batch.sku_count as batch_sku_count','creative_wrc_batch.batch_no as batch_batch_no')
        // ->groupBy('creative_wrc.id')
        // ->groupBy('creative_wrc_batch.id')
        ->get();

        foreach($resData as $rkey=> $rdata){
             // calculate copy writer allocated qty
             $rdata['cw_allocated_qty'] = DB::table('creative_allocation')->whereIn('user_id',$cw_user_id_data)->where('wrc_id',$rdata['wrc_id'])->where('batch_no',$rdata['batch_batch_no'])->sum('allocated_qty');

             // calculate graphics designer allocated qty
             $rdata['gd_allocated_qty'] = DB::table('creative_allocation')->whereIn('user_id',$gd_user_id_data)->where('wrc_id',$rdata['wrc_id'])->where('batch_no',$rdata['batch_batch_no'])->sum('allocated_qty');
        }        
        // dd($resData);
         return [
            "resData"                     => $resData,
            "graphic_designer_users_data" => $graphic_designer_users_data,
            "copy_writer_users_data"      => $copy_writer_users_data
         ];
         
    }

    public static function getDataForCreativeReAllocation(){

        $gd_role_data = DB::table('roles')->where('name','=','GD')->first(['id']);
        $cw_role_data = DB::table('roles')->where('name','=','CW')->first(['id']);
        $gd_id = $gd_role_data != null ? $gd_role_data->id : 0;
        $cw_id = $cw_role_data != null ? $cw_role_data->id : 0;

        // Graphic Designer  list
        $graphic_designer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', $gd_id]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);   

        // dd(dump($graphic_designer_users_data));

        $copy_writer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', $cw_id]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

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
        ->leftJoin('creative_wrc_batch as creative_wrc_batch', 'creative_wrc_batch.wrc_id', 'creative_wrc.id')
        ->leftJoin('creative_lots as cl', 'cl.id', 'creative_wrc.lot_id')
        ->leftJoin('users as users', 'users.id', 'cl.user_id')
        ->leftJoin('brands as brands', 'brands.id', 'cl.brand_id')
        ->leftJoin('create_commercial', function($join){
                    $join->on('create_commercial.user_id', '=', 'cl.user_id');
                    $join->on('create_commercial.brand_id', '=', 'cl.brand_id');
                    $join->on('create_commercial.id', '=', 'creative_wrc.commercial_id');
                })
        ->select('creative_wrc.id as wrc_id','creative_wrc.lot_id', 'creative_wrc.wrc_number', 'creative_wrc.commercial_id', 'creative_wrc.order_qty', 'creative_wrc.work_brief', 'creative_wrc.guidelines', 'creative_wrc.document1', 'creative_wrc.document2', 'creative_wrc.status', 'cl.user_id', 'cl.brand_id', 'cl.lot_number', 'cl.project_name', 'cl.work_initiate_date', 'cl.Comitted_initiate_date', 'cl.client_bucket', 'users.Company as Company', 'brands.name as brand_name','create_commercial.project_name', 'create_commercial.kind_of_work','creative_wrc.alloacte_to_copy_writer','creative_wrc.sku_count','creative_wrc_batch.order_qty as batch_order_qty','creative_wrc_batch.sku_count as batch_sku_count','creative_wrc_batch.batch_no as batch_batch_no')
        // ->groupBy('creative_wrc.id')
        // ->groupBy('creative_wrc_batch.id')
        ->get();

        foreach($resData as $rkey=> $rdata){

            $allocated_users = CreativeAllocation::where('wrc_id',$rdata['wrc_id'])
            ->where('batch_no',$rdata['batch_batch_no'])
            ->leftJoin('users as ulist', 'ulist.id', 'creative_allocation.user_id')
            ->select('ulist.name')->get();

            $rdata['allocated_users'] = $allocated_users;


            // calculate copy writer allocated qty
            $rdata['cw_allocated_qty'] = DB::table('creative_allocation')->whereIn('user_id',$cw_user_id_data)->where('wrc_id',$rdata['wrc_id'])->where('batch_no',$rdata['batch_batch_no'])->sum('allocated_qty');

            // calculate graphics designer allocated qty
            $rdata['gd_allocated_qty'] = DB::table('creative_allocation')->whereIn('user_id',$gd_user_id_data)->where('wrc_id',$rdata['wrc_id'])->where('batch_no',$rdata['batch_batch_no'])->sum('allocated_qty');
        }        
        // dd($resData);
         return [
            "resData"                     => $resData,
            "graphic_designer_users_data" => $graphic_designer_users_data,
            "copy_writer_users_data"      => $copy_writer_users_data
         ];
         
    }

}