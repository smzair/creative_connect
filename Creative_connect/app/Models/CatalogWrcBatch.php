<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogWrcBatch extends Model
{
    use HasFactory;

    protected $table = 'catalog_wrc_batches';
    protected $fillable = [
        'wrc_id', 'batch_no', 'sku_count'
    ];
}
