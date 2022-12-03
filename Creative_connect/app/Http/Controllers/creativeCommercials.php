<?php

namespace App\Http\Controllers;

use App\Models\create_commercial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class creativeCommercials extends Controller
{
    // Index FUNCTION
    public function Index()
    {
        $commercial_data = (object) [
            'id' => '0',
            'user_id' => '',
            'brand_id' => '',
            'project_name' => '',
            'kind_of_work' => '',
            'per_qty_value' => '',
        ];

        $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
        return view('commercial.Creative-commercials')->with('users_data', $users_data)->with('commercial_data', $commercial_data);
    }
    // view Commercial list
    public function View()
   {

        // $commercial_list = DB::table('create_commercial')
        // ->leftJoin('users', ' users.id' , '=', 'create_commercial.user_id')
        // ->leftJoin('brands', 'brands.id', '=', 'create_commercial.brand_id')
        // ->get('create_commercial.user_id','create_commercial.brand_id','create_commercial.project_name', 'create_commercial.kind_of_work', 'create_commercial.per_qty_value', 'users.Company' , 'brands.name' );


        // $commercial_list = DB::table('create_commercial')
        // ->leftJoin('brands', 'brands.id', '=', 'create_commercial.brand_id')
        // ->get('create_commercial.id','create_commercial.user_id', 'create_commercial.brand_id', 'create_commercial.project_name', 'create_commercial.kind_of_work', 'create_commercial.per_qty_value', 'brands.name');

        // print_r($commercial_list);
        $commercial_list = create_commercial::get();
        // dd($commercial_list);
        $num = 1;
       return view('commercial.Creative_commercialView')->with('com', $commercial_list)->with('num',$num);
   }

    // create function for save and update Commercial
    public function create(Request $request)
    {
        $id = $request->id;
        $btn_val = $request->save;
        $user_id = $request->user_id;
        $brand_id = $request->brand_id;
        $project_name = $request->project_name;
        $kind_of_work = $request->kind_of_work;
        $per_qty_value = $request->per_qty_value;

        $create_commercial = new create_commercial();

        if ($id > 0) {
            // update
        } else {
            // insert
            $create_commercial->user_id = $user_id;
            $create_commercial->brand_id = $brand_id;
            $create_commercial->project_name = $project_name;
            $create_commercial->kind_of_work = $kind_of_work;
            $create_commercial->per_qty_value = $per_qty_value;
            $status = $create_commercial->save();
            if ($status) {

                if ($btn_val == 1) {
                    request()->session()->flash('success', 'Commercial Successfully added');
                    $commercial_data = (object) [
                        'id' => '0',
                        'user_id' => '',
                        'brand_id' => '',
                        'project_name' => '',
                        'kind_of_work' => '',
                        'per_qty_value' => '',
                    ];
                }

                if ($btn_val == 2) {
                    request()->session()->flash('success', 'Commercial Successfully added Add new');
                    $commercial_data = (object) [
                        'id' => $id,
                        'user_id' => $user_id,
                        'brand_id' => $brand_id,
                        'project_name' => '',
                        'kind_of_work' => '',
                        'per_qty_value' => '',
                    ];
                }
            }
            if (!$status) {
                request()->session()->flash('false', 'Commercial Successfully added');
                $commercial_data = (object) [
                    'id' => $id,
                    'user_id' => $user_id,
                    'brand_id' => $brand_id,
                    'project_name' => '',
                    'kind_of_work' => '',
                    'per_qty_value' => '',
                ];
            }
            $users_data = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);
            // dd($users_data);
            // return redirect()->route('CREATECOM')->with('users_data', $users_data)->with('commercial_data', $commercial_data);
            // redirect()->back()->with('users_data', $users_data)->with('commercial_data', $commercial_data);
            return view('commercial.Creative-commercials')->with('users_data', $users_data)->with('commercial_data', $commercial_data);
        }
    }
}
