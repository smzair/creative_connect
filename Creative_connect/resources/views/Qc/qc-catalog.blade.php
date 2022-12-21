@extends('layouts.admin')

@section('title')

Catalog Qc Panel

@endsection
@section('content')

<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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

    .msg_box{
            margin: 0.1em 0;
            background: #d3cdcdfc;
            padding: 0.3em;
        }


        .switch {
            position: relative; 
            display: inline-block;
            min-width: 60px;
            min-height: 34px;
        }
        
        .switch input { 
            opacity: 0; 
            min-width: 60px;
            min-height: 34px;
        }
        
       .switch .btn_success{
            background-color: #00ff00 !important;
            background: transparent;
            border: 1px solid  #00ff00;
            border-radius: 10%;
            color: #000;
        }

        .switch .btn_pending{
            background-color: #d1ff00 !important;
            /* background: transparent; */
            border: 1px solid #d1ff00; 
            border-radius: 10%;
        }


</style>
<div class="container-fluid mt-5 plan-shoot">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 2rem;">QC Approval - Catalogue</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <table id="qaTableCat" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th class="align-middle">WRC Number</th>
                                <th class="align-middle">Brand Name</th>
                                {{-- <th class="align-middle">Alloted to</th> --}}
                                <th class="align-middle">SKU Count</th>
                                <th class="align-middle" style="text-align: center">Catalogure</th>
                                <th class="align-middle" style="text-align: center">Copy</th>
                                <th class="align-middle">QC Status</th>
                                <th class="align-middle">Action</th>
                                {{-- <th class="align-middle">Commented</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($get_catalog_allocated_wrc_list as $qc)
                            @php
                                $catalog_link_list = $qc['catalog_link_list'];
                                $catalog_link_arr = explode(",",$catalog_link_list);

                                $copy_link_list = $qc['copy_link_list'];
                                $copy_link_arr = explode(",",$copy_link_list);
                                $wrc_id = $qc['wrc_id'];


                                // code for validate submit qc
                                
                                $allocation_ids = $qc['allocation_ids'];
                                $allocation_id_arr = explode(",",$allocation_ids);                                
                                $tot_allocation_ids = count($allocation_id_arr);
                                
                                $time_hash_ids = $qc['time_hash_ids'];
                                $time_hash_id_arr = explode(",",$time_hash_ids);
                                $tot_time_hash_id = count($time_hash_id_arr);

                                
                                $allow_to_submit = 0;
                                
                                if($tot_allocation_ids == $tot_time_hash_id){
                                    
                                    $task_status_is = $qc['task_status_is'];
                                    $task_status_arr = explode(",",$task_status_is);
                                    $tot_task_status = count($task_status_arr);
                                    $task_status_sum = array_sum($task_status_arr);
                                    
                                    if($task_status_sum == $tot_task_status){
                                        $allow_to_submit = 1;
                                    }
                                    
                                    if($task_status_sum > $tot_task_status){
                                        $allow_to_submit = 2;
                                        // foreach ($task_status_arr as $key => $task_status) {
                                        //     if($task_status );
                                        // }
                                    }
                                    // $wrc_id_is = " task_status_sum $task_status_sum , tot_task_status $tot_task_status";
                                }

                                $btn_disable = "disabled";
                                $submit_check_disable = "disabled"; // checked
                                $submit_check_is_checked = ""; //
                                
                                $btn_clsss = "";

                                $p_style = "color:red;";
                                if($allow_to_submit == 1){
                                    $btn_disable = "";
                                    $submit_check_disable = "";
                                    $submit_msg = "Pending";
                                    $p_style = "color:Yellow;";
                                    $btn_clsss = "btn_pending";
                                    
                                }else if ($allow_to_submit == 2) {
                                    $submit_check_disable = "disabled"; // checked
                                    $submit_check_is_checked = "checked"; 
                                    $submit_msg = "Wrc submited";
                                    $p_style = "color:green;";
                                    $btn_clsss = "btn_success";
                                }else{
                                    $submit_msg = "WRC not completed by users";
                                    $p_style = "color:red;";

                                    // $btn_disable = "";
                                }
                               
                                if($wrc_id == 17) {
                                    // pre($qc);
                                    // echo "catalog_link_arr "; pre($catalog_link_arr);
                                    // echo "copy_link_arr "; pre($copy_link_arr);
                                }
                                $wrc_id_is = $qc['wrc_id'];
                                $wrc_id_is = ""; 
                            @endphp
                            <tr>
                                <td>{{$qc['wrc_number']}}</td>
                                <td>{{$qc['brands_name'].$wrc_id_is }}</td>
                                {{-- <td>{{$qc['user_list']}}</td> --}}
                                <td>{{$qc['sku_qty']}}</td>
                                <td>
                                    <ul class="info-list">
                                        @foreach ($catalog_link_arr as $link)
                                            @if ($link != '')
                                                <li>
                                                    <a href="{{ $link }}" class="cpy-textVal" id="creativetextVal">
                                                    {{ $link }}
                                                    <span><i class="fas fa-copy"></i></span>
                                                    </a>
                                                </li>
                                            @endif  
                                        @endforeach
                                    </ul>
                                    
                                </td>
                                <td>
                                    <ul class="info-list">
                                        @foreach ($copy_link_arr as $link)
                                            @if ($link != '')
                                                <li>
                                                    <a href="{{ $link }}" class="cpy-textVal" id="creativetextVal">
                                                    {{ $link }}
                                                    <span><i class="fas fa-copy"></i></span>
                                                    </a>
                                                </li>
                                            @endif  
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-inline-block  switch">

                                        @if ($allow_to_submit == 0)
                                            <p style=" font-size: 1.1em; font-weight: 600; {{ $p_style }}">{{ $submit_msg }} 
                                                
                                            </p>
                                        @else
                                            <input  type="checkbox"  data-toggle="toggle" data-on="Submitted" data-off="Pending" data-onstyle="success" data-offstyle="warning" data-size="sm" data-width="100" class="toggle-class" >
                                            <button  id="btn{{ $wrc_id }}" class="{{ $btn_clsss }}" {{ $btn_disable }} onclick="submit_wrc('{{ $wrc_id }}')" >  {{ $submit_msg }} </button>
                                            
                                        @endif


                                        {{-- <input data-id="{{$sku['sku_id']}}" type="checkbox" checked data-toggle="toggle" data-on="Submitted" data-off="Pending" data-onstyle="success" data-offstyle="warning" data-size="sm" data-width="100" class="toggle-class"   {{ $sku['qc'] ? 'checked' : '' }}> --}}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block mt-1">
                                        <button onclick="setdata('{{ $wrc_id }}')"  {{ $btn_disable }} class="btn btn-default py-1 mt-1" data-toggle="modal" data-target="#catalogueCommnentModal">
                                            <i class="fas fa-comment mr-1" ></i>Rework
                                        </button>
                                    </div>
                                </td>

                                {{-- <td>
                                    <div class="d-inline-block mt-1">
                                        <a href="javascript:;" class="btn btn-default py-1 mt-1" data-toggle="modal" data-target="#catalogueCommnentModal"><i class="fas fa-comment mr-1"></i>Comment</a>
                                    </div>
                                </td> --}}
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal section --}}
    <div class="modal fade" id="catalogueCommnentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h4 class="modal-title">Comments</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="comment-form">
                        <div class="form-group">
                            <label class="control-label required">Category</label>
                            <div class="group-inner d-flex" >
                                <div class="radio-col w-25">
                                    <span class="checkVal">
                                        Catloger
                                    </span>
                                    <input onclick="get_list()" type="radio" name="role_id_is" id="check1" value="0" class="radio-check" checked>
                                </div>
                                <div class="radio-col">
                                    <span class="checkVal">
                                        Copy Writer
                                    </span>
                                    <input onclick="get_list()" type="radio" name="role_id_is" id="check2" value="1" class="radio-check">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <select name="catalog_copy_user" id="catalog_copy_user" >
                                <option value="0" data-catalog_allocation_id="0" > -- Select User -- </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="wrc_id" id="wrc_id_is" value="">
                            <label>Add a comment</label>
                            <textarea class="form-control" rows="4" name="commentsec" id="commentsec" placeholder="Enter your comment..."></textarea>
                        </div>
                        <div id="msg_div" style="display: none;">
                            <p class="msg_box" id="msg_box"></p>
                        </div>
                        <div class="form-group">
                            <button onclick="save_data()" type="button" class="btn btn-warning">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
    $(document).on('click', '.cpy-textVal', function () {
        var ValC = $(this).text().trim();

        var nwArray = [[`${ValC}`]];

        navigator.clipboard.writeText(nwArray).then(() => {
            $('.copy-msg').fadeIn(250);
            setTimeout(function () {
                $('.copy-msg').fadeOut(250);
            }, 1000);
        })
        .catch((err) => {
            alert("Error in copying text: ", err);
        });
    });

    $('#qaTableCat').DataTable({
        dom: 'lBfrtip',
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');

</script>


{{-- submit_wrc --}}

<script>

    function submit_wrc(id){
        console.log(id)
        const wrc_id = id


        $.ajax({
            url: "{{ url('completed-qc-wrc')}}",
            type: "POST",
            dataType: 'json',
            data: {
                wrc_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                res;

                if(res == 1){
                    alert('Qc Status Completed Successfully');
                    window.location.reload();
                }else{
                    alert('Somthing Went Wrong!!!');

                }
                

            }
        });

    }
</script>

{{-- script for setdata into modal  --}}
<script>
    async function setdata(val){
        const role_id_is = document.querySelector('input[name="role_id_is"]:checked').value;
        const wrc_id = val
        document.querySelector("#wrc_id_is").value = wrc_id
        document.querySelector("#commentsec").value = ""
        get_list();
    }
</script>

<script>
    async function get_list(){
        const wrc_id = document.querySelector("#wrc_id_is").value  
        const role_id_is = document.querySelector('input[name="role_id_is"]:checked').value;
        console.log({role_id_is , wrc_id})
        let options = `<option value="0" data-catalog_allocation_id="0" > -- Select User -- </option>`;
        await $.ajax({
            url: "{{ url('get-catalog-users_list')}}",
            type: "POST",
            dataType: 'json',
            data: {
                wrc_id : wrc_id,
                role_id_is : role_id_is,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                console.log(res)
                res.map(user => {
                    // console.log(user)
                    options += `<option value="${user.user_id}" data-catalog_allocation_id="${user.catalog_allocation_id}" > ${user.user_name} </option>`;
                })
            }
        });
        document.getElementById("catalog_copy_user").innerHTML = options;
    }
</script>

{{-- script for save data to rewrok --}}
<script>
    async function save_data(){
        const wrc_id = document.querySelector("#wrc_id_is").value  
        const catalog_copy_user = document.querySelector("#catalog_copy_user").value  
        const role_id_is = document.querySelector('input[name="role_id_is"]:checked').value;
        const catalog_allocation_id = $("#catalog_copy_user").find(':selected').data('catalog_allocation_id')
        console.warn({wrc_id,role_id_is,catalog_allocation_id ,catalog_copy_user})
        if(catalog_allocation_id == 0 || catalog_allocation_id ==''){
            alert('User Was Not Selected ');
            $("#catalog_copy_user").focus();
            return
        }
        await $.ajax({
            url: "{{ url('qc-rework')}}",
            type: "POST",
            dataType: 'json',
            data: {
                wrc_id : wrc_id,
                role_id_is : role_id_is,
                catalog_allocation_id : catalog_allocation_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if(res.status == 1){
                    $("#msg_box").css("color", "green");
                }else if(res.status == 2){
                    $("#msg_box").css("color", "Blue");
                    
                }else if(res.status == 3){
                    $("#msg_box").css("color", "Blue");
                    
                }else if(res.status == 4){
                    $("#msg_box").css("color", "Blue");
                }else{
                    $("#msg_box").css("color", "red");
                }
                document.querySelector("#msg_box").innerHTML = res.message
                $("#msg_div").css("display", "Block");
            }
        });
        setTimeout( () => {
            $("#msg_div").css("display", "none");
            $('#msg_box').html("");
        }, 3000);
    }
</script>
@endsection