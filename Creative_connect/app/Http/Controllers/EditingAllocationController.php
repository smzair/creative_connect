<?php

namespace App\Http\Controllers;

use App\Models\EditingAllocation as ModelsCatalogAllocation;
use App\Models\EditingAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditingAllocationController extends Controller
{
    function index()
    {
        $allocation_type = 1;
        $wrcList = EditingAllocation::get_wrc_list_for_allocation($allocation_type);
        return view('Allocation.Editing_allocation')->with('wrcList', $wrcList)->with('allocation_type', $allocation_type);
    }

    function Editing_Re_Allocation()
    {
        $allocation_type = 2;
        $wrcList = EditingAllocation::get_wrc_list_for_allocation($allocation_type);
        return view('Allocation.Editing_allocation')->with('wrcList', $wrcList)->with('allocation_type', $allocation_type);
    }


    function Editing_alocated_sku_count(Request $request)
    {
        // dd($request->all());
        $wrc_id = $request->wrc_id;
        $batch_no = $request->batch_no;
        $data = ModelsCatalogAllocation::where('wrc_id', $wrc_id)->where('batch_no', $batch_no)->select(
                'wrc_id',
                DB::raw('SUM(CASE  	WHEN user_role = 0 THEN allocated_qty else 0 END)  as cataloger_sum'),
                DB::raw('SUM(CASE  	WHEN user_role = 1 THEN allocated_qty else 0 END)  as cp_sum'),
            )->get()->toArray();

        $cnt_rec = COUNT($data);
        if (
            $cnt_rec > 0
        ) {
            echo json_encode($data);
        } else {
            echo 0;
        }
    }

    // save Editing Allocation users 
    function save(Request $request){
        $res = EditingAllocation::saveEditingAllocation($request);
        echo json_encode($res, true);
    }

    


}
