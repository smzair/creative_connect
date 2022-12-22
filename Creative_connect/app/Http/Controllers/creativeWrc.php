<?php

namespace App\Http\Controllers;

use App\Models\CreativeWrcModel;
use App\Models\CreatLots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class creativeWrc extends Controller
{
   public function Index()
   {

    $users_data = DB::table('users')
    ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
    ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
    ->where([ ['users.Company' ,'<>' ,NULL], ['roles.name','=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
    // dd($users_data);

    $CreativeWrc = (object) [
        'id'=>0,
        'user_id'=>'',
        'brand_id'=>'',
        'wrc_number'=>'',
        'lot_id'=>'',
        'commercial_id'=>'',
        'order_qty'=>'',
        'work_brief'=>'',
        'guidelines'=>'',
        'document1'=>'',
        'document2'=>'',
        'alloacte_to_copy_writer'=>1,
        'button_name' => 'Create New WRC',
         'route' => 'STOREWRC'
    ];

    return view('Wrc.Creative-wrc-create')->with('users_data', $users_data)->with('CreativeWrc',$CreativeWrc);
   }

   // getBrand List 
   public function getBrand(Request $request){

        $brand_data = DB::table('brands_user')->where('user_id' , $request->user_id)
        ->leftJoin('brands', 'brands_user.brand_id' , 'brands.id')
        ->select('brands.name', 'brands_user.brand_id', 'brands.short_name')->get();

        echo $brand_data;
    }

    // LOT Number List 
    public function getLotNumber(Request $request){

        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $data = [];

        // get lot number dropdown value
        $lot_number_data = DB::table('creative_lots')->where('creative_lots.user_id' , $user_id)->where('creative_lots.brand_id' , $brand_id)
        ->leftJoin('brands', 'creative_lots.brand_id' , 'brands.id')
        ->select('creative_lots.id', 'creative_lots.lot_number', 'creative_lots.user_id', 'creative_lots.brand_id', 'brands.short_name')->get();

        // get commercial dropdown value
        $commercial_data = DB::table('create_commercial')->where('user_id',$user_id)->where('brand_id',$brand_id)->select('id as create_commercial_id', 'kind_of_work', 'project_name', 'per_qty_value')->get();
        $data = [ "lot_number_data" => $lot_number_data, "commercial_data" => $commercial_data];

        echo json_encode($data);
    }
    // for store data
    public function store(Request $request)
    {
        // $wrcNumber = $lotInfo->c_short . $lotInfo->short_name . $lotInfo->s_type . $lotInfo->id . '-' . chr($wrcCount + 65);
        $project_name_array = explode(" ",$request->s_type);
        $count = count($project_name_array);
        $project_name = "";
        $wrcs = CreativeWrcModel::where(['lot_id' => $request->lot_id])->get();
        $wrcCount = $wrcs->count();
        //get first char of each word
        // foreach( $project_name_array  as $key=>$val){
        //     $project_name .= $val[0];
        // }
        //get first char of first and last word
        $project_name .= $project_name_array[0][0];
        $project_name .= $project_name_array[$count-1][0];

        $alloacte_to_copy_writer = ((isset($request->alloacte_to_copy_writer) && $request->alloacte_to_copy_writer == 1)) ? 1 : 0;

        $wrcNumber = $request->c_short . $request->short_name . $project_name . $request->lot_id . '-' . chr($wrcCount + 65);

        $createWrc = new CreativeWrcModel();
        $createWrc->lot_id = $request->lot_id;
        $createWrc->wrc_number = $wrcNumber;
        $createWrc->commercial_id = $request->commercial_id;
        $createWrc->order_qty = $request->order_qty;
        $createWrc->work_brief = $request->work_brief;
        $createWrc->guidelines = $request->guide_lines;
        $createWrc->document1 = $request->document1;
        $createWrc->document2 = $request->document2;
        $createWrc->alloacte_to_copy_writer = $alloacte_to_copy_writer;
        $createWrc->status = 'inwarding_done';
        $createWrc->save();

        
        
        if($createWrc){
            request()->session()->flash('success','Wrc Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }

        //    return $this->Index();
       return $this->edit($request,$createWrc->id);

    }

    public function view()
    {
       $wrcs =  CreativeWrcModel::OrderBy('creative_wrc.id','ASC')
       ->leftJoin('creative_lots', 'creative_lots.id', 'creative_wrc.lot_id')
       ->leftJoin('users', 'users.id', 'creative_lots.user_id')
       ->leftJoin('brands', 'brands.id', 'creative_lots.brand_id')
       ->select('creative_wrc.*','creative_lots.user_id','creative_lots.brand_id','creative_lots.lot_number','users.Company as Company_name','brands.name')
       ->get();
        //    dd($wrcs);
        return view('Wrc.Creative-wrc-view')->with('wrcs',$wrcs);
    }

    public function edit(Request $request, $id){
        $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([ ['users.Company' ,'<>' ,NULL], ['roles.name','=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

        $CreativeWrcs =  CreativeWrcModel::find($id);
        $lot_id = $CreativeWrcs->lot_id;

        $lot = CreatLots::where('id',$lot_id)->first(['user_id','brand_id']);

        $user_id = $lot['user_id'];
        $brand_id = $lot['brand_id'];

        

        if($CreativeWrcs){
            $CreativeWrcs->button_name = 'Update WRC';
            $CreativeWrcs->route = 'UPDATEWRC';
            $CreativeWrcs->user_id = $user_id;
            $CreativeWrcs->brand_id = $brand_id;
            
            return view('Wrc.Creative-wrc-create')->with('users_data', $users_data)->with('CreativeWrc',$CreativeWrcs);
           
        }
    }

    public function update(Request $request){
        // dd($request);
        $id =  $request->id;

        $project_name_array = explode(" ",$request->s_type);
        $count = count($project_name_array);
        $project_name = "";
        $wrcs = CreativeWrcModel::where(['lot_id' => $request->lot_id])->get();
        $wrcCount = $wrcs->count();
        //get first char of each word
        // foreach( $project_name_array  as $key=>$val){
        //     $project_name .= $val[0];
        // }
        //get first char of first and last word
        $project_name .= $project_name_array[0][0];
        $project_name .= $project_name_array[$count-1][0];

        $wrcNumber = $request->c_short . $request->short_name . $project_name . $request->lot_id . '-' . chr($wrcCount + 65);
        $alloacte_to_copy_writer = ((isset($request->alloacte_to_copy_writer) && $request->alloacte_to_copy_writer == 1)) ? 1 : 0;
            // dd($alloacte_to_copy_writer);
        //create
        $CreativeWrcs =  CreativeWrcModel::find($id);
        $CreativeWrcs->lot_id = $request->lot_id;
        $CreativeWrcs->wrc_number = $wrcNumber;
        $CreativeWrcs->commercial_id = $request->commercial_id;
        $CreativeWrcs->order_qty = $request->order_qty;
        $CreativeWrcs->work_brief = $request->work_brief;
        $CreativeWrcs->guidelines = $request->guide_lines;
        $CreativeWrcs->document1 = $request->document1;
        $CreativeWrcs->document2 = $request->document2;
        $CreativeWrcs->alloacte_to_copy_writer = $alloacte_to_copy_writer;
        $CreativeWrcs->status = 'inwarding_done';
        $CreativeWrcs->update();
        
        if($CreativeWrcs){
            request()->session()->flash('success','Wrc Successfully Updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }

        return $this->edit($request,$id);
    }
}