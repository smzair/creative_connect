<?php

namespace App\Http\Controllers;

use App\Models\CatalogWrcBatch;
use App\Models\CatalogWrcSku;
use App\Models\CatlogWrc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogWrcBatchController extends Controller
{
    //

    public function index()
    {
        $catalog_Wrc_Batch_list = CatalogWrcBatch::catalog_Wrc_Batch_list();
        return view('Wrc.Catalog-wrc-batch')->with('data_arr', $catalog_Wrc_Batch_list);
        // echo "Catalog-wrc-batch";
    }


    // for store data
    public function storeNewBatch(Request $request)
    {

        DB::beginTransaction();
        $wrc_id_is = $wrc_id = $request->wrc_id;
        $wrc_data = CatlogWrc::where('id', $wrc_id)->get(['sku_qty'])->first();
        $sku_qty_is = $wrc_data->sku_qty;
        $prequisites = $request->Prequisites == null ? '' : $request->Prequisites;
        try {

            $file_error = $_FILES['sku_sheet']['error'];
            $file_type = $_FILES['sku_sheet']['type'];
            $saved_rows = 0;
            if($file_error == 0 && $file_type == 'text/csv'){
                $handle = fopen($_FILES['sku_sheet']['tmp_name'], "r");
                $count = 1;

                $sku_details = array(
                    'unique_Count' => 0,
                    'variant_Count' => 0,
                    'total_Count' => 0,
                );
                while ($csvLine = fgetcsv($handle, 1000, ",")) {
                    // Add a condition to stop header insertion
                    if ($count <= 1) {
                        $count++;
                        continue;
                    }
                    $count++;

                    $sku_code = $csvLine[0];
                    $style = $csvLine[1];
                    $type_of_service = $csvLine[2];

                    $creative_wrc_batch = CatalogWrcBatch::orderby('id', 'DESC')->where('wrc_id', $wrc_id)->get('batch_no')->first();
                    $wrc_batch_no = $creative_wrc_batch != null ? $creative_wrc_batch->batch_no : 0;

                    $batch_no = $wrc_batch_no + 1;

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
                        if ($style == 'parent') {
                            $sku_details['unique_Count']++;
                        } else {
                            $sku_details['variant_Count']++;
                        }
                    }
                }
                $tot_sku_qty_is = $saved_rows + $sku_qty_is;
                CatlogWrc::where('id', $wrc_id_is)->update(['sku_qty' => $tot_sku_qty_is]);

                $storeWrcBatch = new CatalogWrcBatch();
                $storeWrcBatch->wrc_id = $wrc_id_is;
                $storeWrcBatch->batch_no = $batch_no;
                $storeWrcBatch->sku_count = $saved_rows;
                $storeWrcBatch->prequisites = $prequisites;
                $storeWrcBatch->save();
                DB::commit();
            }
            if ($storeWrcBatch) {
                request()->session()->flash('success', 'Wrc Batch Successfully added');
            } else {
                request()->session()->flash('error', 'Somthing went wrong!!Please try again!!');
            }
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('error', 'Somthing went wrong!!Please try again!!');
            // something went wrong
        }

        $catalog_Wrc_Batch_list = CatalogWrcBatch::catalog_Wrc_Batch_list();
        return redirect()->route('CatalogWrcBatch')->with('data_arr', $catalog_Wrc_Batch_list);

    }
}
