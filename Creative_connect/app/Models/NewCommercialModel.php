<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCommercialModel extends Model
{
    use HasFactory;

    protected $table = 'new_commercials';

    protected $fillable = [
        'id', 
        'commCompanyId', 
        'commBrandId',
        'commClientID',
        'c_short',
        'short_name',
        'commshootcheck',
        'commcgcheck',
        'commcatcheck',
        'shootCheckIsDone',
        'cgCheckIsDone',
        'catCheckIsDone'
    ];

    // Save New Commercial into Db
    public static function createNewCommercial($request){
        $commCompanyId = $request->commCompanyId;
        $commBrandId = $request->commBrandId;
        $c_short = $request->c_short;
        $short_name = $request->short_name;
        $commClientID = $request->commClientID;
        $commshootcheck = request()->has('commshootcheck') ? $request->commshootcheck : 0;
        $commcgcheck = request()->has('commcgcheck') ? $request->commcgcheck : 0;
        $commcatcheck = request()->has('commcatcheck') ? $request->commcatcheck : 0;

        $shootCheckIsDone = $commshootcheck > 0 ? 1 : 0;
        $cgCheckIsDone = $commcgcheck > 0 ? 1 : 0;
        $catCheckIsDone = $commcatcheck > 0 ? 1 : 0;

        $createNewCommercial = new NewCommercialModel();
        $createNewCommercial->commCompanyId = $commCompanyId;
        $createNewCommercial->commBrandId = $commBrandId;
        $createNewCommercial->c_short = $c_short;
        $createNewCommercial->short_name = $short_name;
        $createNewCommercial->commClientID = $commClientID;
        $createNewCommercial->commshootcheck = $commshootcheck;
        $createNewCommercial->commcgcheck = $commcgcheck;
        $createNewCommercial->commcatcheck = $commcatcheck;
        $createNewCommercial->shootCheckIsDone = $shootCheckIsDone;
        $createNewCommercial->cgCheckIsDone = $cgCheckIsDone;
        $createNewCommercial->catCheckIsDone = $catCheckIsDone;
        $status = $createNewCommercial->save();

        if($status){
            $createNewCommercialIdIs = $createNewCommercial->id;
        }else{
            $createNewCommercialIdIs = 0;
        }
        return $createNewCommercialIdIs;
    }

    // update New Commercial into Db
    public static function updateNewCommercial($request)
    {
        $id = $request->id;
        $commCompanyId = $request->commCompanyId;
        $commBrandId = $request->commBrandId;
        $c_short = $request->c_short;
        $short_name = $request->short_name;
        $commClientID = $request->commClientID;
        $commshootcheck = request()->has('commshootcheck') ? $request->commshootcheck : 0;
        $commcgcheck = request()->has('commcgcheck') ? $request->commcgcheck : 0;
        $commcatcheck = request()->has('commcatcheck') ? $request->commcatcheck : 0;
        $shootCheckIsDone = $commshootcheck > 0 ? 1 : 0;
        $cgCheckIsDone = $commcgcheck > 0 ? 1 : 0;
        $catCheckIsDone = $commcatcheck > 0 ? 1 : 0;

        $createNewCommercial =  NewCommercialModel::find($request->id);
        $createNewCommercial->commCompanyId = $commCompanyId;
        $createNewCommercial->commBrandId = $commBrandId;
        $createNewCommercial->c_short = $c_short;
        $createNewCommercial->short_name = $short_name;
        $createNewCommercial->commClientID = $commClientID;
        $createNewCommercial->commshootcheck = $commshootcheck;
        $createNewCommercial->commcgcheck = $commcgcheck;
        $createNewCommercial->commcatcheck = $commcatcheck;
        $createNewCommercial->shootCheckIsDone = $shootCheckIsDone;
        $createNewCommercial->cgCheckIsDone = $cgCheckIsDone;
        $createNewCommercial->catCheckIsDone = $catCheckIsDone;
        $status = $createNewCommercial->update();

        if ($status) {
            $createNewCommercialIdIs = $id;
            request()->session()->flash('success', 'Commercial Successfully Updated!!');
        } else {
            $createNewCommercialIdIs = 0;
            request()->session()->flash('false', 'Somthing went wrong try again!!!');
        }
        return $createNewCommercialIdIs;
    }

    // store new Shoot Commercial
    public static function saveShootCommercial($request)
    {

    }
    // store new Creative Commercial
    public static function SaveCreativeCommercial($request)
    {
        $newCommercialId = $request->newCommercialId;
        $id = $request->id;
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $project_name = $request->commProjectName;
        $kind_of_work = $request->commWorkType;
        $per_qty_value = $request->commQty;
        $create_commercial = new create_commercial();

        $create_commercial->user_id = $user_id;
        $create_commercial->brand_id = $brand_id;
        $create_commercial->project_name = $project_name;
        $create_commercial->kind_of_work = $kind_of_work;
        $create_commercial->per_qty_value = $per_qty_value;
        $create_commercial->newCommercialId = $newCommercialId;
        $status = $create_commercial->save();

        if ($status) {
            $createNewCommercial =  NewCommercialModel::find($newCommercialId);
            $createNewCommercial->cgCheckIsDone = 2;
            $upstatus = $createNewCommercial->update();
            $create_commercial_Id = $create_commercial->id;
        } else {
            $create_commercial_Id = 0;
        }
        return $create_commercial_Id;
    }
    // store new Cataloging Commercial
    public static function SaveCatalogingCommercial($request)
    {

        $newCommercialId = $request->newCommercialId;
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $market_place = implode(',', $request->market_place);
        $type_of_service = $request->commctseviceType;
        $CommercialSKU = $request->commUnit;

        // dd($request->all());

        $create_commercial = new CatalogCommercial();
        $create_commercial->user_id = $user_id;
        $create_commercial->brand_id = $brand_id;
        $create_commercial->market_place = $market_place;
        $create_commercial->type_of_service = $type_of_service;
        $create_commercial->CommercialSKU = $CommercialSKU;
        $status = $create_commercial->save();

        if ($status) {
            $createNewCommercial =  NewCommercialModel::find($newCommercialId);
            $createNewCommercial->catCheckIsDone = 2;
            $upstatus = $createNewCommercial->update();
            $create_Cataloging_Id = $create_commercial->id;
        } else {
            $create_Cataloging_Id = 0;
        }
        return $create_Cataloging_Id;
    }

}
