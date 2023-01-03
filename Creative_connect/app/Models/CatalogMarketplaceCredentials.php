<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogMarketplaceCredentials extends Model
{
    use HasFactory;
    protected $table = 'catalog_marketplace_credentials';

    protected $fillable = [
        'marketplace_id', 'commercial_id', 'link', 'username', 'password'
    ];
}
