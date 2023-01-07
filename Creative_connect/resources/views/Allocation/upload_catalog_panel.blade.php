@extends('layouts.admin')

@section('title')
Cataloger Panel
@endsection

@section('content')
<div class="container-fluid mt-5 plan-shoot new-allocation-table-main">

    <style type="text/css">
    

    /* .info-list > li {
        display: block;
        width: 100%;
        position: relative;
    }

    .info-list > li:not(:last-child) {
        margin-bottom: 4px;
    }

    .info-list > li > span, .info-list > li > a {
        display: inline-block;
    }

    .info-list > li > a:hover, .info-list > li > a:focus {
        text-decoration: underline !important;
    }

    .date, .time {
        display: block;
        width: 100%;
    }

    .time {
        font-weight: 700;
    }

    .allocation-wrc-modal .modal-body {
        padding: 1rem 1.2rem;
    }

    .alloc-action-btn.inactive {
        pointer-events: none;
        opacity: 0.5;
    }

    .card.card-transparent .table td .task-start-button .btn {
        background-color: #FBF702 !important;
        color: #000 !important;
        border-color: transparent;
        width: 100%;
    }

    .card.card-transparent .table td .task-start-button .btn:hover, 
    .card.card-transparent .table td .task-start-button .btn:focus {
        background-color: #ba8b00 !important;
    }

    .alloc-action-btn {
        display: block;
    }

    .alloc-action-btn:first-of-type {
        margin-bottom: 10px;
    } */


</style>
    <style>
         .msg_box{
            margin: 0.1em 0;
            background: #928c8cfc;
            display: none;
            padding: 0.3em;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                @php
                    
                    $show_td = 0;
                    if($user_role == 'Cataloguer'){
                        $show_td = 1;
                        $td_head = "Assigned Copy Writers";
                    }else{
                        $show_td = 2;
                        $td_head = "Assigned Cataloguers";
                    }
                @endphp

                <div class="card-header">
                    <h3 class="card-title">{{ $user_role }} Panel</h3>
                </div>
               
                <!-- /.card-header msg_div msg_box  -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <div style="width: 100%"> 
                       <div  id="msg_div" style="display: none" class="alert" role="alert">
                             <p id="msg_box"></p>  
                        </div>
                    </div>
                    
                    <table id="allocTableCat" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th>WRC Number</th>
                                <th>Batch Number</th>
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>Marketplace</th>
                                <th>Credentials</th>
                                <th>Order Qty</th>
                                {{-- <th>SKU Count</th> --}}
                                <th>{{ $td_head }}</th>
                                <th>Guidelines Links</th>
                                <th>Time Spent</th>
                                <th>Action</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $second = 26584;
                                $modeOfDelivary_arr = modeOfDelivary();
                                $getMarketPlace = getMarketPlace();
                                $MarketPlace_array_list = array_column($getMarketPlace, 'marketPlace_name','id');
                                
                                $commercial_wise_MarketplaceCredentials_list = commercial_wise_MarketplaceCredentials_list();
                                $Mar_place_cre_array_1 = array_column($commercial_wise_MarketplaceCredentials_list, 'commercial_id');
                                
                                $getcopyWriter_array = getcopyWriter();
                                $getcopyWriter = array_column($getcopyWriter_array, 'name','id');

                                $getCataloguer = getCataloguer();
                                $Cataloguers = array_column($getCataloguer, 'name','id');

                                $allocated_wrc_batch = array_column($allocated_wrc_list_by_user, 'batch_no');
                                $allocated_wrcs = array_column($allocated_wrc_list_by_user, 'wrc_id');

                                // pre($allocated_wrc_list_by_user[6]);
                                // pre($allocated_wrcs);
                                // pre($allocated_wrc_batch);
                            @endphp
                             
                            @foreach($allocationList as $allocationkey => $row)
                            @php
                                $allocation_id =  $row['allocation_id_is'];
                                $wrc_id =  $row['wrc_id'];
                                $commercial_id =  $row['commercial_id'];
                                $lot_id =  $row['lot_id'];
                                $batch_no =  $row['batch_no'];

                                $market_place_ids = explode(',',$row['market_place']);
                                $modeOfDelivary =  $row['modeOfDelivary'];
                                $modeOfDelivary_is = $modeOfDelivary_arr[$modeOfDelivary];

                                $allocated_wrcs_is = array_intersect($allocated_wrcs,array($wrc_id));
                                
                                foreach ($allocated_wrcs_is as $key => $value) {
                                    if($allocated_wrc_batch[$key] == $batch_no){
                                        $ass_cataloger = $allocated_wrc_list_by_user[$key]['ass_cataloger'];
                                        $user_roles = $allocated_wrc_list_by_user[$key]['user_roles'];
                                        break ;
                                    }
                                }
                                
                                $ass_cataloger_list = explode(',',$ass_cataloger);
                                $user_roles_list = explode(',',$user_roles);
                               
                                $allocated_data_arr = $row;
                                
                                $time_hash_id  =  $row['time_hash_id'];
                                $is_rework     =  $row['is_rework'];
                                $task_status   =  $row['task_status'];
                                $rework_count  =  $row['rework_count'];
                                $start_time    =  $row['start_time'];
                                $end_time      =  $row['end_time'];
                                $is_started    =  $row['is_started'];

                                $allocated_qty = $row['allocated_qty'];
                                $end_time_is = $spent_time =  $row['spent_time'];

                                $spent_time_is = ($spent_time != 0 && $spent_time != "") ? get_date_time($spent_time) : "";

                                $start_time_is     = "";
                                $display_date_time = "display:none;";
                                $display_start     = "display:block;";
                                $btn_disable       = "disabled";

                                $extra = "";
                                $display_start = "";
                                $display_pause = "display:none;";
                                $start_btn_text = "Start";
                                
                                if($time_hash_id > 0){
                                    $start_btn_text = "continue";
                                }

                                if($time_hash_id > 0 && $is_started == 0  ){
                                    $display_pause = "";
                                    $display_start = "display:none;";
                                }


                                if($time_hash_id > 0 && $task_status == 1){
                                    $display_pause = "display:none;";
                                    $display_start = "display:none;";

                                    if($is_rework == 1){
                                        $display_start = "";
                                    }
                                }

                                



                               if(($time_hash_id > 0 && (($task_status == 0 && $is_rework == 0) || ($task_status == 1 && $is_rework == 0) || $task_status == 2  )) ){
                                   $btn_disable = "";
                                    // $display_start = "display:none;";
                                    // $display_start = "display:none;";

                                    // $display_pause = "";
                                    
                                    // $display_date_time = "display:block;";
                                    $start_time_is = date('d-m-Y h:i:s A' , strtotime($start_time));
                               }

                               if($allocation_id == 1 || $allocation_id == 4){
                                    // pre($row);
                                }
                            @endphp
                            <tr>
                                <td>{{ $row['wrc_number'] }}</td>
                                <td>
                                    <?php echo $row['batch_no'] > 0 ? $row['batch_no'] : 'None' ;?>
                                </td>
                                <td>{{ $row['Company'] }}</td>
                                <td>{{ $row['brand_name'].$extra }}</td>
                                
                                <td> 
                                   <?php 
                                    if($modeOfDelivary_is == 'Uploading'){
                                        $Uploading_market_place_list = array_intersect($Mar_place_cre_array_1,array($commercial_id));
                                        foreach ($Uploading_market_place_list as $key => $array_index) {
                                            $Up_mar_cre_arr = $commercial_wise_MarketplaceCredentials_list[$key];
                                            echo "<p class='m-0'>".$Up_mar_cre_arr['marketPlace_name']. " ( ".$Up_mar_cre_arr['link']." )</p>";
                                        }
                                    }else{  ?>
                                        @foreach ($market_place_ids as $mp_id)
                                            <p class="m-0">{{ $MarketPlace_array_list[$mp_id] }}</p>
                                        @endforeach
                                    <?php } ?> 
                                </td>
                                <td> 
                                    <?php 
                                        if($modeOfDelivary_is == 'Uploading'){
                                            $Uploading_market_place_list = array_intersect($Mar_place_cre_array_1,array($commercial_id));
                                            foreach ($Uploading_market_place_list as $key => $array_index) {
                                                $Up_mar_cre_arr = $commercial_wise_MarketplaceCredentials_list[$key];
                                                echo "<p class='m-0'>Username => ".$Up_mar_cre_arr['username']. " | password => ".$Up_mar_cre_arr['password']."</p>";
                                            }
                                        }
                                    ?>    
                                </td>
                                <td>{{ $allocated_qty }}</td>
                                {{-- Assigned Cataloguers --}}
                                @if ($show_td == 2)
                                    <td>
                                    <ul class="info-list">
                                        @foreach ($ass_cataloger_list as $key => $user_id)
                                        <?php 
                                        $user_role_is = $user_roles_list[$key];
                                        if($user_role_is == 0){   ?>
                                            <li><span class="gd-name"><?=  $Cataloguers[$user_id] ?></span></li>
                                        <?php }  ?>
                                        @endforeach
                                    </ul>
                                    </td>
                                @endif

                                {{--Assigned Copy Writers --}}
                                @if ($show_td == 1)
                                    <td>
                                    <ul class="info-list">
                                        @foreach ($ass_cataloger_list as $key => $user_id)
                                        <?php 
                                        $user_role_is = $user_roles_list[$key];
                                        if($user_role_is == 1){   ?>
                                            <li><span class="gd-name"><?=  $getcopyWriter[$user_id] ?></span></li>
                                        <?php }  ?>
                                        @endforeach
                                    </ul>
                                    </td>
                                @endif
                                <td>
                                  <ul class="info-list">
                                    <li><a href="{{ $row['work_brief'] }}" class="work-link">Link</a></li>
                                    <li><a href="{{ $row['guidelines'] }}" class="work-link">Link</a></li>
                                    <li><a href="{{ $row['document1'] }}" class="work-link">Link</a></li>
                                    <li><a href="{{ $row['document2'] }}" class="work-link">Link</a></li>
                                  </ul>
                                </td>

                                {{-- time_spant --}}
                                <td >
                                    <p id="time_spant{{ $allocation_id }}">
                                        {{ $spent_time_is }}
                                    </p>
                                </td>
                                {{-- action --}}
                                <td>
                                  <div class="task-action task-start-button" >
                                    <a href="javascript:;" style="{{ $display_start }}" class="btn btn-warning" onclick="start_task('{{ $allocation_id }}')" id="startBTN{{ $allocation_id }}" >
                                      {{ $start_btn_text }}
                                    </a>

                                    <a href="javascript:;" style="{{ $display_pause }}" class="btn btn-warning" onclick="Pause_task('{{ $allocation_id }}')" id="pauseBTN{{ $allocation_id }}" >
                                      Pause
                                    </a>
                                  </div>

                                    <div class="task-action task-start-timings" id="show_date_time{{ $allocation_id }}"  style="{{$display_date_time}}"> {{ $start_time_is }}
                                    
                                    </div>
                                </td>
                                {{-- Upload --}}
                                <td>

                                    <p id="data{{ $allocation_id }}" 
                                    data-project_type="{{$allocated_data_arr['project_type']}}" 
                                    data-wrc_number="{{$allocated_data_arr['wrc_number']}}"   
                                    data-kind_of_work="{{$allocated_data_arr['kind_of_work']}}"   
                                    data-company="{{$row['Company']}}"   
                                    data-brand_name="{{$row['brand_name']}}"   
                                    data-start_date="{{$start_time_is}}"   
                                    style="display: none"></p>
                                    
                                    <button  class="btn btn-warning alloc-action-btn inactive" id="uploadBTn{{ $allocation_id }}" data-toggle="modal" data-target="#editpanelPopupCat" {{ $btn_disable }}  onclick="set_data('{{ $allocation_id }}')">
                                        Upload
                                    </button>
                                    {{-- <a href="javascript:;" class="btn btn-warning alloc-action-btn inactive" id="editBTn" data-toggle="modal" data-target="#editpanelPopupCat">
                                        Edit
                                    </a> --}}
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="editpanelPopupCat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h4 class="modal-title">Uploading Panel - {{ $user_role }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="custom-dt-row work-details">
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <div class="col-ac-details">
                                <h6>WRC Number</h6>
                                <p id="wrcNo">WRC-2345</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Brand Name</h6>
                                <p id="brndName">ODN11jidfv23e4r</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Start Date</h6>
                                <p id="startDate">11/11/1111</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Project Type</h6>
                                <p id="projectType">fneivnsdvi;msdol;dvm</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Kind of Work</h6>
                                <p id="kindOfWork">vdssvdsvvds</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-dt-row">
                    <form class="" method="POST" action="" id="workdetailsform">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label <?php echo $user_role == 'Cataloguer' ? 'required' : ''  ?>"> Cataloguer Link</label>
                                    <input type="text" class="form-control" name="workLink1" id="workLink1" placeholder="Link">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label  <?php echo $user_role == 'CW' ? 'required' : ''  ?> "> CW Link</label>
                                    <input type="text" class="form-control" name="workLink2" id="workLink2" placeholder="Link">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="custom-info">
                                  <p>Please mark the WRC as complete only after you have uploaded the corresponding documents.</p>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12"  style="position: relative;" >
                                <input type="hidden" name="allocation_id_is" id="allocation_id_is">
                                <button type="button" id="btn_comp" class="btn btn-warning" name="comp_wrc" value="comp_wrc" style="float:right; margin: 0 5px;" onclick="formvalidate('comp')">Complete Wrc</button>

                                <button type="button" id="btn_save" class="btn btn-warning" style="float:right; margin: 0 5px;"  onclick="formvalidate('save')"  name="save_wrc" value="save_wrc">Save</button>
                                
                            </div>

                            <p class="msg_box" id="msg_box1" style="color: red; display: none;">
                            </p>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTable Plugins Path -->

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<!-- End of DataTable Plugins Path -->

<script>
    $('#allocTableCat').DataTable({
          dom: 'lBfrtip',
          "lengthMenu": [ 5, 25, 50, -1], [10, 25, 50, "All"],
          "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');

    $('.task-start-button .btn').click(function(){
      $(this).parent('.task-start-button').next('.task-start-timings').css('display', 'block');
      $(this).css('display', 'none');
      $(this).parents('td').siblings('td').find('.alloc-action-btn').removeClass('inactive');
    });
</script>

{{-- set_data --}}
<script>
    async function set_data(params) {
        console.log(params)
        const data_id = 'data'+params;
        const time_spant = 'time_spant'+params;
        const project_type = $("#"+data_id).data('project_type');
        const wrc_number = $("#"+data_id).data('wrc_number');
        const kind_of_work = $("#"+data_id).data('kind_of_work');
        const brand_name = $("#"+data_id).data('brand_name');
        const company = $("#"+data_id).data('company');
        const startDate = $("#"+data_id).data('start_date');

        document.getElementById("allocation_id_is").value = params;
        document.querySelector("#projectType").innerHTML = project_type
        document.querySelector("#wrcNo").innerHTML = wrc_number 
        document.querySelector("#kindOfWork").innerHTML =  kind_of_work
        document.querySelector("#brndName").innerHTML = brand_name
        document.querySelector("#startDate").innerHTML = startDate

        // $("#btn_save").css("display", "none");
        // $("#btn_comp").css("display", "none");
        document.querySelector("#workLink1").value = "";
        document.querySelector("#workLink2").value = "";
        $("#btn_save").css("display", "block");
        $("#btn_comp").css("display", "block");

        await $.ajax({
            url: "{{ url('get-catalog_upload_links')}}",
            type: "POST",
            dataType: 'json',
            data: {
                allocation_id : params,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                console.log(res)
                if(res == 0){
                    document.querySelector("#btn_save").innerHTML = "save";
                }else{
                    document.querySelector("#btn_save").innerHTML = "update";
                    document.querySelector("#workLink1").value = res[0].catalog_link
                    document.querySelector("#workLink2").value = res[0].copy_link

                    end_time = res[0].end_time
                    task_status = res[0].task_status
                    spent_time_is = res[0].spent_time_is

                    // if(end_time != '0000-00-00 00:00:00' && end_time != '' ||){  // task_status
                    if(task_status > 0){
                        $("#btn_save").css("display", "none");
                        $("#btn_comp").css("display", "none");
                        // document.querySelector("#"+time_spant).innerHTML = spent_time_is;
                    }
                }
            }
        });
    }
</script>

{{-- start_task --}}
<script>
   async function start_task(id){
        // console.log(id)pauseBTN
        allocation_id = id;
        const startBTN = 'startBTN'+allocation_id;
        const uploadBTn = 'uploadBTn'+allocation_id;
        const pauseBTN = 'pauseBTN'+allocation_id;
        const show_date_time = 'show_date_time'+allocation_id;
         await $.ajax({
            url: "{{ url('set-catalog-allocation-start')}}",
            type: "POST",
            dataType: 'json',
            data: {
                allocation_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                console.log(res)
                // msg_div msg_box startBTN 
                const msg_div = document.getElementById("msg_div");
                const msg_box = document.getElementById("msg_box");
                msg_div.classList.remove("alert-success");
                msg_div.classList.remove("alert-danger");
                if(res.status == true || res.status == 1){
                    msg_div.classList.add("alert-success");
                    msg_box.innerHTML  = "Wrc Started!!";
                    $("#"+startBTN).css("display", "none");
                    // document.getElementById(show_date_time).innerHTML = res.start_time
                    document.getElementById('data'+allocation_id).dataset.start_date = res.start_time
                    // $("#"+show_date_time).css("display", "block");
                    $('#'+uploadBTn).prop('disabled', false);
                    $('#'+pauseBTN).css('display', 'block');
                }else{
                    msg_div.classList.add("alert-danger");
                    msg_box.innerHTML  = "Somthing went Wrong!! Try again!!";
                }
                $("#msg_div").css("display", "block");
            }
        });
        setTimeout( () => {
            $("#msg_div").css("display", "none");
        }, 2500);
    }
</script>

{{-- start_task --}}
<script>
   async function Pause_task(id){
        // console.log(id)pauseBTN
        allocation_id = id;
        const startBTN = 'startBTN'+allocation_id;
        const uploadBTn = 'uploadBTn'+allocation_id;
        const pauseBTN = 'pauseBTN'+allocation_id;
        const show_date_time = 'show_date_time'+allocation_id;
         await $.ajax({
            url: "{{ url('set-catalog-allocation-pause')}}",
            type: "POST",
            dataType: 'json',
            data: {
                allocation_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                console.log(res)
                // msg_div msg_box startBTN 
                const msg_div = document.getElementById("msg_div");
                const msg_box = document.getElementById("msg_box");
                msg_div.classList.remove("alert-success");
                msg_div.classList.remove("alert-danger");

                if(res.status == true || res.status == 1){
                    msg_div.classList.add("alert-success");
                    msg_box.innerHTML  = "Wrc Paused!!";
                    $("#"+startBTN).css("display", "block");
                    $('#'+pauseBTN).css('display', 'none');
                   
                    document.querySelector("#"+startBTN).innerHTML = 'Continue';
                    document.querySelector("#time_spant"+allocation_id).innerHTML = res.spent_time;
                }else{
                    msg_div.classList.add("alert-danger");
                    msg_box.innerHTML  = "Somthing went Wrong!! Try again!!";
                }
                $("#msg_div").css("display", "block");
            }
        });
        setTimeout( () => {
            $("#msg_div").css("display", "none");
        }, 2500);
    }
</script>

{{-- formvalidate --}}
<Script>
   async function formvalidate(action){
        // Cataloguer / CW

        const user_role = '{{ $user_role }}'
        const allocation_id_is  = $("#allocation_id_is").val()
        const workLink1  = $("#workLink1").val()
        const workLink2  = $("#workLink2").val()

        if(user_role == 'Cataloguer' && workLink1 == ''){
            alert('Cataloguer Link in required ');
            $( "#workLink1" ).focus();
            return
        }

        if(user_role == 'CW' && workLink2 == ''){
            alert('Copy Writer Link in required ');
            $( "#workLink1" ).focus();
            return
        }
        console.log({allocation_id_is , workLink1 , workLink2 , user_role })
        console.warn(action)

         await $.ajax({
            url: "{{ url('catalog-upload-link') }}",
            type: "POST",
            dataType: 'json',
            data: {
                allocation_id_is: allocation_id_is,
                catalog_link: workLink1,
                copy_link: workLink2,
                action,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                console.log(res)
                if(res?.status > 0){
                    const status = res.status

                    if(status == 1){
                        document.querySelector("#btn_save").innerHTML = "update";
                        document.querySelector("#msg_box1").innerHTML = user_role +" link Saved Successfully";
                    }else{
                        document.querySelector("#btn_save").innerHTML = "update";
                        document.querySelector("#msg_box1").innerHTML = user_role+" link Updated Successfully";
                    }
                    
                    if(res.up_status == 1){
                        document.querySelector("#msg_box1").innerHTML = user_role+" WRC Completed Successfully";
                        // document.querySelector("#btn_save").innerHTML = "update";
                        console.warn(res.end_time)
                        document.querySelector("#time_spant"+allocation_id_is).innerHTML = res.spent_time_is;
                        $("#btn_save").css("display", "none");
                        $("#btn_comp").css("display", "none");

                    }
                }else{

                }
                    $("#msg_box1").css("display", "block");
            }
        });
        setTimeout( () => {
            $(".msg_box").css("display", "none");
            $('#msg_box1').html("");
        // $('#msg_box2').html("");
        // $("#msg_box1").css("display", "none");
        // $("#msg_box2").css("display", "none");
        }, 3000);
    }
</Script>
@endsection