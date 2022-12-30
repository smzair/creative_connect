<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreativeAllocation as ModelsCreativeAllocation;
use App\Models\CreativeQcComments;
use App\Models\CreativeTimeHash;
use App\Models\CreativeUploadLink as ModelsCreativeUploadLink;
use App\Models\CreativeWrcModel;
use App\Models\CreativeSubmission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreativeSubmissionController extends Controller
{
    public function getCreativeSubmission(Request $request){
        $submissionList = CreativeSubmission::readyForSubmission() ;
        return view('Submission.creative-ready-for-submission')->with('submissionList',$submissionList);
    }
}
