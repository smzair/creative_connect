<?php

namespace App\Http\Controllers;

use App\Models\CatalogAllocation;
use App\Models\CatalogTimeHash;
use App\Models\CatlaogQc;
use Google\Service\DataCatalog\Resource\Catalog;
use Illuminate\Http\Request;

class CatlaogQcController extends Controller
{
    /*** Display a listing of the resource. */
    public function index()
    {
        // dd('fdsfkg');
        $get_catalog_allocated_wrc_list = CatlaogQc::get_catalog_allocated_wrc_list();

        // dd($get_catalog_allocated_wrc_list);
        return view('Qc.qc-catalog')->with('get_catalog_allocated_wrc_list', $get_catalog_allocated_wrc_list);
    }


    // userlist for qc

    public function userlist(Request $request){
        $wrc_id = $request->wrc_id;
        $role_id_is = $request->role_id_is;
        $get_userlist = CatlaogQc::get_userlist($wrc_id, $role_id_is);
        echo $get_userlist;
    }


    // set_qc_rework

    public function set_qc_rework(Request $request){
        $wrc_id = $request->wrc_id;
        $role_id_is = $request->role_id_is;
        $comments = $request->comments;
        $catalog_allocation_id = $request->catalog_allocation_id;  
        $status = CatlaogQc::set_qc_rework($wrc_id, $role_id_is, $catalog_allocation_id , $comments);
        echo $status;
    }


    public function completed_qc_wrc(Request $request){
     $wrc_id = $request->wrc_id;

        $all_catalog_allocation = CatalogAllocation::where('wrc_id', $wrc_id)
            ->leftJoin('catalog_time_hash', 'catalog_time_hash.allocation_id', 'catalog_allocation.id')
            ->select('catalog_time_hash.task_status', 'catalog_time_hash.allocation_id')
            ->get();
        $check = 1;

        // dd($all_catalog_allocation);

        foreach ($all_catalog_allocation as $key => $val) {
            $check_task_status = $val['task_status'];
            if ($check_task_status != 1) {
                $check = 0;
            }
        }

        if ($check == 1) {

            $res_arr = array();
            foreach ($all_catalog_allocation as $key => $val) {
                $allocation_id = $val['allocation_id'];
                $up_status = CatalogTimeHash::where('allocation_id', $allocation_id)->update(['task_status' => 2]);
                array_push($res_arr , $up_status);
            }

            if(count($res_arr) == array_sum($res_arr) && array_sum($res_arr) ==  count($all_catalog_allocation)){
                $check = 1;
            }else{
                $check = 0;
            }
        }
        echo $check;
    }

    

    /** * Show the form for creating a new resource. */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.*/
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.*/
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage. */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage. */
    public function destroy($id)
    {
        //
    }
}
