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
}
