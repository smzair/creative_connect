<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsolidatedLotController extends Controller
{
    //

    public function view(){
        $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([ ['users.Company' ,'<>' ,NULL], ['roles.name','=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
            // dd($users_data);

        $CreativeLots = (object) [
            'id'=>0,
            'user_id'=>'',
            'brand_id'=>''
        ];
        return view('consolidatedLot-Panel.Consolidated-Lot')->with(['CreativeLots'=>$CreativeLots, 'users_data'=> $users_data]);;
    }

    // consolidated lot create

    public function create(Request $request){
        
        dd($request);
        $c_short = $request->c_short;
        $short_name = $request->short_name;
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $cgcheck = isset($request->cgcheck) ?   $request->cgcheck : 0; // Creative Graphics
        $catcheck = isset($request->catcheck) ? $request->catcheck : 0; // Cataloging
        $shootcheck = isset($request->shootcheck) ?   $request->shootcheck : 0; // Shoot

        $cgcheck_val = $cgcheck == 0 ? 0 : 1; // Creative Graphics
        $catcheck_val = $catcheck == 0 ? 0 : 1; // Cataloging
        $shootcheck_val = $shootcheck == 0 ? 0 : 1;// Shoot

        // generate lot number 
        //  $lot_number = 'ODN' . date('dmY') ."-". $request->c_short . $request->short_name . $id;

        // dd(['shootcheck'=> $shootcheck_val, 'cgcheck'=> $cgcheck_val, 'catcheck'=>$catcheck_val]);

    }
}
