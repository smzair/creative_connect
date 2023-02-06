<?php

namespace App\Http\Controllers;

use App\Mail\NotifyUsers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* Send notification email to a list of users
    @param $data: Data to be passed to the NotifyUsers email view
    */
    public function send_notification($data, $creation_type){

        $users = ['evdt.rajesh@gmail.com', 'rajesh.rahangdale@tevince.com'];
        $notification_data = $data;
        $subject = '';
      
        // send notification subject 
        $subject = [
            'Lot' => 'Lot Created Successfully',//subject when generate lot
            'Wrc' => 'Wrc Created Successfully',//subject when generate wrc
            'WrcAllocation' => 'Wrc Allocation Started Successfully',//subject when allocation start
            'completeTaskInUpload' => 'Tasking Done and ready for qc',//subject when allocation done 
            'Qc' => 'Qc Done and ready for submission',//subject when qc completed
            'CatlogLot' => 'Lots Catalog Successfully added'//subject when generate catlog lot
        ][$creation_type] ?? '';
        
        // send mail to user
        Mail::to($users)->send(new NotifyUsers($notification_data, $creation_type, $subject));

    }
}
