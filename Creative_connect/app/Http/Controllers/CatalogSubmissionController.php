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
}
