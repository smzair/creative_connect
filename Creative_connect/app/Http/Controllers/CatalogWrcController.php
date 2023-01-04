<?php

namespace App\Http\Controllers;

use App\Models\CatalogMarketplaceCredentials;
use App\Models\CatalogWrcBatch;
use App\Models\CatalogWrcSku;
use App\Models\CatlogWrc;
use App\Models\Marketplace;
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
            ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
        // dd($users_data);

        $CatlogWrc = (object) [
            'id' => 0,
            'user_id' => '',
            'brand_id' => '',
            'lot_id' => '',
            'commercial_id' => '',
            'img_recevied_date' => '',
            'missing_info_notify_date' => '',
            'missing_info_recived_date' => '',
            'confirmation_date' => '',
            'sku_qty' => '',
            'work_brief' => '',
            'modeOfDelivary' => '0', 
            'generic_data_format' => '',
            'img_as_per_guidelines' => '',
            'guidelines' => '',
            'document1' => '',
            'document2' => '',
            'wrc_number' => '',
            'alloacte_to_copy_writer' => 1,
            'button_name' => 'Create New Catlog WRC',
            'route' => 'STORECATLOGWRC'
        ];
        $sku_details = array(
            'unique_Count' => 0,
            'variant_Count' => 0,
            'total_Count' => 0,
        );
        return view('Wrc.Catalog-wrc-create')->with('users_data', $users_data)->with('CatlogWrc', $CatlogWrc)->with('sku_details', $sku_details);
    }


    // marketplace_Credentials_List for save and store in wrc panel
    public function marketplace_Credentials_List(Request $request){
        $commercial_id = $request->commercial_id;
        $market_place_ids = $request->market_place_ids;
        // $response = Marketplace::marketplace_Credentials_List($commercial_id, $market_place_ids);
        $response = Marketplace::catalog_marketplace_Credentials_List($commercial_id , $market_place_ids);
        echo json_encode($response);
    }


    public function MarketPlace()
    {
        return view('Wrc.Catalog-marketplace-list');
    }

    // function for marketplace Credentials details in Marketplace Credentials panel 
    public function marketplace_Credentials_details(Request $request){
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;

        $response = CatalogMarketplaceCredentials::get_c_data($user_id, $brand_id);
        echo $response;
    }

    // testing function marketplace_Credentials_List
    // public function catalog_marketplace_Credentials_List(Request $request){
    //     $market_place_ids = '2,4,6';
    //     $commercial_id = '2';
    //     $response = Marketplace::catalog_marketplace_Credentials_List($commercial_id , $market_place_ids);
    //     dd($response);
    // }


    public function save_wrc_Credentials(Request $request){
        $data_arr = $request->data_arr;
        $market_place_id_is = $request->market_place_id_is;
        $commercial_id_is = $request->commercial_id_is;
        $response = Marketplace::save_wrc_Credentials($data_arr, $commercial_id_is , $market_place_id_is);
        echo $response;
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

        $commercial_data = DB::table('create_commercial_catalog')->where('user_id',$user_id)->where('brand_id',$brand_id)->select('id as create_commercial_catalog_id', 'market_place', 'type_of_service', 'market_place  as market_place_ids')->get();
        
        $marketPlace_list = getMarketPlace();
        $marketPlace_data = array_column($marketPlace_list, 'marketPlace_name', 'id');
        foreach($commercial_data as $key => $data){
            $market_place_str = $data->market_place;
            $market_place_arr = explode(',', $market_place_str);
            $market_place_new_str = "";
            foreach($market_place_arr as $key => $val){
                $market_place_new_str .= $marketPlace_data[$val].',';
            }
            $market_place_new_str = rtrim($market_place_new_str, ",");
            $data->market_place = $market_place_new_str;
            // echo "<br>". $market_place_str ." ". $market_place_new_str;
        }

        $data = [ "lot_number_data" => $lot_number_data, "commercial_data" => $commercial_data];
        echo json_encode($data);
    }

    // for store data
    public function store(Request $request)
    {
        // $wrcNumber = $lotInfo->c_short . $lotInfo->short_name . $lotInfo->s_type . $lotInfo->id . '-' . chr($wrcCount + 65);
        DB::beginTransaction();

        try {
       
            $project_name_array = explode(" ", $request->s_type);
            $count = count($project_name_array);
            $project_name = "";
            $wrcs = CatlogWrc::where(['lot_id' => $request->lot_id])->get();
            $wrcCount = $wrcs->count();
            $project_name .= $project_name_array[0][0];
            $project_name .= $project_name_array[$count - 1][0];

            $wrcNumber = $request->c_short . $request->short_name . $project_name . $request->lot_id . '-' . chr($wrcCount + 65);
            $alloacte_to_copy_writer = ((isset($request->alloacte_to_copy_writer) && $request->alloacte_to_copy_writer == 1)) ? 1 : 0;

            $modeOfDelivary = $request->modeOfDelivary;

            $createWrc = new CatlogWrc();

            $createWrc->lot_id = $request->lot_id;
            $createWrc->wrc_number = $wrcNumber;
            $createWrc->modeOfDelivary = $modeOfDelivary;
            $createWrc->commercial_id = $request->commercial_id;
            
            $createWrc->img_recevied_date = $request->img_recevied_date == null ? '' : $request->img_recevied_date;
            $createWrc->missing_info_notify_date = $request->missing_info_notify_date == null ? '' : $request->missing_info_notify_date;
            $createWrc->missing_info_recived_date = $request->missing_info_recived_date == null ? '' : $request->missing_info_recived_date;
            $createWrc->confirmation_date = $request->confirmation_date == null ? '' : $request->confirmation_date;
            $createWrc->work_brief = $request->work_brief == null ? '' : $request->work_brief;
            $createWrc->guidelines = $request->guide_lines == null ? '' : $request->guide_lines;
            $createWrc->document1 = $request->document1 == null ? '' : $request->document1;
            $createWrc->document2 = $request->document2 == null ? '' : $request->document2;

            $sku_qty_is = $request->sku_qty == null ? '0' : $request->sku_qty;
            $createWrc->alloacte_to_copy_writer = $alloacte_to_copy_writer;
            $createWrc->sku_qty = $sku_qty_is;
            $createWrc->status = 'Ready_for_allocation';
            $createWrc->save();

            $wrc_id_is = $createWrc->id;


            $lot_id = $request->lot_id;
            $catalog_requestType = DB::table('lots_catalog')->where('id', $lot_id)->get(['requestType'])->first();
            $requestType = $catalog_requestType  != null ? $catalog_requestType->requestType : null;
            $batch_no = 0;
            if($requestType == 'Retainer'){
                $batch_no = 1;
            }

            // code for save file
            $handle = fopen($_FILES['sku_sheet']['tmp_name'], "r");
            $count = 1;
            $saved_rows = 0;

            $sku_details = array(
                'unique_Count' => 0,
                'variant_Count' => 0,
                'total_Count' => 0,
            );
            while ($csvLine = fgetcsv($handle, 1000, ",")) {
                if ($count <= 1) {
                    $count++;
                    continue;
                }

                $sku_code = $csvLine[0];
                $style = $csvLine[1];
                $type_of_service = $csvLine[2];
                
                if ($sku_code != null && $style != null && $type_of_service != null && $sku_code != '' && $style != '' && $type_of_service != '') {
                    $skuObj = new CatalogWrcSku();
                    $skuObj->sku_code = $sku_code;
                    $skuObj->style = $style;
                    $skuObj->type_of_service = $type_of_service;
                    $skuObj->batch_no = $batch_no;
                    $skuObj->wrc_id = $wrc_id_is;
                    $skuObj->save();
                    $saved_rows++;
                    $sku_details['total_Count']++;
                    if($style == 'parent'){
                        $sku_details['unique_Count']++;
                    }else{
                        $sku_details['variant_Count']++;
                    }
                }
            }

            if ($requestType == 'Retainer') {
                $storeWrcBatch = new CatalogWrcBatch();
                $storeWrcBatch->wrc_id = $wrc_id_is;
                $storeWrcBatch->batch_no = $batch_no;
                $storeWrcBatch->sku_count = $saved_rows;
                $storeWrcBatch->save();
            }

            $tot_sku_qty_is = $saved_rows + $sku_qty_is;
            CatlogWrc::where('id', $wrc_id_is)->update(['sku_qty' => $tot_sku_qty_is]);
           
            DB::commit();
            if ($createWrc) {
                request()->session()->flash('success', 'Catlog Wrc Successfully added');
            } else {
                request()->session()->flash('error', 'Please try again!!');
            }

        //    return $this->view($request, $createWrc->id);

            $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
            // dd($users_data);

            $CatlogWrc = (object) [
                    'id' => 0,
                    'user_id' => '',
                    'brand_id' => '',
                    'lot_id' => '',
                    'commercial_id' => '',
                    'img_recevied_date' => '',
                    'missing_info_notify_date' => '',
                    'missing_info_recived_date' => '',
                    'confirmation_date' => '',
                    'sku_qty' => $saved_rows,
                    'work_brief' => '',
                    'modeOfDelivary' => '0',
                    'generic_data_format' => '',
                    'img_as_per_guidelines' => '',
                    'guidelines' => '',
                    'document1' => '',
                    'document2' => '',
                    'wrc_number' => $wrcNumber,
                    'alloacte_to_copy_writer' => 1,
                    'button_name' => 'Create New Catlog WRC',
                    'route' => 'STORECATLOGWRC'
                ];
            return view('Wrc.Catalog-wrc-create')->with('users_data', $users_data)->with('CatlogWrc', $CatlogWrc)->with('sku_details', $sku_details);;

            return $this->Index($request, $createWrc->id);
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('error', 'Please try again!!');
        }
    }
    // for view
    public function view()
    {
        $wrcs =  CatlogWrc::OrderBy('catlog_wrc.id', 'ASC')
            ->leftJoin('lots_catalog', 'lots_catalog.id', 'catlog_wrc.lot_id')
            ->leftJoin('users', 'users.id', 'lots_catalog.user_id')
            ->leftJoin('brands', 'brands.id', 'lots_catalog.brand_id')
            ->select('catlog_wrc.*', 'lots_catalog.user_id', 'lots_catalog.brand_id', 'lots_catalog.lot_number', 'users.Company as Company_name', 'brands.name')
            ->get();
        //    dd($wrcs);
        return view('Wrc.Catalog-view-wrc')->with('wrcs', $wrcs);
    }
    // for edit
    public function edit(Request $request, $id)
    {
        $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

        $CatlogWrcs =  CatlogWrc::find($id);
        $lot_id = $CatlogWrcs->lot_id;

        $lot = DB::table('lots_catalog')->where('id', $lot_id)->first(['user_id', 'brand_id']);

        $user_id = $lot != null ? $lot->user_id : 0;
        $brand_id = $lot != null ? $lot->brand_id : 0;

        $sku_details = array(
            'unique_Count' => 0,
            'variant_Count' => 0,
            'total_Count' => 0,
        );

        if ($CatlogWrcs) {
            $CatlogWrcs->button_name = 'Update WRC';
            $CatlogWrcs->route = 'UPDATECATLOGWRC';
            $CatlogWrcs->user_id = $user_id;
            $CatlogWrcs->brand_id = $brand_id;

            return view('Wrc.Catalog-wrc-create')->with('users_data', $users_data)->with('CatlogWrc', $CatlogWrcs)->with('sku_details', $sku_details);
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        $id =  $request->id;

        $project_name_array = explode(" ", $request->s_type);
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
        $project_name .= $project_name_array[$count - 1][0];

        $wrcNumber = $request->c_short . $request->short_name . $project_name . $request->lot_id . '-' . chr($wrcCount + 65);

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
        $createWrc->sku_qty = $request->sku_qty;
        $createWrc->status = 'Ready_for_allocation';
        $createWrc->update();

        if ($createWrc) {
            request()->session()->flash('success', 'Wrc Catlog Successfully Updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return $this->edit($request, $id);
    }
}
