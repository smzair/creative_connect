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

        $CatalogTimeHash = new CatalogTimeHash();
        $CatalogTimeHash->allocation_id = $allocation_id;
        $CatalogTimeHash->start_time = $start_time;
        $CatalogTimeHash->end_time = '';
        $status = $CatalogTimeHash->save();
        return $status;
    }
}
