<?php

namespace App\Http\Controllers;

use App\Models\CatalogUploadedMarketplaceCount;
use Illuminate\Http\Request;

class CatalogUploadedMarketplaceCountController extends Controller
{
    // get_uploaded_Marketplace_count

    function get_uploaded_Marketplace_count(Request $request)
    {
        $allocation_id = $request->allocation_id;
        $market_place = $request->market_place;
        echo $response = CatalogUploadedMarketplaceCount::get_uploaded_Marketplace_count($allocation_id, $market_place);
    }

    // Get Marketplace count in Submission panel
    function get_sub_Marketplace_count(Request $request)
    {
        $allocation_ids = $request->allocation_ids;
        $market_place = $request->market_place;
        echo $response = CatalogUploadedMarketplaceCount::get_sub_Marketplace_count($allocation_ids, $market_place);
    }

    

    // save Marketplace-approved-Count
    function save_Marketplace_approved_Count(Request $request)
    {
        echo $response = CatalogUploadedMarketplaceCount::save_Marketplace_approved_Count($request);
    }
        
}
