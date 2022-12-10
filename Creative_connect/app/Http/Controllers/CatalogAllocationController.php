<?php

namespace App\Http\Controllers;

use App\Models\CatalogAllocation;
use App\Models\CatlogWrc;
use Illuminate\Http\Request;

class CatalogAllocationController extends Controller
{

    // List of catalog for allocate it to users
    function index(){
        $wrcList = CatlogWrc::getcatalog_allocation_list();
        return view('Allocation.catalog_allocation')->with('wrcList', $wrcList);
    }

    // function for allocate wrc to user (save)
    function save(Request $request){



        $CatalogAllocation_list = CatalogAllocation::where([
            ['user_id',  $request->user_id],
            ['wrc_id',  $request->wrc_id],
        ])->get()->toArray();

        $all_cnt = count($CatalogAllocation_list);

        if($all_cnt > 0){
            echo 2;
        }else{
            $catalog_allocation = new CatalogAllocation();
            $catalog_allocation->user_id = $request->user_id;
            $catalog_allocation->wrc_id = $request->wrc_id;
            $status = $catalog_allocation->save();
            if($status){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    
    // list/details of allocated users and wrc.
    function details(){
        $allocationList = CatalogAllocation::catalog_allocationList();
        return view('Allocation.catalog_allocation_detail')->with('allocationList', $allocationList);
    }

    function upload()
    {

        return view('Allocation.upload_catalog_panel');
    }
}
