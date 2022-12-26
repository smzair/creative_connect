@extends('layouts.admin')

@section('title')
Catalogue - Submission
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

        .pointer{
            cursor: pointer;
        }


</style>
<div class="container-fluid mt-5 plan-shoot">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 2rem;">Catalogue - Submission</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <table id="qaTableCat" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th class="align-middle">ID</th>
                                <th class="align-middle" style="text-align: center">Company Name</th>
                                <th class="align-middle" style="text-align: center">Brand Name</th>
                                <th class="align-middle" style="text-align: center">Lot Number</th>
                                <th class="align-middle" style="text-align: center">WRC Number</th>
                                <th class="align-middle" style="text-align: center">Total SKY</th>
                                <th class="align-middle" style="text-align: center">Kind of Work</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($catalog_Wrc_list_for_Submission as $row)
                            @php
                                $wrc_id = $row['wrc_id'];
                                // $catalog_link_list = $row['catalog_link_list'];
                                // $catalog_link_arr = explode(",",$catalog_link_list);

                                // $copy_link_list = $row['copy_link_list'];
                                // $copy_link_arr = explode(",",$copy_link_list);
                                
                                // $allocation_ids = $row['allocation_ids'];
                                // $allocation_id_arr = explode(",",$allocation_ids);                                
                                // $tot_allocation_ids = count($allocation_id_arr);
                                
                                // $time_hash_ids = $row['time_hash_ids'];
                                // $time_hash_id_arr = explode(",",$time_hash_ids);
                                // $tot_time_hash_id = count($time_hash_id_arr);

                                $allow_to_submit = 0;
                                $btn_disable = "disabled";
                                $reworkbtn_disable = "";
                                $submit_check_disable = "disabled"; // checked
                                $submit_check_is_checked = ""; //
                                
                                if($wrc_id == 17) {
                                }
                                $wrc_id_is = $row['wrc_id'];
                                $wrc_id_is = ""; 

                                $company = $row['company'];
                                $sku_qty = $row['sku_qty'];
                                $brands_name = $row['brands_name'];
                                $lot_number = $row['lot_number'];
                                $wrc_number = $row['wrc_number'];
                                $kind_of_work = $row['kind_of_work']; 

                                $alloacte_to_copy_writer = $row['alloacte_to_copy_writer']; 
                                
                                $cataloger_allocated_qty = $row['cataloger_allocated_qty'];
                                $cp_allocated_qty = $row['cp_allocated_qty']; 

                                $catalog_links = $row['catalog_links'];
                                $copy_links = $row['copy_links'];
                                $user_roles = $row['user_roles'];
                                $allo_users_id = $row['allo_users_id'];
                                $allocated_users_name = $row['allocated_users_name'];
                            @endphp
                            <tr>
                                
                                <td>{{ $wrc_id }}</td>
                                <td>{{ $company }}</td>
                                <td>{{ $brands_name .$wrc_id_is }}</td>
                                <td>{{ $lot_number }}</td>
                                <td>{{ $wrc_number }}</td>
                                <td>{{ $sku_qty }}</td>
                                <td>{{ $kind_of_work }}</td>
                                {{-- <td>
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
                                    
                                </td> --}}
                                {{-- <td>
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
                                </td> --}}
                                {{-- <td>
                                    <div class="d-inline-block  switch">

                                        @if ($allow_to_submit == 0)
                                            <p style=" font-size: 1.1em; font-weight: 600; {{ $p_style }}">{{ $submit_msg }} 
                                                
                                            </p>
                                        @else
                                            <input  type="checkbox"  data-toggle="toggle" data-on="Submitted" data-off="Pending" data-onstyle="success" data-offstyle="warning" data-size="sm" data-width="100" class="toggle-class" >
                                            <button  id="btn{{ $wrc_id }}" class="{{ $btn_clsss }}" {{ $btn_disable }} onclick="submit_wrc('{{ $wrc_id }}')" >  {{ $submit_msg }} </button>
                                            
                                        @endif
                                    </div>
                                </td> --}}
                                <td>
                                    <div class="d-inline-block mt-1">
                                        {{-- {{ $reworkbtn_disable }} --}}

                                        <p class="d-none" id="data_id_{{ $wrc_id }}" 
                                        data-wrc_id="{{ $wrc_id }}" 
                                        data-company="{{ $company }}"  
                                        data-brands_name="{{ $brands_name }}"  
                                        data-lot_number="{{ $lot_number }}"  
                                        data-wrc_number="{{ $wrc_number }}"  
                                        data-sku_qty="{{ $sku_qty }}"  

                                        data-catalog_links="{{ $catalog_links }}"  
                                        data-copy_links="{{ $copy_links }}"  
                                        data-allo_users_id="{{ $allo_users_id }}"  
                                        data-allocated_users_name="{{ $allocated_users_name }}"  
                                        
                                        data-user_roles="{{ $user_roles }}"  
                                        data-alloacte_to_copy_writer="{{ $alloacte_to_copy_writer }}" 
                                        data-cataloger_allocated_qty="{{ $cataloger_allocated_qty }}" 
                                        data-cp_allocated_qty="{{ $cp_allocated_qty }}" 
                                        > </p>

                                        
                                        <button data-company="{{ $wrc_id }}" onclick="setdata('{{ $wrc_id }}')" class="btn btn-default py-1 mt-1" data-toggle="modal" data-target="#catalogueCommnentModal">
                                            To Submit
                                        </button>
                                    </div>
                                </td>
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
                    <h4 class="modal-title">Ready For Submission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="comment-form">
                        {{-- <div class="form-group">
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
                        </div> --}}
                        {{-- row 1 --}}
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="wrc_number">Wrc number</label>
                                <p id="wrc_number">Wrc number is</p>
                            </div>
                            <div class="col-3 form-group">
                                <label for="company">Company</label>
                                <p id="company">Company</p>
                            </div>
                            <div class="col-3 form-group">
                                <label for="brand_name">Brand</label>
                                <p id="brand_name">Wrc number is</p>
                            </div>
                            <div class="col-3 form-group">
                                <label for="tot_sku">Total Sky</label>
                                <p id="tot_sku">Wrc number is</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="allo_qty_to_cata">Allocated to Catalogure</label>
                                <p id="allo_qty_to_cata">Dummy qty 2</p>
                            </div>
                            <div id="copy_qty_div" class="col-6 form-group d-none">
                                <label for="allo_qty_to_copy">Allocated to Copy Writer</label>
                                <p id="allo_qty_to_copy"> D qty 5</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 form-group">
                                <table class="table table-head-fixed text-nowrap data-table" style="background: #d0cece; color: #000;    width: 90%;    margin-left: 5%;">
                                    <tr>
                                        <td style="width: 25%">Link To Catalogure</td>
                                        <td>
                                            <ul id="link_to_cata_logure">
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr id="copy_row" class="d-none">
                                        <td style="width: 25%">Link To Copy Writer</td>
                                        <td>
                                            <ul id="link_to_copy_writer">
                                                
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        {{-- 
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
                        --}}
                        <div id="msg_div" style="display: none;">
                            <p class="msg_box" id="msg_box"></p>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-warning"> Submit WRC</button>
                            {{-- <button onclick="save_data()" type="button" class="btn btn-warning">Comment</button> --}}
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
    function setdata(val){
        $("#copy_row").addClass("d-none");
        $("#copy_qty_div").addClass("d-none");
        const data_id = "data_id_"+val;
        const wrc_id = $("#"+data_id).data("wrc_id")
        const wrc_number = $("#"+data_id).data("wrc_number")
        const brand_name = $("#"+data_id).data("brands_name")
        const lot_number = $("#"+data_id).data("lot_number")
        const company = $("#"+data_id).data("company")
        const tot_sku = $("#"+data_id).data("sku_qty") 
        
        const catalog_links = $("#"+data_id).data("catalog_links")
        const copy_links = $("#"+data_id).data("copy_links")
        const allo_users_id = $("#"+data_id).data("allo_users_id")
        const allocated_users_name = $("#"+data_id).data("allocated_users_name")
        const user_roles = $("#"+data_id).data("user_roles")

        const alloacte_to_copy_writer = $("#"+data_id).data("alloacte_to_copy_writer")
        const cataloger_allocated_qty = $("#"+data_id).data("cataloger_allocated_qty")
        const cp_allocated_qty = $("#"+data_id).data("cp_allocated_qty")

        const catalog_link_arr = catalog_links.split(',')
        const copy_links_arr = copy_links.split(',')
        const user_roles_arr = user_roles.split(',')
        const allocated_users_arr = allocated_users_name.split(',')


        document.getElementById("wrc_number").innerHTML = wrc_number;
        document.getElementById("brand_name").innerHTML = brand_name;
        document.getElementById("company").innerHTML = company;
        document.getElementById("tot_sku").innerHTML = tot_sku;
        document.getElementById("allo_qty_to_cata").innerHTML = cataloger_allocated_qty;

        let catalog_li = "";
        let copy_li = "";
        // link_to_copy_writer link_to_cata_logure
        catalog_link_arr.forEach((link , index) => {
            console.log({link , index })
            if(link != ''){
                console.log(user_roles_arr[index])
                catalog_li +=   `<li class="pointer" title="uploaded by ${allocated_users_arr[index]} ${ user_roles_arr[index] == 0 ? '' : ' (Copy Writer)'} ">${link}</li>`
            }
        });

        if(alloacte_to_copy_writer === 1){
            copy_links_arr.forEach((link , index) => {
                console.log({link , index })
                if(link != ''){
                    console.log(user_roles_arr[index])
                    copy_li +=   `<li class="pointer" title="uploaded by ${allocated_users_arr[index]} ${ user_roles_arr[index] == 1 ? '' : ' (Catalogure)'} ">${link}</li>`
                }
            });
            document.getElementById("link_to_copy_writer").innerHTML = copy_li;
            document.getElementById("allo_qty_to_copy").innerHTML = cp_allocated_qty;

            $("#copy_row").removeClass("d-none");
            $("#copy_qty_div").removeClass("d-none");
        }
        console.log(catalog_li);
        // console.log({ catalog_links , copy_links , cataloger_allocated_qty , cp_allocated_qty , alloacte_to_copy_writer })
        // {{-- allo_qty_to_copy allo_qty_to_cata --}}
        
        document.getElementById("link_to_cata_logure").innerHTML = catalog_li;
    }
</script>


{{-- get user list for rework --}}
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

{{-- script for save data to rewrok  comments --}}
<script>
    async function save_data(){
        const wrc_id = document.querySelector("#wrc_id_is").value  
        const catalog_copy_user = document.querySelector("#catalog_copy_user").value  
        const comments = document.querySelector("#commentsec").value  
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
                comments : comments,
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