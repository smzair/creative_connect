<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeWrcModel extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'creative_wrc';
    protected $fillable = ['lot_id', 'wrc_number', 'commercial_id', 'order_qty', 'work_brief', 'guidelines', 'document1', 'document2', 'status'];
}
