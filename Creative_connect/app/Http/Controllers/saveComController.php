<?php

namespace App\Http\Controllers;

use App\Models\create_commercial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class saveComController extends Controller
{
    public function create(Request $request)
    {

        // echo $request->all();
        // dd($request->all());
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
            // return redirect()->back()->with('success', 'Student Saved');
            // dd($status);
            if ($status && $btn_val == 1) {
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
            if ($status && $btn_val == 2) {
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
            return view('commercial.Creative-commercials')->with('users_data', $users_data)->with('commercial_data', $commercial_data);
            // return view('commercial.Creative-commercials')->with('commercial_data', $commercial_data);
        }
    }
}
