<?php

namespace App\Http\Controllers;

use App\Models\CatalogAllocation;
use App\Models\CatalogTimeHash;
use App\Models\CatalogUploadLinks;
use App\Models\CatlogWrc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogAllocationController extends Controller
{
    // List of catalog for allocate it to users
    function index(){
        $wrcList = CatlogWrc::getcatalog_allocation_list();
        return view('Allocation.catalog_allocation')->with('wrcList', $wrcList);
    }

    // function for allocate wrc to user (save)
    function save(Request $request){

        $user_id = $request->user_id;
        $Cataloguer_Qty = $request->Cataloguer_Qty;
        $copywriter_id = $request->copywriter_id;
        $copywriter_Qty = $request->copywriter_Qty;
        $wrc_id = $request->wrc_id;

        $res = [];

        // SELECT `id`, `wrc_id`, `user_id`, `user_role`, `allocated_qty`, `created_at`, `updated_at` FROM `catalog_allocation` WHERE 1

        $res['user'] = '0';
        $res['copywriter'] = '0';
        if($user_id > 0) {
            $CatalogAllocation_list = CatalogAllocation::where([
                ['user_id',  $user_id],
                ['wrc_id',  $wrc_id],
            ])->get()->toArray();
            $all_cnt = count($CatalogAllocation_list);
            if ($all_cnt > 0) {
                $res[ 'user'] = '3';
            } else {
                $catalog_allocation_user = new CatalogAllocation();
                $catalog_allocation_user->user_id = $user_id;
                $catalog_allocation_user->wrc_id = $wrc_id;
                $catalog_allocation_user->allocated_qty = $Cataloguer_Qty;
                $catalog_allocation_user->user_role = 0;
                $status = $catalog_allocation_user->save();
                if ($status) {
                    $res['user'] = '1';
                } else {
                    $res['user'] = '2';
                }
            }
        }

        if($copywriter_id > 0) {
            $CatalogAllocation_list = CatalogAllocation::where([
                ['user_id',  $copywriter_id],
                ['wrc_id',  $wrc_id],
            ])->get()->toArray();

            $all_cnt = count($CatalogAllocation_list);
            if ($all_cnt > 0) {
                $res['copywriter'] = '3';
            } else {
                $catalog_allocation = new CatalogAllocation();
                $catalog_allocation->user_id = $copywriter_id;
                $catalog_allocation->wrc_id = $wrc_id;
                $catalog_allocation->allocated_qty = $copywriter_Qty;
                $catalog_allocation->user_role = 1;
                $status = $catalog_allocation->save();
                if ($status) {
                    $res['copywriter'] = '1';
                } else {
                    $res['copywriter'] = '2';
                }
            }
        }
        // echo "user_id => $user_id , Cataloguer_Qty => $Cataloguer_Qty , copywriter_id => $copywriter_id, copywriter_Qty => $copywriter_Qty , wrc_id => $wrc_id";

        // dd($res);
        echo json_encode($res,true);
        // echo json_encode(array('data' => $res),true);
        
    }


    function alocated_sku_count(Request $request)
    {
        $wrc_id = $request->wrc_id;
        $data = CatalogAllocation::where('wrc_id', $wrc_id)->select(
            'wrc_id',
            DB::raw('SUM(CASE  	WHEN user_role = 0 THEN allocated_qty else 0 END)  as cataloger_sum'),
            DB::raw('SUM(CASE  	WHEN user_role = 1 THEN allocated_qty else 0 END)  as cp_sum'),
        )->get()->toArray();

        $cnt_rec = COUNT($data);
        if ($cnt_rec > 0
        ) {
            echo json_encode($data);
        } else {
            echo 0;
        }
    }

    // list/details of allocated users and wrc.
    function details(){

        $catalog_allocated_users_list = CatalogAllocation::catalog_allocated_users_list();
        $catalog_allocation_List_by_lot_numbers = CatalogAllocation::catalog_allocation_List_by_lot_numbers();
        // $allocationList = CatalogAllocation::catalog_allocationList();
        return view('Allocation.catalog_allocation_detail')
        // ->with('allocationList', $allocationList)
            ->with('catalog_allocation_List_by_lot_numbers', $catalog_allocation_List_by_lot_numbers)
        ->with('catalog_allocated_users_list', $catalog_allocated_users_list)
        ;
    }

   
    // show catalog allocation upload blade
    function upload()
    {
        
        $login_user_id_is = 34;
        $user_role = 'CW';
        $login_user_id_is = 7;
        $user_role = 'Cataloguer';
        $allocationList = CatalogAllocation::getcatalog_allocation_list();
        $allocated_wrc_list_by_user = CatalogAllocation::allocated_wrc_list_by_user($login_user_id_is);
        return view('Allocation.upload_catalog_panel')->with('allocationList', $allocationList)->with('allocated_wrc_list_by_user', $allocated_wrc_list_by_user)->with('user_role', $user_role);
    }

    // set_tast_start
    function set_tast_start(Request $request){
        $allocation_id = $request->allocation_id;
        $start_time = date('Y-m-d H:i:s');

        $status = CatalogTimeHash::set_tast_start($allocation_id , $start_time);

        $response = array(
            'status' => $status ,
            'start_time'=> date('Y-m-d h:i:s A',strtotime($start_time))
        );

        echo json_encode($response);

    }

    // get catalog uploaded link 

    function get_catalog_link(Request $request){
        $allocation_id = $request->allocation_id;
        $response = CatalogUploadLinks::get_catalog_uploaded_link($allocation_id);
        if($response == 0){
            echo $response;
        }
        else{
            echo json_encode($response);
        }
    }


    // upload_catalog_link 
    function upload_catalog_link(Request $request){

        $allocation_id_is = $request->allocation_id_is;
        $catalog_link = $request->catalog_link;
        $copy_link = $request->copy_link;
        $action = $request->action;

        $status = CatalogUploadLinks::upload_catalog_link($allocation_id_is, $catalog_link, $copy_link, $action );

        $end_time_is = '';
        $up_status = '';

        if ($status != 0 && $action == 'comp') {
            $end_time = date('Y-m-d H:i:s');
            $up_status = CatalogTimeHash::where('allocation_id', $allocation_id_is)->update(['end_time' => $end_time]);
            if($up_status){
                $end_time_is = date('Y-m-d h:i:s A', strtotime($end_time));
            }
        }
        $response = array(
            'status' => $status,
            'up_status' => $up_status,
            'end_time' => $end_time_is
        );
        echo json_encode($response);
    }
}
