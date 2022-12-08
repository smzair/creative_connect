<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatlogWrc extends Model
{
    use HasFactory;
    protected $table = 'catlog_wrc';
    protected $fillable = [
       'lot_id','wrc_number','commercial_id','status','img_recevied_date','missing_info_notify_date','missing_info_recived_date','confirmation_date','work_brief','guidelines','document1','document2'
    ];

}
