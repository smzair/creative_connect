<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogQcCommentsTable extends Model
{
    use HasFactory;
    protected $table = 'catalog_qc_comment';
    protected $fillable = [
        'allocation_id', 'comments'
    ];


    

}
