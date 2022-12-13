<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreativeAllocation extends Model
{
    use HasFactory;
    /**
	* The database table used by the model.
	*
	* @var string
	*/
    protected $table = 'creative_allocation';
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable=['wrc_id', 'user_id', 'allocated_qty'];

	//GetCreativeAllocation for view user detail
	public static function GetCreativeAllocation(){

		$resData = CreativeAllocation::orderBy('creative_allocation.user_id', 'DESC')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->select('creative_allocation.user_id','users.name')
		->groupBy('creative_allocation.user_id')
		->get();

		$resDataManyUser = CreativeAllocation::orderBy('creative_allocation.user_id', 'DESC')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->select('creative_allocation.*','creative_wrc.wrc_number','creative_wrc.lot_id','creative_lots.lot_number','users.name')
		->get();

		return [
            "resData"         => $resData,
            "resDataManyUser" => $resDataManyUser
         ];

	}

	//GetCreativeAllocation for view user detail
	public static function GetCreativeAllocationForUpload(){
		// $id = Auth::user()->id;
		
		$login_user_id = 50;
		$resData = CreativeAllocation::orderBy('creative_allocation.user_id', 'DESC')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->select('creative_allocation.*','creative_wrc.wrc_number','creative_wrc.lot_id','creative_lots.lot_number','users.name')
		->where('creative_allocation.user_id',$login_user_id)
		->get();
		// dd($resData);
		return $resData;
	}
	
}
