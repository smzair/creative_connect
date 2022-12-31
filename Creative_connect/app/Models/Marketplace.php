<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marketplace extends Model
{
    use HasFactory;
    protected $table = 'marketplaces';

    protected $fillable = [
        'id', 'marketPlace_name', 'link', 'username', 'password'
    ];

    public static function marketplace_Credentials_List($commercial_id, $market_place_ids){
        $market_place_ids = explode(',', $market_place_ids);
        $response = Marketplace::whereIn('id', $market_place_ids)->
        select('id', 'marketPlace_name', 'link', 'username', 'password')->
        get()->toArray();
        return $response;
    }

    public static function save_wrc_Credentials($data_arr)
    {
        $res_arr = [];
        $response = 0;
        try {
            DB::beginTransaction();
            foreach ($data_arr as $data) {
                $id = $data['marketPlace_id'];
                $link = $data['link'];
                $username = $data['username'];
                $password = $data['password'];
                // echo "<br> marketPlace_id => $marketPlace_id ,  link => $link ,  username => $username ,  password => $password ,  ";

                $storeData = Marketplace::find($id);
                $storeData->link = $link;
                $storeData->username = $username;
                $storeData->password = $password;
                $update_status = $storeData->update();
                array_push($res_arr, $update_status);
            }

            if(array_sum($res_arr) == count($res_arr)){
                DB::commit();
                $response = 1;
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }    
        return $response;
    }


}
