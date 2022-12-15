<?php

namespace App\Http\Controllers;
use App\Models\CreativeWrcModel;
use App\Models\CreativeAllocation;
use App\Models\CreativeUploadLink;
use App\Models\CreativeTimeHash;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CreativeAllocationController extends Controller
{
    // get data for create
    public function index(){
        $allocationList = CreativeWrcModel::getDataForCreativeAllocation() ;
        // dd( $allocationList);
        return view('Allocation.creative_allocation')->with('allocationList',$allocationList);
    }

    // assign wrc to user
    public function store(Request $request){
      
        $requestedData = $request->all();
        $msgCheck = false;
        
        foreach($requestedData['copywriterName'] as $key =>  $copywriterNameData){

            $presentDataCW = CreativeAllocation::where(['wrc_id'=>$request->wrc_id,'user_id'=>$requestedData['copywriterName'][$key]])
            ->groupBy('wrc_id')->get(['id','allocated_qty'])->first();

            $presentIdCW = $presentDataCW != NULL ? $presentDataCW->id : 0;
            $allocated_qty_cw = $presentDataCW != NULL ? $presentDataCW->allocated_qty : 0;

            // dd($presentIdCW);

            if($requestedData['copywriterName'][$key] != 0){
                if($presentIdCW === 0){
                    $CreativeAllocation                = new CreativeAllocation();
                    $CreativeAllocation->wrc_id        = $request->wrc_id;
                    $CreativeAllocation->user_id       = $requestedData['copywriterName'][$key];
                    $CreativeAllocation->allocated_qty = $requestedData['copyWriterQty'][$key];
                    $CreativeAllocation->save();
                    $msgCheck = true;
                }else{
                    $CreativeAllocation                =  CreativeAllocation::find($presentIdCW);
                    $CreativeAllocation->wrc_id        = $request->wrc_id;
                    $CreativeAllocation->user_id       = $requestedData['copywriterName'][$key];
                    $CreativeAllocation->allocated_qty = $requestedData['copyWriterQty'][$key] + $allocated_qty_cw;
                    $CreativeAllocation->update();
                    $msgCheck = true;
                }
            }

        }

        foreach($requestedData['designerName'] as $key =>  $designerNameData){

            $presentDataGd = CreativeAllocation::where(['wrc_id'=>$request->wrc_id,'user_id'=>$requestedData['designerName'][$key]])
            ->groupBy('wrc_id')->get(['id','allocated_qty'])->first();

            $presentIdGd = $presentDataGd != NULL ? $presentDataGd->id : 0;
            $allocated_qty_gd = $presentDataGd != NULL ? $presentDataGd->allocated_qty : 0;

            if($requestedData['designerName'][$key] != 0){
                if($presentIdGd === 0){
                    $CreativeAllocation                 = new CreativeAllocation();
                    $CreativeAllocation->wrc_id         = $request->wrc_id;
                    $CreativeAllocation->user_id        = $requestedData['designerName'][$key];
                    $CreativeAllocation->allocated_qty  = $requestedData['GraphicDesignerQty'][$key];
                    $CreativeAllocation->save();
                    $msgCheck = true;
                }else{
                    $CreativeAllocation                 =  CreativeAllocation::find($presentIdGd);
                    $CreativeAllocation->wrc_id         = $request->wrc_id;
                    $CreativeAllocation->user_id        = $requestedData['designerName'][$key];
                    $CreativeAllocation->allocated_qty  = $requestedData['GraphicDesignerQty'][$key] + $allocated_qty_gd;
                    $CreativeAllocation->update();
                    $msgCheck = true;
                }
            }
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

    // upload creative panel
    public function uploadCreative(){
        $allocationList = CreativeAllocation::GetCreativeAllocationForUpload();
        // dd(Carbon::now());
        return view('Allocation.upload_creative_panel')->with('allocationList',$allocationList);
    }

    public function setCreativeAllocationStart(Request $request){

        $allocate_id = CreativeTimeHash::where('allocation_id',$request->allocation_id)->get(['id'])->first();
        $already_allocated_id = $allocate_id != null ?  $allocate_id->id : 0;
        $start_time = Carbon::now();

        if( $already_allocated_id == 0){
            $storeData = new CreativeTimeHash();
            $storeData->start_time = $start_time;
            $storeData->allocation_id = $request->allocation_id;
            $storeData->save();
            if($storeData){
                echo json_encode([
                    "message"=>"success",
                    "start_time"=>$storeData->start_time,
                    "start_time1"=>dateFormat($storeData->start_time),
                    "start_time2"=>timeFormat($storeData->start_time)
                ]);
            }
            else{
                echo json_encode([
                    "message"=>"error",
                    "start_time"=>'',
                    "start_time1"=>'',
                    "start_time2"=>''
                ]);
            }
        }else{
            $storeData = CreativeTimeHash::find($already_allocated_id);
            $storeData->start_time = $start_time;
            $storeData->allocation_id = $request->allocation_id;
            $storeData->update();
            if($storeData){
                echo json_encode([
                    "message"=>"success",
                    "start_time"=>$storeData->start_time,
                    "start_time1"=>dateFormat($storeData->start_time),
                    "start_time2"=>timeFormat($storeData->start_time)
                ]);
            }
            else{
                echo json_encode([
                    "message"=>"error",
                    "start_time"=>'',
                    "start_time1"=>'',
                    "start_time2"=>''
                ]);
            }
        }
        
    }


    public function storeUploaddata(Request $request){
        // dd( $request);

        $creative_allocation_id =  $request->creative_allocation_id;
        $creative_link =  $request->workLink1;
        $copy_link =  $request->workLink2;
        $action_type = $request->submit;

        if($action_type == 'save'){

            $allocate_id = CreativeUploadLink::where('allocation_id',$creative_allocation_id)->get(['id'])->first();
            $already_allocated_id = $allocate_id != null ?  $allocate_id->id : 0;

            if( $already_allocated_id == 0){
                $storeData = new CreativeUploadLink();
                $storeData->allocation_id = $creative_allocation_id;
                $storeData->creative_link = $creative_link;
                $storeData->copy_link = $copy_link;
                $storeData->save();

                if($storeData){
                    request()->session()->flash('success','Uploading Creatives Added Successfully');
                }
                else{
                    request()->session()->flash('error','Please try again!!');
                }

            }else{
                $storeData = CreativeUploadLink::find($already_allocated_id);
                $storeData->allocation_id = $creative_allocation_id;
                $storeData->creative_link = $creative_link;
                $storeData->copy_link = $copy_link;
                $storeData->update();

                if($storeData){
                    request()->session()->flash('success','Uploading Creatives Updated Successfully');
                }
                else{
                    request()->session()->flash('error','Please try again!!');
                }
            }

            
        }

        if($action_type == 'complete_allocation'){

            $allocate_id = CreativeUploadLink::where('allocation_id',$creative_allocation_id)->get(['id'])->first();
            $already_allocated_id = $allocate_id != null ?  $allocate_id->id : 0;

            $end_time = Carbon::now();

            if( $already_allocated_id == 0){
                $storeData = new CreativeUploadLink();
                $storeData->allocation_id = $creative_allocation_id;
                $storeData->creative_link = $creative_link;
                $storeData->copy_link = $copy_link;
                $storeData->save();
               
                // update creative_time_hash end time
                CreativeTimeHash::where('allocation_id',$storeData->allocation_id)->update(['end_time'=>$end_time ]);

                if($storeData){
                    request()->session()->flash('success','Allocated Completed Successfully');
                }
                else{
                    request()->session()->flash('error','Please try again!!');
                }

            }else{
                $storeData = CreativeUploadLink::find($already_allocated_id);
                $storeData->allocation_id = $creative_allocation_id;
                $storeData->creative_link = $creative_link;
                $storeData->copy_link = $copy_link;
                $storeData->update();

                // update creative_time_hash end time
                CreativeTimeHash::where('allocation_id',$creative_allocation_id)->update(['end_time'=>$end_time ]);

                if($storeData){
                    request()->session()->flash('success','Allocated Completed Successfully');
                }
                else{
                    request()->session()->flash('error','Please try again!!');
                }
            }
        }

        return $this->uploadCreative();

    }
}
