<?php

namespace App\Http\Controllers;

use App\Models\CatalogSubmission;
use Illuminate\Http\Request;

class CatalogInvoiceController extends Controller
{
    //

    public function index()
    {
        $tsak_status_is = 3; // catalog submission done
        $catalog_Wrc_list_for_Submission = CatalogSubmission::catalog_Wrc_For_Invoice($tsak_status_is);
        // dd($catalog_Wrc_list_for_Submission);
        return view('Invoice.catalog-Invoice')->with('catalog_Wrc_list_for_Submission', $catalog_Wrc_list_for_Submission);
    }

    public function SaveCatalogInvoiceNumber(Request $request)
    {
        // dd($request->all());
        echo $response = CatalogSubmission::SaveCatalogInvoiceNumber($request);
    }

    


}
