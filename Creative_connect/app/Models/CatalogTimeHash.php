<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogTimeHash extends Model
{
    use HasFactory;
    protected $table = 'catalog_time_hash';
    protected $fillable = [
        'allocation_id', 'start_time' , 'end_time'
    ];

    public static function set_tast_start($allocation_id, $start_time){

        $time_has_id = CatalogTimeHash::where('allocation_id', $allocation_id)->get(['id'])->first();
        $allocated_time_has_id = $time_has_id != null ?  $time_has_id->id : 0;

        // dd($allocated_time_has_id);

        if ($allocated_time_has_id > 0) {
            $storeData = CatalogTimeHash::find($allocated_time_has_id);
            $storeData->start_time = $start_time;
            $storeData->is_rework = 0;
            $status = $storeData->update();
        }else{
            $CatalogTimeHash = new CatalogTimeHash();
            $CatalogTimeHash->allocation_id = $allocation_id;
            $CatalogTimeHash->start_time = $start_time;
            $CatalogTimeHash->end_time = '';
            $CatalogTimeHash->task_status = 0;
            $CatalogTimeHash->is_rework = '';
            $CatalogTimeHash->rework_count = '';
            $CatalogTimeHash->spent_time  = 0;
            $status = $CatalogTimeHash->save();
        }
        return $status;
    }
}
