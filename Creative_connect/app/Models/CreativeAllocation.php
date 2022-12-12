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

	public static function GetCreativeAllocation(){

		$resData = CreativeAllocation::orderBy('creative_allocation.id', 'DESC')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->select('creative_allocation.*','creative_wrc.wrc_number','creative_wrc.lot_id','creative_lots.lot_number','users.name',DB::raw('sum(creative_allocation.allocated_qty) as allocated_qty'))
		->groupBy('creative_allocation.user_id','creative_allocation.wrc_id')
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
	
}
