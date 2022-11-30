<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\reportmail;
class SendReportmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $time = time();
        $date = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time) - 1 ,date("Y", $time))); 

        $reportdata = [  
            'date'=>$date,
        'brand' => count(Brands::whereDate('created_at', $date)->get()),
        'brandtouser' => count(brands_user::whereDate('created_at', $date)->get()),
        'user' => count(User::whereDate('created_at', $date)->get()),
        'com' => count(Commercials::whereDate('created_at', $date)->get()),
        'lots' => count(Lots::whereDate('created_at', $date)->get()),
        'acceptance' => count(Wrc::whereDate('updated_at', $date)->where('status','=','ready_for_plan')->get()),
        'wrc'  => count(Wrc::whereDate('created_at', $date)->get()),
        'skus' => count(Skus::whereDate('created_at', $date)->get()),
        'plan' => count(Dayplan::whereDate('created_at', $date)->get()),
        'planwrc' => count(planDate::whereDate('created_at', $date)->get()),
        'rawimg' => count(uploadraw::whereDate('created_at', $date)->get()),
        'editorallocated' => count(allocation::whereDate('created_at', $date)->get()),
        'editorSubmission' => count(editorSubmission::whereDate('created_at', $date)->get()),
        'qc' => count(editorSubmission::whereDate('updated_at', $date)->where('qc','=','1')->get()),
        'brands' => count(brands_user::pending()),
        'Commercials' => count(Commercials::pending()),
        'Lots' => count(Lots::pending()),
        'Wrcs' => count(Wrc::pending()),
        'pendingplan' => count(planDate::pending()),
        'pendingsku' => count(planDate::skupending()),
        'uploadrawpending' => count(uploadraw::pending()),
        'pendallocation' => count(allocation::pending()),
        'pendingfromediting' => count(editorSubmission::pending()),
        'qcpending' => count(editorSubmission::where('qc','=','0')->get())
];
    $users= ['zair.s@odndigital.com','odndigital@gmail.com','vipan.s@odndigital.com','kumar.udaar@odndigital.com','nishant.kumar@odndigital.com','vishal.d@odndigital.com','studio@odndigital.com','','abhishek.j@odndigital.com','sandeep.n@odndigital.com','vinod.sharma@odndigital.com','neetu.b@odndigital.com','pankaj.g@odndigital.com'];
    
    Mail::to($users)->send(new reportmail($reportdata));
    }
}
