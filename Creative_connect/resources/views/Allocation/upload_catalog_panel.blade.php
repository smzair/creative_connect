@extends('layouts.admin')

@section('title')
Cataloger Panel
@endsection

@section('content')
<div class="container-fluid mt-5 plan-shoot new-allocation-table-main">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">

                

                <div class="card-header">
                    <h3 class="card-title">Cataloger Panel</h3>
                </div>

                @php
                    $getcopyWriter_array = getcopyWriter();
                    $getcopyWriter = array_column($getcopyWriter_array, 'name','id');
                    $getCataloguer = getCataloguer();
                    $Cataloguers = array_column($getCataloguer, 'name','id');

                    $allocated_wrc_user_list = array_column($allocated_wrc_list_by_user, 'wrc_id',  'id');
                    $alloc_wrc_list_key = array_flip(array_column($allocated_wrc_list_by_user, 'wrc_id'));

                    $allocated_id_arr = array_flip($allocated_wrc_user_list);

                    // pre($allocated_wrc_list_by_user);
                   
                    // pre($getcopyWriter);
                    $show_td = 0;
                    if($user_role == 'Cataloguer'){
                        $show_td = 1;
                        $td_head = "Assigned Copy Writers";
                    }else{
                        $show_td = 2;
                        $td_head = "Assigned Cataloguers";
                    }
                @endphp
               
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
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>SKU Count</th>
                               
                                <th>{{ $td_head }}</th>
                                <th>Guidelines Links</th>
                                <th>Start Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                            @foreach($allocationList as $allocationkey => $row)
                            @php
                                // pre($row);
                                // pre($allocationList);

                                $wrc_id =  $row['wrc_id'] ;
                                if(!array_search($wrc_id,$allocated_wrc_user_list,true)){
                                    continue;
                                }

                                $ass_cataloger_list = explode(',',$row['ass_cataloger']);
                                $user_roles_list = explode(',',$row['user_roles']);
                                $allocation_id = $allocated_id_arr[$wrc_id];
                                
                                $allocated_data_arr = $allocated_wrc_list_by_user[$alloc_wrc_list_key[$wrc_id]];
                                // pre($allocated_data_arr);
                               $time_hash_id =  $allocated_data_arr['time_hash_id'];
                               $start_time =  $allocated_data_arr['start_time'];
                               $start_time_is = "";
                               $display_date_time = "display:none;";
                               $display_start = "display:block;";
                               $btn_disable = "disabled";
                               if($time_hash_id > 0){
                                   $btn_disable = "";
                                    $display_start = "display:none;";
                                    $display_date_time = "display:block;";
                                    $start_time_is = date('d-m-Y h:i:s A' , strtotime($start_time));
                               }

                            @endphp
                            <tr>
                                <td>{{ $row['wrc_number'] }}</td>
                                <td>{{ $row['Company'] }}</td>
                                <td>{{ $row['brand_name'].$row['lot_id'] }}</td>
                                <td>{{ $allocated_data_arr['allocated_qty'] }}</td>
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
                                <td>
                                  <div class="task-action task-start-button" >
                                    <a href="javascript:;" style="{{ $display_start }}" class="btn btn-warning" onclick="start_task('{{ $allocation_id }}')" id="startBTN{{ $allocation_id }}" >
                                      Start
                                    </a>
                                  </div>
                                  <div class="task-action task-start-timings" id="show_date_time{{ $allocation_id }}"  style="{{ $display_date_time }}"> {{ $start_time_is }}
                                  </div>
                                </td>


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
                <h4 class="modal-title">Uploading Panel - Catalogue</h4>
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
                                    <label class="control-label required">Link</label>
                                    <input type="text" class="form-control" name="workLink1" id="workLink1" placeholder="Link">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Link</label>
                                    <input type="text" class="form-control" name="workLink2" id="workLink2" placeholder="Link">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="custom-info">
                                  <p>Please mark the WRC as complete only after you have uploaded the corresponding documents.</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12" >
                                <a class="btn btn-warning" href="javascript:void(0)" style="float:right; margin: 0 5px;">Complete Allocation</a>
                                <a class="btn btn-warning" href="javascript:void(0)" style="float:right; margin: 0 5px;">Save</a>
                            </div>
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
        const data_id = 'data'+params;

        const project_type = $("#"+data_id).data('project_type');
        const wrc_number = $("#"+data_id).data('wrc_number');
        const kind_of_work = $("#"+data_id).data('kind_of_work');
        const brand_name = $("#"+data_id).data('brand_name');
        const company = $("#"+data_id).data('company');
        const startDate = $("#"+data_id).data('start_date');

        document.querySelector("#projectType").innerHTML = project_type
        document.querySelector("#wrcNo").innerHTML = wrc_number 
        document.querySelector("#kindOfWork").innerHTML =  kind_of_work
        document.querySelector("#brndName").innerHTML = brand_name
        document.querySelector("#startDate").innerHTML = startDate
    }
</script>

{{-- start_task --}}
<script>
   async function start_task(id){
        // console.log(id)
        allocation_id = id;
        const startBTN = 'startBTN'+allocation_id;
        const uploadBTn = 'uploadBTn'+allocation_id;
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
                    document.getElementById(show_date_time).innerHTML = res.start_time
                    document.getElementById('data'+allocation_id).dataset.start_date = res.start_time
                    $("#"+show_date_time).css("display", "block");
                    $('#'+uploadBTn).prop('disabled', false);
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
@endsection