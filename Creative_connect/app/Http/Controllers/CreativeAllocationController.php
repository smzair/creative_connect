<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreativeAllocationController extends Controller
{
    // get data for create
    public function index(){
        $allocationList = [];
        return view('Allocation.creative_allocation')->with('allocationList',$allocationList);
    }
    public function index2(){
        $allocationList = [];
        return view('Allocation.creative_allocation_details')->with('allocationList',$allocationList);
    }
   
}
