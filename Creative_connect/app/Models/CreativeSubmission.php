<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeSubmission extends Model
{
    use HasFactory;
    /**
	* The database table used by the model.
	*
	* @var string
	*/
    protected $table = 'creative_submissions';
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable=['wrc_id', 'submission_date'];

	public static function readyForSubmission(){
		$resData = CreativeTimeHash::orderBy('creative_time_hash.id','DESC')
		->leftJoin('creative_allocation', 'creative_allocation.id','creative_time_hash.allocation_id')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc_batch', function($join){
			$join->on('creative_wrc_batch.wrc_id', '=', 'creative_allocation.wrc_id');
			$join->on('creative_wrc_batch.batch_no', '=', 'creative_allocation.batch_no');
		})
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('create_commercial', 'create_commercial.id','creative_wrc.commercial_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->leftJoin('brands', 'brands.id','creative_lots.brand_id')
		->leftJoin('creative_upload_links', 'creative_upload_links.allocation_id','creative_allocation.id')
		->leftJoin('creative_submissions', function($join){
			$join->on('creative_submissions.wrc_id', '=', 'creative_allocation.wrc_id');
			$join->on('creative_submissions.batch_no', '=', 'creative_allocation.batch_no');
		})
		
		
		->select(
			'creative_upload_links.creative_link as creative_links',
			'creative_upload_links.copy_link as copy_links',
			'creative_time_hash.start_time as start_time',
			'users.Company as company_name',
			'brands.name as brand_name',
			'creative_lots.client_bucket',
			'creative_lots.lot_number',
			'creative_wrc.wrc_number',
			'create_commercial.project_name',
			'create_commercial.kind_of_work',
			'creative_wrc.order_qty',
			'creative_wrc.sku_count',
			'creative_wrc_batch.wrc_id as wrc_id',
			'creative_wrc_batch.batch_no as batch_no',
			'creative_wrc_batch.order_qty as batch_order_qty',
			'creative_wrc_batch.sku_count as batch_sku_count'
		)
		->where('creative_time_hash.task_status','=',2)
		->groupBy(['creative_wrc_batch.wrc_id','creative_wrc_batch.batch_no'])
		// ->where('creative_submissions.wrc_id','!=','creative_allocation.wrc_id')
		->get();
		// dd($resData);
		return $resData;
	}	

	public static function SubmissionDone(){
		$resData = CreativeTimeHash::orderBy('creative_time_hash.id','DESC')
		->leftJoin('creative_allocation', 'creative_allocation.id','creative_time_hash.allocation_id')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc_batch', function($join){
			$join->on('creative_wrc_batch.wrc_id', '=', 'creative_allocation.wrc_id');
			$join->on('creative_wrc_batch.batch_no', '=', 'creative_allocation.batch_no');
		})
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('create_commercial', 'create_commercial.id','creative_wrc.commercial_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->leftJoin('brands', 'brands.id','creative_lots.brand_id')
		->leftJoin('creative_upload_links', 'creative_upload_links.allocation_id','creative_allocation.id')
		->leftJoin('creative_submissions', function($join){
			$join->on('creative_submissions.wrc_id', '=', 'creative_allocation.wrc_id');
			$join->on('creative_submissions.batch_no', '=', 'creative_allocation.batch_no');
		})
		
		->select(
			'creative_upload_links.creative_link as creative_links',
			'creative_upload_links.copy_link as copy_links',
			'creative_time_hash.start_time as start_time',
			'users.Company as company_name',
			'brands.name as brand_name',
			'creative_lots.client_bucket',
			'creative_lots.lot_number',
			'creative_wrc.wrc_number',
			'create_commercial.project_name',
			'create_commercial.kind_of_work',
			'creative_wrc.order_qty',
			'creative_wrc.sku_count',
			'creative_wrc_batch.wrc_id as wrc_id',
			'creative_wrc_batch.batch_no as batch_no',
			'creative_wrc_batch.order_qty as batch_order_qty',
			'creative_wrc_batch.sku_count as batch_sku_count',
			'creative_submissions.id  as creative_submissions_id'
		)
		->where('creative_submissions.Status',1)
		// ->where('creative_submissions.wrc_id','=','creative_allocation.wrc_id')
		
		->get();
		// dd($resData);
		return $resData;
	}

	public static function ApprovalRejectionList(){
		$resData = CreativeTimeHash::orderBy('creative_time_hash.id','DESC')
		->leftJoin('creative_allocation', 'creative_allocation.id','creative_time_hash.allocation_id')
		->leftJoin('users', 'users.id','creative_allocation.user_id')
		->leftJoin('creative_wrc_batch', function($join){
			$join->on('creative_wrc_batch.wrc_id', '=', 'creative_allocation.wrc_id');
			$join->on('creative_wrc_batch.batch_no', '=', 'creative_allocation.batch_no');
		})
		->leftJoin('creative_wrc', 'creative_wrc.id','creative_allocation.wrc_id')
		->leftJoin('create_commercial', 'create_commercial.id','creative_wrc.commercial_id')
		->leftJoin('creative_lots', 'creative_lots.id','creative_wrc.lot_id')
		->leftJoin('brands', 'brands.id','creative_lots.brand_id')
		->leftJoin('creative_upload_links', 'creative_upload_links.allocation_id','creative_allocation.id')
		->leftJoin('creative_submissions', function($join){
			$join->on('creative_submissions.wrc_id', '=', 'creative_allocation.wrc_id');
			$join->on('creative_submissions.batch_no', '=', 'creative_allocation.batch_no');
		})
		
		->select(
			'creative_upload_links.creative_link as creative_links',
			'creative_upload_links.copy_link as copy_links',
			'creative_time_hash.start_time as start_time',
			'users.Company as company_name',
			'brands.name as brand_name',
			'creative_lots.client_bucket',
			'creative_lots.lot_number',
			'creative_wrc.wrc_number',
			'create_commercial.project_name',
			'create_commercial.kind_of_work',
			'creative_wrc.order_qty',
			'creative_wrc.sku_count',
			'creative_wrc_batch.wrc_id as wrc_id',
			'creative_wrc_batch.batch_no as batch_no',
			'creative_wrc_batch.order_qty as batch_order_qty',
			'creative_wrc_batch.sku_count as batch_sku_count',
			'creative_submissions.id  as creative_submissions_id'
		)
		->where('creative_submissions.Status',1)
		// ->where('creative_submissions.wrc_id','=','creative_allocation.wrc_id')
		
		->get();
		// dd($resData);
		return $resData;
	}

	public static function getCreativeWrcDetails(){

		$resData = [];
		$resData =  CreativeWrcModel::OrderBy('creative_wrc.id','ASC')
       ->leftJoin('creative_lots', 'creative_lots.id', 'creative_wrc.lot_id')
       ->leftJoin('users', 'users.id', 'creative_lots.user_id')
       ->leftJoin('brands', 'brands.id', 'creative_lots.brand_id')
       ->select('creative_wrc.*','creative_lots.user_id','creative_lots.brand_id','creative_lots.lot_number','users.Company as Company_name','brands.name','creative_lots.client_bucket')
       ->get();
        // dd($resData);
		return $resData;
	}
}
