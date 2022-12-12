<?php

namespace App\Http\Controllers;
use App\Models\CreativeWrcModel;
use App\Models\CreativeAllocation;

use Illuminate\Http\Request;

class CreativeAllocationController extends Controller
{
    // get data for create
    public function index(){
        $allocationList = CreativeWrcModel::getDataForCreativeAllocation() ;
        return view('Allocation.creative_allocation')->with('allocationList',$allocationList);
    }

    // assign wrc to user
    public function store(Request $request){
      
        $requestedData = $request->all();
        $msgCheck = false;
        
        foreach($requestedData['copywriterName'] as $key =>  $copywriterNameData){
            $CreativeAllocation                = new CreativeAllocation();
            $CreativeAllocation->wrc_id        = $request->wrc_id;
            $CreativeAllocation->user_id       = $requestedData['copywriterName'][$key];
            $CreativeAllocation->allocated_qty = $requestedData['copyWriterQty'][$key];
            $CreativeAllocation->save();
            $msgCheck = true;
        }

        foreach($requestedData['designerName'] as $key =>  $designerNameData){
            $CreativeAllocation                 = new CreativeAllocation();
            $CreativeAllocation->wrc_id         = $request->wrc_id;
            $CreativeAllocation->user_id        = $requestedData['designerName'][$key];
            $CreativeAllocation->allocated_qty  = $requestedData['GraphicDesignerQty'][$key];
            $CreativeAllocation->save();
            $msgCheck = true;
        }
        if($msgCheck){
            request()->session()->flash('success','Wrc Allocated Successfully');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        
        $allocationList = CreativeWrcModel::getDataForCreativeAllocation() ;
        return view('Allocation.creative_allocation')->with('allocationList',$allocationList);
    }

    // creative allocation get 
    public function CreativeAllocationGet(){
        $allocationList = CreativeAllocation::GetCreativeAllocation();
        // dd($allocationList);
        return view('Allocation.creative_allocation_details')->with('allocationList',$allocationList);
    }
}
