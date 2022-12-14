<?php

namespace App\Http\Controllers;

use App\Models\CatlogWrc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogWrcController extends Controller
{
    // get data for create
    public function Index()
    {
        $users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['roles.name','=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
        // dd($users_data);

        $CatlogWrc = (object) [
            'id'=>0,
            'user_id'=>'',
            'brand_id'=>'',
            'lot_id'=>'',
            'commercial_id'=>'',
            'img_recevied_date'=>'',
            'missing_info_notify_date'=>'',
            'missing_info_recived_date'=>'',
            'confirmation_date'=>'',
            'sku_qty'=>'',
            'work_brief'=>'',
            'guidelines'=>'',
            'document1'=>'',
            'document2'=>'',
            'wrc_number'=>'',
            'alloacte_to_copy_writer'=>1,
            'button_name' => 'Create New Catlog WRC',
             'route' => 'STORECATLOGWRC'
        ];
        return view('Wrc.Catalog-wrc-create')->with('users_data', $users_data)->with('CatlogWrc',$CatlogWrc);
    }

    // getBrand List  
    public function getBrand(Request $request){

        $brand_data = DB::table('brands_user')->where('user_id' , $request->user_id)
        ->leftJoin('brands', 'brands_user.brand_id' , 'brands.id')
        ->select('brands.name', 'brands_user.brand_id', 'brands.short_name')->get();

        echo $brand_data;
    }

    public function getLotNumber(Request $request){

        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $data = [];

        $lot_number_data = DB::table('lots_catalog')->where('lots_catalog.user_id' , $user_id)->where('lots_catalog.brand_id' , $brand_id)
        ->leftJoin('brands', 'lots_catalog.brand_id' , 'brands.id')
       
        ->select('lots_catalog.id', 'lots_catalog.lot_number', 'lots_catalog.user_id', 'lots_catalog.brand_id', 'brands.short_name')->get();
        $commercial_data = DB::table('create_commercial_catalog')->where('user_id',$user_id)->where('brand_id',$brand_id)->select('id as create_commercial_catalog_id', 'market_place', 'type_of_service')->get();
        $data = [ "lot_number_data" => $lot_number_data, "commercial_data" => $commercial_data];
        echo json_encode($data);
    }

    // for store data
    public function store(Request $request)
    {
        // dd($request);
        // $wrcNumber = $lotInfo->c_short . $lotInfo->short_name . $lotInfo->s_type . $lotInfo->id . '-' . chr($wrcCount + 65);
        $project_name_array = explode(" ",$request->s_type);
        $count = count($project_name_array);
        $project_name = "";
        $wrcs = CatlogWrc::where(['lot_id' => $request->lot_id])->get();
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
        $createWrc = new CatlogWrc();
        $createWrc->lot_id = $request->lot_id;
        $createWrc->wrc_number = $wrcNumber;
        $createWrc->commercial_id = $request->commercial_id;
        $createWrc->img_recevied_date = $request->img_recevied_date;
        $createWrc->missing_info_notify_date = $request->missing_info_notify_date;
        $createWrc->missing_info_recived_date = $request->missing_info_recived_date;
        $createWrc->confirmation_date = $request->confirmation_date;
        $createWrc->work_brief = $request->work_brief;
        $createWrc->guidelines = $request->guide_lines;
        $createWrc->document1 = $request->document1;
        $createWrc->document2 = $request->document2;
        $createWrc->alloacte_to_copy_writer = $alloacte_to_copy_writer;
        $createWrc->sku_qty = $request->sku_qty;
        $createWrc->status = 'Ready_for_allocation';
        $createWrc->save();

        
        
        if($createWrc){
            request()->session()->flash('success','Catlog Wrc Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }

        //    return $this->Index();
       return $this->edit($request,$createWrc->id);

    }
    // for view
    public function view()
    {
       $wrcs =  CatlogWrc::OrderBy('catlog_wrc.id','ASC')
       ->leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')
       ->leftJoin('users', 'users.id', 'lots_catalog.user_id')
       ->leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')
       ->select('catlog_wrc.*','lots_catalog.user_id','lots_catalog.brand_id','lots_catalog.lot_number','users.Company as Company_name','brands.name')
       ->get();
        //    dd($wrcs);
        return view('Wrc.Catalog-view-wrc')->with('wrcs',$wrcs);
    }
    // for edit
    public function edit(Request $request, $id){
        $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([ ['users.Company' ,'<>' ,NULL], ['roles.name','=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

        $CatlogWrcs =  CatlogWrc::find($id);
        $lot_id = $CatlogWrcs->lot_id;

        $lot = DB::table('lots_catalog')->where('id',$lot_id)->first(['user_id','brand_id']);

        $user_id = $lot != null ? $lot->user_id : 0;
        $brand_id = $lot != null ? $lot->brand_id : 0;

        

        if($CatlogWrcs){
            $CatlogWrcs->button_name = 'Update WRC';
            $CatlogWrcs->route = 'UPDATECATLOGWRC';
            $CatlogWrcs->user_id = $user_id;
            $CatlogWrcs->brand_id = $brand_id;
            
            return view('Wrc.Catalog-wrc-create')->with('users_data', $users_data)->with('CatlogWrc',$CatlogWrcs);
           
        }
    }

    public function update(Request $request){
        // dd($request);
        $id =  $request->id;

        $project_name_array = explode(" ",$request->s_type);
        $count = count($project_name_array);
        $project_name = "";
        $wrcs = CatlogWrc::where(['lot_id' => $request->lot_id])->get();
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
        //update

        $createWrc = CatlogWrc::find($id);
        $createWrc->lot_id = $request->lot_id;
        $createWrc->wrc_number = $wrcNumber;
        $createWrc->commercial_id = $request->commercial_id;
        $createWrc->img_recevied_date = $request->img_recevied_date;
        $createWrc->missing_info_notify_date = $request->missing_info_notify_date;
        $createWrc->missing_info_recived_date = $request->missing_info_recived_date;
        $createWrc->confirmation_date = $request->confirmation_date;
        $createWrc->work_brief = $request->work_brief;
        $createWrc->guidelines = $request->guide_lines;
        $createWrc->document1 = $request->document1;
        $createWrc->document2 = $request->document2;
        $createWrc->alloacte_to_copy_writer = $alloacte_to_copy_writer;
        $createWrc->sku_qty = $request->sku_qty;
        $createWrc->status = 'Ready_for_allocation';
        $createWrc->update();
        
        if($createWrc){
            request()->session()->flash('success','Wrc Catlog Successfully Updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }

        return $this->edit($request,$id);
    }
}
