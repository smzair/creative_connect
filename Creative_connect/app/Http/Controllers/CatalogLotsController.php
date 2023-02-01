<?php

namespace App\Http\Controllers;

use App\Models\CatalogCommercial;
use App\Models\LotsCatalog;
use Illuminate\Http\Request;

class CatalogLotsController extends Controller
{
    public function index()
    {
        $lotInfo = (object)[
            'id' => '0',
            'user_id' => '',
            'brand_id' => '',
            'serviceType' => '',
            'requestType' => '',
            'reqReceviedDate' => '',
            'imgReceviedDate' => ''
        ];
        return view('Lots.Catalog_lots_create')->with('lotInfo', $lotInfo);
    }


    public function create(Request $request)
    {

        $id = $request->id;
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $c_short = $request->c_short;
        $short_name = $request->short_name;
        $serviceType = $request->serviceType;
        $requestType = $request->requestType;
        $reqReceviedDate = dateFormet_ymd($request->reqReceviedDate);
        $imgReceviedDate = $request->imgReceviedDate != '' ? dateFormet_ymd($request->imgReceviedDate) : "";

        $data = new LotsCatalog();

        $data->user_id = $user_id;
        $data->brand_id = $brand_id;
        $data->serviceType = $serviceType;
        $data->requestType = $requestType;
        $data->reqReceviedDate = $reqReceviedDate;
        $data->imgReceviedDate = $imgReceviedDate;
        $status = $data->save();

        if ($status) {
            $id =  $data->id;
            $lot_number = getLotNo($c_short, $short_name, $serviceType). $id;
            LotsCatalog::where('id', $id)->update(['lot_number' => $lot_number]);
            $lotInfo = (object)[
                'id' => '0',
                'user_id' => '',
                'brand_id' => '',
                'serviceType' => '',
                'requestType' => '',
                'reqReceviedDate' => '',
                'imgReceviedDate' => ''
            ];
            request()->session()->flash('success', 'Lots Catalog Successfully added');
        }else{
            $lotInfo = (object)[
                'id' => $user_id,
                'user_id' => $user_id,
                'brand_id' => $brand_id,
                'serviceType' => $serviceType,
                'requestType' => $requestType,
                'reqReceviedDate' => $reqReceviedDate,
                'imgReceviedDate' => $imgReceviedDate
            ];
            request()->session()->flash('false', 'Somthing went Wrong try agian!!');
        }
        return view('Lots.Catalog_lots_create')->with('lotInfo' , $lotInfo);

    }

    public function view()
    {
        
        $datas = LotsCatalog::leftJoin('brands', 'brands.id', '=', 'lots_catalog.brand_id')
        ->leftJoin('users', 'lots_catalog.user_id', 'users.id')
        ->select('lots_catalog.id','lots_catalog.brand_id', 'lots_catalog.lot_number', 'lots_catalog.serviceType', 'lots_catalog.requestType', 'lots_catalog.reqReceviedDate', 'lots_catalog.imgReceviedDate', 'users.Company', 'users.client_id', 'brands.name')
        ->get();
        $num = 1;
        return view('Lots.catalog_lots_view')->with('datas', $datas)->with('num', $num);

    }

    public function edit($id)
    {
       
        $datas = LotsCatalog::leftJoin('brands', 'brands.id', '=', 'lots_catalog.brand_id')
        ->leftJoin('users', 'lots_catalog.user_id', 'users.id')
        ->where('lots_catalog.id',$id)
        ->select('lots_catalog.id', 'lots_catalog.brand_id', 'lots_catalog.user_id', 'lots_catalog.serviceType', 'lots_catalog.requestType', 'lots_catalog.reqReceviedDate', 'lots_catalog.imgReceviedDate', 'users.c_short', 'brands.short_name')
        ->get()->first();

        return view('Lots.Catalog_lots_create')->with('lotInfo', $datas);
    }

    
    public function update(Request $request)
    {

        // dd($request->all());
        $id = $request->id;
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $c_short = $request->c_short;
        $short_name = $request->short_name;
        $serviceType = $request->serviceType;
        $requestType = $request->requestType;
        $reqReceviedDate = dateFormet_ymd($request->reqReceviedDate);
        $imgReceviedDate = $request->imgReceviedDate != '' ? dateFormet_ymd($request->imgReceviedDate) : "";

        $data = LotsCatalog::find($id);
        $lot_number = getLotNo($c_short, $short_name, $serviceType) . $id;

        $data->user_id = $user_id;
        $data->brand_id = $brand_id;
        $data->serviceType = $serviceType;
        $data->requestType = $requestType;
        $data->reqReceviedDate = $reqReceviedDate;
        $data->imgReceviedDate = $imgReceviedDate;
        $data->lot_number = $lot_number;
        $status = $data->update();

        if ($status) {
            request()->session()->flash('success', 'Lots cataLog Successfully Updated!!');
        }
        if (!$status) {
            request()->session()->flash('false', 'Somthing went wrong try again!!!');
        }


        return redirect()->route('EDITLOTCATALOG', [$id]);
    }

   
    public function destroy($id)
    {
        //
    }
}
