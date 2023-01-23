<?php

namespace App\Http\Controllers;

use App\Models\CatalogCommercial;
use App\Models\NewCommercialModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NewCommercial extends Controller
{
    //

    public function Index()
    {
        $newCommercial = (object) [
            'id' => 0,
            'user_id' => '0',
            'brand_id' => '0',
            'commClientID' => ''
        ];
        return view('commercial.newCommercial-panel')->with('newCommercial', $newCommercial);
    }

    // save newCommercial into db
    public function create(Request $request){

        $createNewCommercialIdIs = NewCommercialModel::createNewCommercial($request);

        if($createNewCommercialIdIs > 0){
            request()->session()->flash('success', 'Commercial  Successfully Added!!');
            return Redirect::route('EditNewCommercial', ['id' => $createNewCommercialIdIs]);
        }else{
            request()->session()->flash('false', 'Somthing went wrong try again!!!');
            return Redirect::route('NewCommercial');
        }

        // dd($createNewCommercialIdIs , $request->all());
    }

    // listing newCommercialList
    public function view(){

        $commercial_list = NewCommercialModel::leftJoin('brands', 'brands.id', '=', 'new_commercials.commBrandId')
            ->leftJoin('users', 'new_commercials.commCompanyId', 'users.id')
            ->select('new_commercials.id', 'new_commercials.*', 'users.Company as company', 'brands.name')
            ->get();
        $num = 1;
        return view('commercial.newCommercialList')->with('com', $commercial_list)->with('num', $num);

    }
}
