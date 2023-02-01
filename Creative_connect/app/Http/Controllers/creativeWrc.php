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
       return view('Wrc.Creative-wrc-create');
  }

  public function update(Request $request)
  {
    // dd($request);
    $id =  $request->id;

    $project_name_array = explode(" ", $request->s_type);
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
    $project_name .= $project_name_array[$count - 1][0];

    $wrcNumber = $request->c_short . $request->short_name . $project_name . $request->lot_id . '-' . chr($wrcCount + 65);

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
    $CreativeWrcs->status = 'inwarding_done';
    $CreativeWrcs->update();

    if ($CreativeWrcs) {
      request()->session()->flash('success', 'Wrc Successfully Updated');
    } else {
      request()->session()->flash('error', 'Please try again!!');
    }

    return $this->edit($request, $id);
  }
}
