<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeUploadLink extends Model
{
    use HasFactory;
    /**
	* The database table used by the model.
	*
	* @var string
	*/
    protected $table = 'creative_upload_links';
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable=['allocation_id', 'creative_link', 'copy_link'];
}
