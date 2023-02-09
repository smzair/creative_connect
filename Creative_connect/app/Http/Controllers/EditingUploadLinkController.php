<?php

namespace App\Http\Controllers;

use App\Models\EditingAllocation;
use App\Models\EditingUploadLink;
use Illuminate\Http\Request;

class EditingUploadLinkController extends Controller
{

    // show Editing allocation upload blade
    function upload()
    {
        $login_user_id_is = 11;
        $user_role = 'Editor';
        $allocationList = EditingAllocation::get_Editing_Allocation_List($login_user_id_is);
        $allocated_wrc_list_by_user = EditingAllocation::allocated_wrc_list_by_user($login_user_id_is);
        return view('Allocation.editing_upload_panel')->with('allocationList', $allocationList)->with('user_role', $user_role)->with('login_user_id_is', $login_user_id_is);
    }

    // Save And Update Link
    function Editing_upload_link(Request $request)
    {
        $response = EditingUploadLink::Editing_upload_link($request);
        echo json_encode($response);
    }

    // get Editing uploaded link 
    function get_Editing_Uploaded_link(Request $request)
    {
        $allocation_id = $request->allocation_id;
        $response = EditingUploadLink::get_editing_uploaded_link($allocation_id);
        if ($response == 0) {
            echo $response;
        } else {
            echo json_encode($response);
        }
    }
}
