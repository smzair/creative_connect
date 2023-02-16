<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editing Wrc Master Sheet</title>
    <style>
        .td_class{
            padding: 0px 10px;
        }
        .td_class1{
            /* padding: 0px 20px; */
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-12">
           
            <table class="table table-bordered">
                 <thead>
                    <tr>
                        <th class="td_class">Sr. No.</th>
                        <th class="td_class">Company Name</th>
                        <th class="td_class">Brand Name</th>
                        <th class="td_class">Sample Inward Date</th>
                        <th class="td_class">Sample Inward Month</th>
                        <th class="td_class">Ageing</th>
                        <th class="td_class">Lot No</th>
                        <th class="td_class">Lot Inward Quantity</th>
                        <th class="td_class">WRC No.</th>
                        <th class="td_class">WRC Count</th>
                        <th class="td_class">WRC Inward Quantity</th>
                        <th class="td_class">WRC Pending At.</th>
                        <th class="td_class">Type of Service</th>
                        <th class="td_class">Editing Hand Over Date</th>
                        <th class="td_class">Spoc Email</th>
                        <th class="td_class">TAT Start Date</th>
                        <th class="td_class">TAT Ageing</th>
                        <th class="td_class">TAT Start to Ediiting Ageing</th>
                        <th class="td_class">Ediiting TAT Status</th>
                        <th class="td_class">Ediiting to Submission Ageing</th>
                        <th class="td_class">TAT End Date</th>
                        <th class="td_class">TAT Status</th>
                        <th class="td_class">Client Rejection</th>
                        <th class="td_class">Wrc Status</th>
                        <th class="td_class">Submission Date</th>
                        <th class="td_class">Submission Qty</th>
                        <th class="td_class">Invoice Number</th>
                        <th class="td_class">Per SKU Commercial</th>
                        <th class="td_class">Expected Commercial</th>
                        <th class="td_class">Actual Commercial</th>
                    </tr>
                </thead>
                <tbody >
                    @php

                        function date_dMY($date)
                        {
                            return date('d-M-Y', strtotime($date));
                        }

                        function monthName($date)
                        {
                            return date('F', strtotime($date));
                        }
                        $sn = 1;

                        // pre($EditingWrcMasterList);
                        $all_lot_arr = array_column($EditingWrcMasterList, 'lot_id');
                        $wrc_imgqty_arr = array_column($EditingWrcMasterList,'imgqty');
                        $lot_wise_lot_wrc_data = [];
                    @endphp
                    @foreach ($EditingWrcMasterList as $row_key => $row)
                        @php                            
                            $submission_id =$row['submission_id'];
                            $submission_ar_status =$row['submission_ar_status'];
                            $submission_date =$row['submission_date'];
                            $wrc_created_at = date_dMY($row['wrc_created_at']);
                            $wrc_id_is = $row['wrc_id_is'];
                            $imgqty = $row['imgqty'];
                            $editor_sum = $row['editor_sum'];
                            $allocation_created_at = $row['allocation_created_at'];
                            $link_updated_at = $row['link_updated_at'];
                            $work_initiate_date = $row['work_initiate_date'];
                            $work_committed_date =$row['work_committed_date'];
                            $lot_id =$row['lot_id'];

                            $date1=date_create(date('Y-m-d'));
                            if($submission_id > 0){
                                $date1=date_create($submission_date);
                            }
                            $date2=date_create($wrc_created_at);
                            $diff=date_diff($date1,$date2);
                            $wrcAgeing = $diff->format("%a");

                            if (!array_key_exists($lot_id,$lot_wise_lot_wrc_data))
                            {
                                $lot_wrc_data = get_lot_wrc_data($lot_id);
                                $lot_wise_lot_wrc_data[$lot_id] = $lot_wrc_data[0];
                            }
                            $wrc_count = $lot_wise_lot_wrc_data[$lot_id]['wrc_count'];
                            $wrc_inward_qty = $lot_wise_lot_wrc_data[$lot_id]['wrc_inward_qty'];

                            $wrc_panding_at = "Alllocation Pending";
                            $allocation_ids = $row['allocation_ids'];
                            $uploading_task_status = $row['uploading_task_status'];
                            if($editor_sum == $imgqty){
                                $wrc_panding_at = "Uploading Pending";

                                $allocation_id_arr = explode(",",$allocation_ids);                                
                                $tot_allocation_ids = count($allocation_id_arr);

                                $task_status_arr = explode(',',$uploading_task_status);
                                $task_status_sum = array_sum($task_status_arr);

                                if($task_status_sum == $tot_allocation_ids){
                                    $wrc_panding_at = "Submission Pending";
                                }else if($task_status_sum == (2*$tot_allocation_ids)){
                                    if($row['invoice_number'] == ''){
                                        $wrc_panding_at = "Invoice Pending";
                                    }else{
                                       
                                        if($submission_id > 0){
                                            if($submission_ar_status > 0){
                                                $wrc_panding_at = "Completed";
                                            }else{
                                                $wrc_panding_at = "Client Feedback Pending";
                                            }
                                        }
                                    }
                                }
                            }

                            $allocation_created_at_arr = explode(",",$allocation_created_at);
                            $tot_times = count($allocation_created_at_arr);
                            if($tot_times > 0){
                                foreach ($allocation_created_at_arr as $key => $date) {
                                    if($key == 0){
                                        $last_allocated_date = $date;
                                    }else{
                                        // echo "<br> $wrc_id ->  initial_start_time  $initial_start_time  , date => $date  ||||";
                                        if($last_allocated_date < $date){
                                            $last_allocated_date = $date;
                                        }
                                    }
                                }
                            }else{
                                $last_allocated_date = "-";
                            }

                            $submission_date_is = $submission_date != '' && $submission_date != null && $submission_date != '0000-00-00' ? date_dMY($submission_date) : '' ;
                            $submission_month = $submission_date != '' && $submission_date != null && $submission_date != '0000-00-00' ? date('F' , strtotime($submission_date)) : 'Not Submitted' ;

                            $work_initiate_date_is = $work_initiate_date != '' && $work_initiate_date != null && $work_initiate_date != '0000-00-00' ? $work_initiate_date : '' ;
                            $work_committed_date_is = $work_committed_date != '' && $work_committed_date != null && $work_committed_date != '0000-00-00' ? $work_committed_date : '' ;

                            $tat_start_to_uploading_date = "-";
                            if($work_initiate_date_is != ''){
                                $date1=date_create(date('Y-m-d'));
                                $tat_work_initiate_date = $date2=date_create($work_initiate_date_is);
                                $diff=date_diff($date1,$date2);
                                $tatAgeing = $diff->format("%a");
                                $tatStartDate = date_dMY($work_initiate_date_is);

                                $link_updated_at_arr = explode(",",$link_updated_at);
                                $tot_uploaded_link = count($link_updated_at_arr);
                                if($tot_uploaded_link > 0){
                                    foreach ($link_updated_at_arr as $key => $date) {
                                        if($key == 0){
                                            $tat_start_to_uploading_date = $date;
                                        }else{
                                            if($tat_start_to_uploading_date < $date){
                                                $tat_start_to_uploading_date = $date;
                                            }
                                        }
                                    }
                                    $tat_start_to_uploading_date = date_create(date_dMY($tat_start_to_uploading_date));
                                    $diff1=date_diff($tat_start_to_uploading_date,$tat_work_initiate_date);
                                    $tat_start_to_Ediiting_ageing = $diff1->format("%a");
                                }else{
                                    $tat_start_to_Ediiting_ageing = "-";
                                }
                            }else{
                                $tat_start_to_Ediiting_ageing = $tatAgeing = '-';
                                $tatStartDate = "Not started";
                            }

                            $editing_tat_status = "Within TAT"; //
                            if($tat_start_to_Ediiting_ageing != '-' && $tatAgeing != '-'){
                                $editing_tat_status = $tat_start_to_Ediiting_ageing > $tatAgeing ? 'Breached' : $editing_tat_status ;
                            }
                            $editing_to_submission_agging = "NA";
                            if($submission_id > 0 && $tat_start_to_uploading_date != '-'){
                                $submission_date_for_aging = date_create($submission_date);
                                $diff = date_diff($submission_date_for_aging,$tat_start_to_uploading_date);
                                $editing_to_submission_agging = $diff->format("%a");
                            }

                            if($work_committed_date_is != ''){
                                $tatEndDate = date_dMY($work_committed_date_is);
                            }else{
                                $tatEndDate = "Not Ended";
                            }
                            
                            if($submission_id > 0){
                                $Submission_skuQty =  $imgqty;
                                $tat_status = "";
                                if($work_committed_date_is != '' && $submission_date_is != ''){
                                    if(date('Y-m-d', strtotime($work_committed_date_is)) < date('Y-m-d', strtotime($submission_date_is)) ){
                                        $tat_status = "TAT Breached";
                                    }else{
                                        $tat_status = "Within TAT";
                                    }
                                }
                                $client_rejection = ($submission_ar_status == 1) ? 'Approved' : ($submission_ar_status == 2 ? 'Rejected' : '-') ;
                            }else{
                                $Submission_style_count = $Submission_skuQty =  "-";
                                $client_rejection = $tat_status = '-' ;
                            }

                            if($work_initiate_date_is != '' && $work_committed_date_is != ''){
                                $date1=date_create($work_initiate_date_is);
                                $date2=date_create($work_committed_date_is);
                                $diff=date_diff($date1,$date2);
                                $TAT_CommitedDays = $diff->format("%a");
                            }else{
                                $TAT_CommitedDays = ''; 
                            }

                            $tatStartMonth = $work_initiate_date != '' && $work_initiate_date != null && $work_initiate_date != '0000-00-00' ? date('F' , strtotime($work_initiate_date)) : '-' ;
                            $loginSharedDate = "";
                        @endphp
                         <tr>
                            <td class="td_class1">{{ $sn++}}</td>
                            <td class="td_class1">{{ $row['company']}}</td>
                            <td class="td_class1">{{ $row['brand_name'].$wrc_id_is}}</td>
                            <td class="td_class1">{{ date_dMY($row['wrc_created_at'])}} </td> {{-- Sample Inward Date --}}
                            <td class="td_class1"> {{ monthName($row['wrc_created_at'])}} </td> {{-- Sample Inward Month --}}
                            <td class="td_class1"> {{$wrcAgeing}} </td> {{-- Ageing --}}
                            <td class="td_class1">{{ $row['lot_number']}}</td>
                            <td class="td_class1"> {{$wrc_inward_qty}} </td> {{-- LOT Inward Quantity --}}
                            <td class="td_class1">{{ $row['wrc_number']}}</td>
                            <td class="td_class1">{{ $wrc_count}}</td> {{-- WRC Count --}}
                            <td class="td_class1"> {{$imgqty}} </td> {{-- WRC Inward Quantity --}}
                            <td class="td_class1">{{ $wrc_panding_at }}</td> {{-- WRC Pending At --}}
                            <td class="td_class1"> {{ $row['type_of_service']}} </td> {{-- Type of Service --}}
                            <td class="td_class1"> {{$last_allocated_date != '' ? date_dMY($last_allocated_date) : '-'}} </td> {{-- Editing Hand Over Date --}}
                            <td class="td_class1"> {{ $row['am_email']}} </td> {{-- Spoc Email --}}
                            <td class="td_class1">{{$tatStartDate}}</td> {{-- TAT Start Date --}}
                            <td class="td_class1">{{$tatAgeing}}</td>  {{-- TAT Ageing --}}
                            <td class="td_class1"> {{$tat_start_to_Ediiting_ageing}} </td> {{-- TAT Start to Ediiting Ageing --}}
                            <td class="td_class1"> {{$editing_tat_status}} </td> {{-- Ediiting TAT Status --}}
                            <td class="td_class1"> {{$editing_to_submission_agging}} </td> {{-- Ediiting to Submission Ageing --}}
                            <td class="td_class1">{{$tatEndDate}}</td>  {{-- TAT End Date --}}
                            <td class="td_class1">{{$tat_status}}</td>  {{-- TAT Status --}}
                            <td class="td_class1"> {{$client_rejection}} </td> {{-- Client Rejection --}}
                            <td class="td_class1"> {{ $row['submission_id'] > 1 ? 'Completed' : 'Active'}} </td> {{-- Wrc Status --}}
                            <td class="td_class1">{{$submission_date_is != '' ? $submission_date_is : 'Not Submitted'}}</td>  {{-- Upload Date (Submission) --}}
                            <td class="td_class1"> {{$Submission_skuQty}} </td> {{-- Submission Qty --}}
                            <td class="td_class1"> {{ $row['invoice_number']}} </td> {{-- Invoice Number --}}
                            <td class="td_class1"> {{ $row['CommercialPerImage']}} </td> {{-- Per SKU Commercial --}}
                            <td class="td_class1"> {{ $row['CommercialPerImage'] * $imgqty }} </td> {{-- Expected Commercial --}}
                            <td class="td_class1"> {{ $row['CommercialPerImage'] * $editor_sum }} </td> {{-- Actual Commercial --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
               
        </div>
    </div>
</body>
</html>