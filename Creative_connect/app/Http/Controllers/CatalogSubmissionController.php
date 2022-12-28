<?php

namespace App\Http\Controllers;

use App\Models\CatalogSubmission;
use App\Models\CatlaogQc;
use Illuminate\Http\Request;

class CatalogSubmissionController extends Controller
{
    /*** Display a listing of the resource. */
    public function index()
    {
        // dd('fdsfkg');
        $catalog_Wrc_list_for_Submission = CatalogSubmission::catalog_Wrc_list_for_Submission();
        // dd($catalog_Wrc_list_for_Submission);
        return view('Submission.catalog-submission')->with('catalog_Wrc_list_for_Submission', $catalog_Wrc_list_for_Submission);
    }
    
    
    public function comp_submission(Request $request){
        $wrc_id = $request->wrc_id;
        $catalog_allocation_ids = $request->catalog_allocation_ids;
        $submission_date = date('Y-m-d');
        echo $responce = CatalogSubmission::comp_submission($wrc_id, $submission_date, $catalog_allocation_ids);

    }
}
