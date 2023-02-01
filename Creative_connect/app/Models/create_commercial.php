<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class create_commercial extends Model
{
    use HasFactory;
    protected $fillable = [
       'id', 'user_id', 'brand_id', 'project_name', 'kind_of_work', 'per_qty_value',
    ];

    protected $table = 'create_commercial';
}
