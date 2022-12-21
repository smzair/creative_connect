@extends('layouts.admin')

@section('title')
<?php if($allocationList['role'] == 'CD'){?>
    Copy Writers Panel
<?php } ?>
<?php if($allocationList['role'] == 'GD'){?>
    Graphics Designers Panel
<?php } ?>
@endsection
@section('content')
<!-- New Allocation Details - Person Allocated (For Creative) -->
<style type="text/css">
    

    .info-list > li {
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
    }


</style>
<div class="container-fluid mt-5 plan-shoot new-allocation-table-main">
    <div class="row">
        <!-- New Create Lot -->
        @if (Session::has('success'))
            <div class="alert alert-success" id="sub_msg_div" role="alert">
                {{ Session::get('success') }}
            </div>
            {{ Session::forget('success') }}
        @endif
        <div class="" id="msg_div" style="display: none" role="alert">
            <p id='msg_p'></p>
        </div>
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title">
                        
                        <?php if($allocationList['role'] == 'CD'){?>
                            Copy Writers Panel
                        <?php } ?>
                        <?php if($allocationList['role'] == 'GD'){?>
                            Graphics Designers Panel
                        <?php } ?>
                    
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <table id="allocTable" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th>WRC Number</th>
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>Order Qty</th>
                                <?php if($allocationList['role'] == 'CD'){  ?>
                                <th>Assigned Graphics Designers</th>
                                <?php }?> 
                                <?php if($allocationList['role'] == 'GD'){  ?>
                                    <th>Assigned Copy Writers</th>
                                <?php }?> 
                                <th>Guidelines Links</th>
                                <th>Spent Time</th>
                                <th>Task End Date</th>
                                <th>Task Start Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allocationList['resData'] as $key => $allocationInfo)
                            <tr>
                                <td id="wrc_number{{$key}}">{{$allocationInfo['wrc_number']}}</td>
                                <td id="creative_allocation_id{{$key}}" style="display: none;">{{$allocationInfo['creative_allocation_id']}}</td>
                                <td id="role{{$key}}" style="display: none;">{{$allocationList['role']}}</td>
                                <td id="creative_upload_links_allocation_id{{$key}}" style="display: none;">{{$allocationInfo['creative_upload_links_allocation_id']}}</td>
                                <td id="creative_link{{$key}}" style="display: none;">{{$allocationInfo['creative_link']}}</td>
                                <td id="copy_link{{$key}}" style="display: none;">{{$allocationInfo['copy_link']}}</td>
                                <td id="project_name{{$key}}" style="display: none;">{{$allocationInfo['project_name']}}</td>
                                <td id="kind_of_work{{$key}}" style="display: none;">{{$allocationInfo['kind_of_work']}}</td>
                                <td>{{$allocationInfo['company_name']}}</td>
                                <td id="brand_name{{$key}}">{{$allocationInfo['brand_name']}}</td>
                                <td>{{$allocationInfo['order_qty']}}</td>
                                <?php if($allocationList['role'] == 'CD'){  ?>
                                <td>
                                  <ul class="info-list">
                                    @foreach ($allocationInfo['gd_user_with_wrc'] as $user_with_wrc_data)
                                    <li><span class="gd-name">{{$user_with_wrc_data->name}}</span></li>
                                    @endforeach
                                  </ul>
                                </td>
                                <?php }?>
                                <?php if($allocationList['role'] == 'GD'){  ?>
                                <td>
                                    <?php if ($allocationInfo['alloacte_to_copy_writer'] == 1) { ?>
                                    <ul class="info-list">
                                      @foreach ($allocationInfo['cw_user_with_wrc'] as $cw_user_with_wrc_data)
                                      <li><span class="gd-name">{{$cw_user_with_wrc_data->name}}</span></li>
                                      @endforeach
                                    </ul>
                                    <?php } ?>
                                </td>
                                <?php }?>
                                <td>
                                  <ul class="info-list">
                                    <li><a href={{$allocationInfo['work_brief']}} class="work-link">{{$allocationInfo['work_brief']}}</a></li>
                                    <li><a href={{$allocationInfo['guidelines']}} class="work-link">{{$allocationInfo['guidelines']}}</a></li>
                                    <li><a href={{$allocationInfo['document1']}} class="work-link">{{$allocationInfo['document1']}}</a></li>
                                    <li><a href={{$allocationInfo['document2']}} class="work-link">{{$allocationInfo['document2']}}</a></li>
                                  </ul>
                                </td>
                                @php
                                    $get_date_time = get_date_time($allocationInfo['spent_time_data']);
                            
                                @endphp
                                <td>{{ $get_date_time}}</td>

                                {{-- <td>
                                    <ul class="info-list">
                                      @foreach ([$allocationInfo->spent_time_data] as $spent_time_data)
                                      <li><span class="gd-name">{{$spent_time_data}}</span></li>
                                      @endforeach
                                    </ul>
                                  </td> --}}    


                                <?php if($allocationInfo['task_status'] == 1){  ?>
                                    <td>{{dateFormat($allocationInfo->end_time)}}<br><b>{{timeFormat($allocationInfo->end_time)}}</b></td>
                                <td>
                                <?php } ?>
                                <?php if(($allocationInfo['task_status'] != 1)){  ?>
                                    <td></td>
                                <td>
                                <?php } ?>
                                
                                <?php if(($allocationInfo['start_time'] == '0000-00-00 00:00:00')){  ?>
                                  <div class="task-action task-start-button" style="display:bock;" id="start_btn">
                                    <a href="javascript:;" class="btn btn-warning" onclick="start_task('{{ $allocationInfo->creative_allocation_id }}')" id="startBTN{{ $key }}" id="startBTN">
                                      Start
                                    </a>
                                  </div>
                                <?php }?>
                                <?php if($allocationInfo['start_time'] != '0000-00-00 00:00:00'){  ?>
                                  <div class="task-action task-start-timings" style="display:block;">
                                    <span  class="start_time1{{$key}}">{{dateFormat($allocationInfo->start_time)}}</span>
                                    <span class="time">{{timeFormat($allocationInfo->start_time)}}</span>
                                  </div>
                                <?php }?>
                                <div class="task-action task-start-timings" style="display:none;" id="start_time">
                                    <span id="start_time1" class="start_time1{{$key}}"></span><br>
                                    <span id="start_time2"></span>
                                  </div>
                                </td>
                                <?php if(($allocationInfo['start_time'] != 'NULL') || ($allocationInfo['end_time'] == null)){  ?>
                                    <td>
                                        <?php if($allocationInfo['start_time'] != '0000-00-00 00:00:00' && $allocationInfo['task_status'] == 0){  ?>
                                            <a href="#" class="btn btn-warning alloc-action-btn" data-toggle="modal" data-target="#editpanelPopup" onclick='setdata(<?php echo $key;?>)'>
                                                Upload
                                            </a>
                                        <?php } ?>
                                        {{-- <a href="#" class="btn btn-warning alloc-action-btn" id="uploadBTn" data-toggle="modal" data-target="#editpanelPopup" style="display:none;" onclick='setdata(<?php echo $key;?>)'>
                                            Upload
                                        </a> --}}
                                        <a href="javascript:;" class="btn btn-warning alloc-action-btn inactive" id="editBTn" style="display:none;">
                                            Edit
                                        </a>
                                    </td>
                                <?php } ?>
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

<form class="" method="POST" action="{{ route('CREATIVE_ALLOCATION_UPLOAD_STORE') }}" id="uploadCreativeAllocForm" onsubmit="return validateForm(event)">
    @csrf
    <div class="modal fade" id="editpanelPopup">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h4 class="modal-title" id="modal_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="creative_allocation_id" class="creative_allocation_id" value="" />
                <input type="hidden" name="user_role" class="user_role" value="" />
                <div class="modal-body">
                    <div class="custom-dt-row work-details">
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="col-ac-details">
                                    <h6>WRC Number</h6>
                                    <p class="wrcNo"></p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>Brand Name</h6>
                                    <p class="brndName">ODN11jidfv23e4r</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>Start Date</h6>
                                    <p class="startDate"></p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>Project Type</h6>
                                    <p class="projectType">fneivnsdvi;msdol;dvm</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>Kind of Work</h6>
                                    <p class="kindOfWork">vdssvdsvvds</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-dt-row">
                        <form class="" method="POST" action="" id="workdetailsform">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label class="" id="gd_link_required">GD Link</label>
                                        <input type="text" class="form-control creative_link" name="workLink1"  placeholder="Link" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label class="" id="cw_link_required">CW Link</label>
                                        <input type="text" class="form-control copy_link" name="workLink2"  placeholder="Link" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="custom-info">
                                    <p>Please mark the WRC as complete only after you have uploaded the corresponding documents.</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <button type="submit" name = "submit" value="complete_allocation" class="btn btn-warning" href="javascript:void(0)" style="float:right;margin-right:10px">Complete WRC</button>
                                    
                                    <button type="submit" name="submit" value="save" class="btn btn-warning" id="save_btn" href="javascript:void(0)" style="float:right;margin-right:10px;display: none" >Save</button>

                                    <button type="submit" name="submit" value="save" class="btn btn-warning" id="update_btn" href="javascript:void(0)" style="float:right;margin-right:10px;display: none" >Update</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End of New Editor Panel (For Creative) -->

<!-- End of New Allocation Details View -->

<script>
    $('.task-start-button .btn').click(function(){
      $(this).parent('.task-start-button').next('.task-start-timings').css('display', 'block');
      $(this).css('display', 'none');
      $(this).parents('td').siblings('td').find('.alloc-action-btn').removeClass('inactive');
    });
</script>

<!-- script for update start time -->
<script>
    async function start_task(id){
        console.log('id', id)
        allocation_id = id;
         await $.ajax({
            url: "{{ url('set-creative-allocation-start')}}",
            type: "POST",
            dataType: 'json',
            data: {
                allocation_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
               console.log('res', res.message)
               if(res.message == 'success'){
                   document.getElementById('msg_p').innerHTML  = 'Allocation successfully started';
                   $("#msg_div").addClass("alert alert-success");
                   document.getElementById('msg_div').style.display = 'block';
                   document.getElementById('start_btn').style.display = 'none';
                   document.getElementById('start_time').style.display = 'block';
                   document.getElementById('uploadBTn').style.display = 'block';
                   document.getElementById('start_time1').innerHTML = res.start_time1;
                   document.getElementById('start_time2').innerHTML = res.start_time2;
                
               }else{
                document.getElementById('msg_p').innerHTML  = 'something went wrong';
                $("#msg_div").addClass("alert alert-danger");
                document.getElementById('msg_div').style.display = 'block';
               }
            }
        });
        setTimeout(function(){
        document.getElementById('msg_div').style.display = "none";
        $("#msg_div").removeClass();
        window.location.reload();
        },3000)
     }
 </script>

 <!-- get dynamic data in modal -->
<script>
    function setdata(id){
        console.log('first', id)

        // set wrc number
        const wrc_number_td = "wrc_number"+id;
        const wrc_number = document.getElementById(wrc_number_td).innerHTML;
        document.querySelector('.wrcNo').innerHTML = wrc_number;

        // set creative_allocation_id
        const creative_allocation_id_td = "creative_allocation_id"+id;
        const creative_allocation_id = document.getElementById(creative_allocation_id_td).innerHTML;
        document.querySelector('.creative_allocation_id').value = creative_allocation_id;

        // set user_role
        const role_td = "role"+id;
        const role = document.getElementById(role_td).innerHTML;
        document.querySelector('.user_role').value = role;

        // set brand name
        const brand_name_td = "brand_name"+id;
        const brand_name = document.getElementById(brand_name_td).innerHTML;
        document.querySelector('.brndName').innerHTML = brand_name;

        // set start time
        const start_time_td = "start_time1"+id;
        const start_time = document.getElementsByClassName(start_time_td)[0].innerHTML;
        document.querySelector('.startDate').innerHTML = start_time;

        // set project name
        const project_name_td = "project_name"+id;
        const project_name = document.getElementById(project_name_td).innerHTML;
        document.querySelector('.projectType').innerHTML = project_name;

        // set kind of work
        const kind_of_work_td = "kind_of_work"+id;
        const kind_of_work = document.getElementById(kind_of_work_td).innerHTML;
        document.querySelector('.kindOfWork').innerHTML = kind_of_work;


        // set creative_upload_links_allocation_id
        var creative_upload_links_allocation_id = null;
        const creative_upload_links_allocation_id_td = "creative_upload_links_allocation_id"+id;
        var creative_upload_links_allocation_id = document.getElementById(creative_upload_links_allocation_id_td).innerHTML;

        console.log('creative_upload_links_allocation_id', creative_upload_links_allocation_id)

        if(creative_upload_links_allocation_id != null && creative_upload_links_allocation_id > 0){
            console.log('raj', creative_upload_links_allocation_id)
            document.getElementById('update_btn').style.display = "block";
        }else{
            console.log('umesh', creative_upload_links_allocation_id)
            document.getElementById('save_btn').style.display = "block";

        }

        // set creative_link
        var creative_link = null;
        const creative_link_td = "creative_link"+id;
        var creative_link = document.getElementById(creative_link_td).innerHTML;

        console.log('creative_link', creative_link)

        if(creative_link != null){
            document.querySelector('.creative_link').value = creative_link;
        }else{
            document.querySelector('.creative_link').value = '';
        }

        // set copy_link
        var copy_link = null;
        const copy_link_td = "copy_link"+id;
        var copy_link = document.getElementById(copy_link_td).innerHTML;

        console.log('copy_link', copy_link)

        if(copy_link != null){
            document.querySelector('.copy_link').value = copy_link;
        }else{
            document.querySelector('.copy_link').value = '';
        }

        const user_role = document.querySelector('.user_role').value;
        if(user_role == 'CD'){
            $("#cw_link_required").addClass('control-label required');
            document.querySelector('#modal_title').innerHTML = 'Creatives Uploading Panel - Copy Writers';

        }

        if(user_role == 'GD'){
            document.querySelector('#modal_title').innerHTML = 'Creatives Uploading Panel - Graphics Designers';
            $("#gd_link_required").addClass('control-label required');
        }

    }
</script>

<!-- validateForm script -->
<script>
    function validateForm(event) {
        console.log('testrequired')
        const user_role = document.querySelector('.user_role').value;
        console.log('user_role', user_role);

        if(user_role == 'CD'){
            const copy_link = document.querySelector('.copy_link').value;
            console.log('copy_link', copy_link)
            if(copy_link == '' || copy_link == undefined){
                alert('CW Link field is required');
                return false;
            }
        }

        if(user_role == 'GD'){
            const gd_link = document.querySelector('.creative_link').value;
            if(gd_link == '' || gd_link == undefined){
                alert('GD Link field is required');
                return false;
            }
        }

        return true;

        
    }
</script>

<!-- msg div script -->
<script>
    setTimeout(function(){
        document.getElementById('sub_msg_div').style.display = "none";
    },3000)
</script>

@endsection
