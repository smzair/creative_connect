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

    // ready for submission
    public function addCreativeSubmission(Request $request){
        $wrc_id = $request['wrc_id'];
        $batch_no = $request['batch_no'];
        $allocation_id_array = array();

        $creative_allocation = ModelsCreativeAllocation::where('wrc_id',$wrc_id)->where('batch_no',$batch_no)->get();
        foreach($creative_allocation as $ckey => $cdata){
            $allocation_id = $cdata['id'];
            array_push( $allocation_id_array , $allocation_id);

        }

            $check_task_status = true;
            foreach($allocation_id_array as $akey => $adata){
                $task_status_data = CreativeTimeHash::where('allocation_id',$adata)->orderBy('id','DESC')->first('task_status');
                $task_status =  $task_status_data != null ? $task_status_data->task_status : 0;
                if($task_status != 2){
                    $check_task_status = false;
                }
            }

            if($check_task_status){

                $subMissionIdData = CreativeSubmission::where('wrc_id',$wrc_id)->where('batch_no',$batch_no)->first('id');

                $sub_id = $subMissionIdData != null ? $subMissionIdData->id : 0;

                // dd( $sub_id );
                $submission_date = Carbon::now();

                if($sub_id == 0){
                    $creativeSubmission = new CreativeSubmission();
                    $creativeSubmission->wrc_id = $wrc_id;
                    $creativeSubmission->batch_no = $batch_no;
                    $creativeSubmission->submission_date =  $submission_date;
                    $creativeSubmission->save();
                }else{
                    $creativeSubmission =  CreativeSubmission::find($sub_id);
                    $creativeSubmission->wrc_id = $wrc_id;
                    $creativeSubmission->batch_no = $batch_no;
                    $creativeSubmission->submission_date =  $submission_date;
                    $creativeSubmission->update();
                }

                

                request()->session()->flash('success','Wrc Submitted Successfully');
                return $this->getCreativeSubmission($request);

            }else{
                request()->session()->flash('error','Uncompleted WRC - First complete WRC');
                return $this->getCreativeSubmission($request);
            }


    }
    
    // get data for submission done
    public function getDataForCreativeSubmissionDone(Request $request){
        $submissionList = CreativeSubmission::SubmissionDone() ;
        return view('Submission.creative-submission-done')->with('submissionList',$submissionList);
    }

    // submission done
    public function addCreativeSubmissionDone(Request $request){

        $creative_submissions_id = $request['creative_submissions_id'];
        
        if( $creative_submissions_id != null){
            $creativeSubmission =  CreativeSubmission::find($creative_submissions_id);
            $creativeSubmission->Status =  1;
            $creativeSubmission->update();
            request()->session()->flash('success','Wrc Submitted Successfully');
            return $this->getDataForCreativeSubmissionDone($request);
        }else{
            request()->session()->flash('error','Something Went wrong');
                return $this->getDataForCreativeSubmissionDone($request);
        }

    }
}
