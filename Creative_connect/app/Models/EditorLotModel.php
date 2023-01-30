<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorLotModel extends Model
{
    use HasFactory;
    protected $table = 'editor_lots';
    protected $fillable=['user_id', 'brand_id', 'lot_number', 'request_name'];

    
}
