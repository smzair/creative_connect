<?php

namespace App\Models;

use Google\Service\Directory\Role;
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
		
		$login_user_id = 51;//login user id CW
		// $login_user_id = 10;//login user id GD

		$resData = CreativeAllocation::orderBy('creative_allocation.user_id', 'DESC')
		->leftJoin('creative_upload_links', 'creative_upload_links.allocation_id','creative_allocation.id')
		->leftJoin('creative_time_hash', 'creative_time_hash.allocation_id', 'creative_upload_links.allocation_id')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('create_commercial', 'create_commercial.id','creative_wrc.commercial_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->leftJoin('brands', 'brands.id','creative_lots.brand_id')
		->select('creative_allocation.*','creative_allocation.id as  creative_allocation_id','creative_wrc.wrc_number','creative_wrc.lot_id','creative_wrc.work_brief','creative_wrc.guidelines','creative_wrc.document1','creative_wrc.document2','creative_wrc.order_qty','creative_wrc.alloacte_to_copy_writer','creative_lots.lot_number','users.name','users.Company as company_name','brands.name as brand_name','create_commercial.project_name', 'create_commercial.kind_of_work','creative_upload_links.allocation_id as creative_upload_links_allocation_id','creative_upload_links.creative_link','creative_upload_links.copy_link',DB::raw('GROUP_CONCAT(creative_time_hash.spent_time) as spent_time_data') )
		->where('creative_allocation.user_id',$login_user_id)
		->groupBy('creative_allocation.wrc_id')
		->get();

		// Graphic Designer  list
        $graphic_designer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', 15]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);   

        // dd(dump($graphic_designer_users_data));

        $copy_writer_users_data = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([ ['users.Company' ,'<>' ,NULL], ['model_has_roles.role_id','=', 16]])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

        // dd(dump($copy_writer_users_data));

        $gd_user_id_data = [];
        $cw_user_id_data = [];
		$role = '';

        foreach($graphic_designer_users_data as $key => $val){
            array_push($gd_user_id_data,$val->id);
			if($val->id == $login_user_id){
				$role = 'GD';
			}
        }

        foreach($copy_writer_users_data as $ckey => $cval){
            array_push($cw_user_id_data,$cval->id);
			if($cval->id == $login_user_id){
				$role = 'CD';
			}
        }
		
		foreach($resData as $key => $val){
			$gd_user_with_wrc = DB::table('creative_allocation')->where('creative_allocation.wrc_id',$val['wrc_id'])
			->leftJoin('users', 'users.id','creative_allocation.user_id')
			->whereIn('users.id', $gd_user_id_data)
			->groupBy('users.id')
			->where('users.name', '!=', null)
			->select('users.name')->get();
			$val['gd_user_with_wrc'] = $gd_user_with_wrc;

			$cw_user_with_wrc = DB::table('creative_allocation')->where('creative_allocation.wrc_id',$val['wrc_id'])
			->leftJoin('users', 'users.id','creative_allocation.user_id')
			->whereIn('users.id', $cw_user_id_data)
			->groupBy('users.id')
			->where('users.name', '!=', null)
			->select('users.name')->get();
			$val['cw_user_with_wrc'] = $cw_user_with_wrc;

			// $val['role'] = $role;

			$creative_time_hash = CreativeTimeHash::where('allocation_id',$val['creative_allocation_id'])->get(['start_time','end_time','task_status','is_rework'])->first();

			$start_time = $creative_time_hash != NULL ?  $creative_time_hash->start_time : '0000-00-00 00:00:00';
			$end_time = $creative_time_hash != NULL ?  $creative_time_hash->end_time : '0000-00-00 00:00:00';
			$task_status = $creative_time_hash != NULL ?  $creative_time_hash->task_status : 0;
			$is_rework = $creative_time_hash != NULL ?  $creative_time_hash->is_rework : 'NULL';
			$val['start_time'] = $start_time; 
			$val['end_time'] = $end_time; 
			$val['task_status'] = $task_status; 
			$val['is_rework'] = $is_rework; 

			// $interval = $end_time->diff($start_time);
			// $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');

			// $val['time_spent'] = date_diff($end_time,$start_time);
		} 
		$finalRespone = [
			'resData' => $resData,
			'role' => $role
		];

		// dd($finalRespone);
		return $finalRespone;
	}

	
}
