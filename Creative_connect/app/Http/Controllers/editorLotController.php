<?php

namespace App\Http\Controllers;

use App\Models\EditorLotModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class editorLotController extends Controller
{
    // get data for create lot
    public function index()
    {
        return EditorLotModel::index();
    }

    // store lot data
    public function store(Request $request)
    {
        EditorLotModel::store($request);
        return $this->index();
    }

    // lot listing data
    public function getEditorLotData()
    {
        return EditorLotModel::getEditorLotData();
    }

    // get lot data for edit
    public function edit(Request $request, $id)
    {
        return EditorLotModel::edit($request, $id);
    }

    // update lot
    public  function update(Request $request)
    {
        $id = $request->id;
        $EditorLots = EditorLotModel::find($id);
        $EditorLots->user_id = $request->user_id;
        $EditorLots->brand_id = $request->brand_id;
        $EditorLots->lot_number = "";
        $EditorLots->request_name = $request->request_name;
        $EditorLots->status = 'ready_for_inwarding';
        $EditorLots->update();

        $id =  $EditorLots->id;
        // $request->s_type
        $s_type =  $request->request_name;
        $request_name_array = explode(" ", $s_type);
        $count = count($request_name_array);
        $request_name = "";
        // foreach( $request_name_array  as $key=>$val){
        //     $request_name .= $val[0];
        // }

        $request_name .= $request_name_array[0][0];
        $request_name .= $request_name_array[$count - 1][0];

        // dd($request_name);
        $lot_number = 'ODN' . date('dmY') . "-" . $request->c_short . $request->short_name .  $request_name . $id;
        //update lot number

        EditorLotModel::where('id', $id)->update(['lot_number' => strtoupper($lot_number)]);
        if ($EditorLots) {
            request()->session()->flash('success', 'Lots Updated Successfully');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return EditorLotModel::edit($request, $id);
    }
}
