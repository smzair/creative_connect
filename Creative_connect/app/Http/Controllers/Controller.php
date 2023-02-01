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

        //send  notification when generate lot
        if($creation_type == 'Lot'){
            $notification_data = $data;
            $subject = 'Lot Created Successfully';
            Mail::to($users)->send(new NotifyUsers($notification_data, $creation_type, $subject));
        }
        //send notification when generate wrc
        if($creation_type == 'Wrc'){
            $notification_data = $data;
            $subject = 'Wrc Created Successfully';
            Mail::to($users)->send(new NotifyUsers($notification_data, $creation_type, $subject));
        }

    }
}
