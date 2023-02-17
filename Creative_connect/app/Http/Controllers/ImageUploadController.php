<?php

namespace App\Http\Controllers;

use App\Models\EditingRawImgUpload;
use App\Models\EditingWrc;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function index()
    {
        $wrcs =  EditingWrc::OrderBy('editing_wrcs.updated_at', 'DESC')
        ->leftJoin('editor_lots', 'editor_lots.id', 'editing_wrcs.lot_id')
        ->leftJoin('editors_commercials', 'editors_commercials.id', 'editing_wrcs.commercial_id')
        ->leftJoin('users', 'users.id', 'editor_lots.user_id')
        ->leftJoin('brands', 'brands.id', 'editor_lots.brand_id')
        ->select(
            'editing_wrcs.*',
            'editing_wrcs.id as wrc_id',
            'editor_lots.user_id',
            'editor_lots.brand_id',
            'editor_lots.lot_number',
            'editors_commercials.type_of_service',
            'users.Company as Company_name',
            'brands.name'
        )->get()->toArray();
        return view('Imageupload.Editing-Wrc-RawImage-Upload')->with('wrcs', $wrcs);
    }

    // 
    public function EditingRawImageUpload(Request $request){
        $wrc_id = $request->wrcid;
        $lot_id = $request->lot_id;
        $lot_text = $request->lot_text;
        $wrc_text = $request->wrc_text;
        $uploded_count = 0;
        $exist_count = 0;
        $sendfiles = $request->file('sku_images');

        $EditingWrc = EditingWrc::where(['lot_id' => $lot_id, 'id' => $wrc_id])->first();
        $uploaded_img_qty = $EditingWrc->uploaded_img_qty;
        $file_path = $EditingWrc->file_path;
        if($file_path== '' || $file_path == null){
            $file_path = "editing_raw_img_uploads/" . date('Y') . "/" . date('M') . "/" . $lot_text . "/" . $wrc_text . "/" ;
        }
        $message = "Somthing Went Wrong";
        foreach ($sendfiles as $file) {
            $filename = $file->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $skutext = str_replace("." . $ext, "", $filename);
            $pos = strripos("$skutext", "_");
            $sku_code = substr($skutext, 0, $pos);
            $path = $file_path.$sku_code . "/";

            if (!file_exists($path . $filename)) {
                $is_saved = $file->move($path, $filename);
                if (file_exists($is_saved)){
                    $EditingRawImgUpload = new EditingRawImgUpload();
                    $EditingRawImgUpload->wrc_id = $wrc_id;
                    $EditingRawImgUpload->filename = $filename;
                    $EditingRawImgUpload->file_path = $path;
                    $EditingRawImgUpload->save();
                    $uploded_count++;
                    
                }
            }else{
                $exist_count++;
            }

            if ($uploded_count > 0) {
                $message = $uploded_count . " Image upload successfully!! ";
                if($exist_count > 0){
                    $message .= $exist_count . " Image Exist!!";
                }
            } else {

            }
        }
        if ($exist_count > 0  && $uploded_count == 0) {
            $message = $exist_count . " Image Exist!!";
        }
        

        $tot_uploaded_img_qty = $uploaded_img_qty + $uploded_count;
        $EditingWrc =  EditingWrc::find($wrc_id);
        $EditingWrc->uploaded_img_qty = $tot_uploaded_img_qty;
        $EditingWrc->file_path = $file_path;
        $status = $EditingWrc->update();

        $res_dat = array(
            "status" => $status,
            "message" => $message,
            "wrc_id" => $wrc_id,
            "uploded_count" => $uploded_count,
            "exist_count" => $exist_count,
            "tot_uploaded_img_qty" => $tot_uploaded_img_qty,
        );
        echo $response = json_encode($res_dat);
    }

}
