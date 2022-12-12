
@extends('layouts.admin')

@section('title')

Creative Allocation

@endsection
@section('content')

<style type="text/css">
        .custom-new-form-group {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    .group-inner.select-wrapper {
        flex: 1 1 auto;
        max-width: 80%;
    }

    .group-inner.input-wrapper {
        flex: 0 0 auto;
        max-width: 20%;
        padding-left: 10px;
    }

    .custom-info {
        width: 100%;
        display: block;
        margin-top: 16px;
    }

    .custom-info p {
        margin: 0;
    }

    .info-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: block;
    }

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
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title">Creative Allocation</h3>
                    @if (Session::has('success'))
                        <div class="alert alert-success" id="msg_div" role="alert">
                            {{ Session::get('success') }}
                        </div>
                        {{ Session::forget('success') }}
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <table id="allocTable" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th>WRC</th>
                                <th>LOT Numbers</th>
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>Order Qty</th>
                                <th>Allocated Qty</th>
                                <th>Pending Qty</th>
                                <th>WRC Created At</th>
                                <th>Work Initiate Date</th>
                                <th>Work Committed Date</th>
                                <th>Project Type</th>
                                <th>Kind of Work</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allocationList['resData']  as $key => $lotinfo)
                            <tr>
                                <td id="wrc_number{{$key}}">{{$lotinfo['wrc_number']}}</td>
                                <td style="display: none;" id="wrc_number_id{{$key}}">{{$lotinfo['wrc_id']}}</td>
                                <td id="lot_number{{$key}}">{{$lotinfo['lot_number']}}</td>
                                <td id="Company{{$key}}">{{$lotinfo['Company']}}</td>
                                <td id="brand_name{{$key}}">{{$lotinfo['brand_name']}}</td>
                                <!-- <td>{{--count($lotinfo['wrcs'])--}}</td> -->
                                <td id="order_qty{{$key}}">{{$lotinfo['order_qty']}}</td>
                                <td id="allocated_qty{{$key}}">{{($lotinfo['allocated_qty'] == null || $lotinfo['allocated_qty'] == 0) ? 0 : $lotinfo['allocated_qty']}}</td>
                                <td id="pending_qty{{$key}}">{{$lotinfo['order_qty']- $lotinfo['allocated_qty']}}</td>
                                <td id="created_at{{$key}}">{{dateFormat($lotinfo->created_at)}}<br><b>{{timeFormat($lotinfo->created_at)}}</td>
                                <td id="work_initiate_date{{$key}}">{{dateFormat($lotinfo->work_initiate_date)}}<br><b>{{timeFormat($lotinfo->work_initiate_date)}}</b></td>
                                <td id="Comitted_initiate_date{{$key}}">{{dateFormat($lotinfo->Comitted_initiate_date)}}<br><b>{{timeFormat($lotinfo->Comitted_initiate_date)}}</b></td>
                                <td id="project_name{{$key}}">{{$lotinfo['project_name']}}</td>
                                <td id="kind_of_work{{$key}}">{{$lotinfo['kind_of_work']}}</td>
                                <td>
                                    <button class="btn btn-warning" id="allocateBTn" data-toggle="modal" data-target="#allocateWRCPopup" onclick='setdata(<?php echo $key;?>)'>
                                        Allocate
                                    </button>
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

<div class="modal fade allocation-wrc-modal" id="allocateWRCPopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h4 class="modal-title">Creative - Allocate WRC</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="custom-dt-row wrc-details">
                    <div class="row">
                        
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Quantity Count</h6>
                                <p class="QuntyCount"></p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Allocated Qty</h6>
                                <p class="AllocatedCount"></p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Pending Qty</h6>
                                <p class="PendingCount"></p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="col-ac-details">
                                <h6>WRC Number</h6>
                                <p class="wrcNo"></p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Selected LOT</h6>
                                <p class="selLot">ODN11jidfv23e4r</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-dt-row allocater-selection">
                    <form class="" method="POST" action="{{ route('CREATIVE_ALLOCATION_STORE') }}" id="allocWRCform" onsubmit="return validateForm(event)">
                        @csrf
                        <input type="hidden" name="wrc_id" class="wrc_id" value="" />
                        <?php
                            $reqArray = [1,2,3];

                            $graphicDesignerData = '<option selected value = 0>Select Graphic Designer</option>';
                            $copyWriterData = '<option selected value = 0>Select Copywriter</option>';    
                                                                 
                            foreach($allocationList['graphic_designer_users_data']  as $gkey => $gdata){
                                // dd($gdata->name);
                                $graphicDesignerData .= '<option value="'.$gdata->id.'">'.$gdata->name.'</option>';
                            }
                            foreach($allocationList['copy_writer_users_data']  as $ckey => $cdata){
                                $copyWriterData .= '<option value="'.$cdata->id.'">'.$cdata->name.'</option>';
                            }
                            $check = '';
                            foreach( $reqArray  as $data){
                               $check .= '<div class="col-sm-6 col-12">
                                    <div class="form-group custom-new-form-group">
                                        <div class="group-inner select-wrapper">
                                            <label class="control-label required">Graphic Designer '.$data.'</label>
                                            <select class="custom-select form-control-border designer-name" name="designerName[]" >
                                                 '.$graphicDesignerData.' 
                                            </select>
                                        </div>
                                        <div class="group-inner input-wrapper">
                                            <label class="control-label">Qty</label>
                                            <input type="number" class="form-control" id="GraphicDesignerQty" name="GraphicDesignerQty[]">
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group custom-new-form-group">
                                        <div class="group-inner select-wrapper">
                                            <label class="control-label required">Copy Writer '.$data.'</label>
                                            <select class="custom-select form-control-border copywriter-name" name="copywriterName[]">
                                             '.$copyWriterData.'
                                            </select>
                                        </div>
                                        <div class="group-inner input-wrapper">
                                            <label class="control-label">Qty</label>
                                            <input type="number" class="form-control" name="copyWriterQty[]" id="copyWriterQty">
                                        </div>  
                                    </div>
                                </div>';
                            }
                        ?>
                        <div class="row">
                            <?= $check ?>
                            <div class="col-sm-12 col-12">
                                <button type="submit" class="btn btn-sm btn-warning md-2" >Complete Allocation</button>
                            </div>
                            <p class="input_err" style="color: red; display: none;" id="total_allocated_qty_err"></p>
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
    $('#allocTable').DataTable({
        dom: 'lBfrtip',
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');
</script>

<!-- get dynamic data in modal -->
<script>
    function setdata(id){

        // set order qty
        const order_qty_td = "order_qty"+id;
        const order_qty = document.getElementById(order_qty_td).innerHTML;
        document.querySelector('.QuntyCount').innerHTML = order_qty;

        // set allocated qty
        const allocated_qty_td = "allocated_qty"+id;
        const allocated_qty = document.getElementById(allocated_qty_td).innerHTML;
        document.querySelector('.AllocatedCount').innerHTML = allocated_qty;

        // set Pending qty
        const pending_qty_td = "pending_qty"+id;
        const pending_qty = document.getElementById(pending_qty_td).innerHTML;
        document.querySelector('.PendingCount').innerHTML = pending_qty;

        // set wrc number
        const wrc_number_td = "wrc_number"+id;
        const wrc_number = document.getElementById(wrc_number_td).innerHTML;
        document.querySelector('.wrcNo').innerHTML = wrc_number;

        // set lot number
        const lot_number_td = "lot_number"+id;
        const lot_number = document.getElementById(lot_number_td).innerHTML;
        document.querySelector('.selLot').innerHTML = lot_number;
       
        // set wrc id
        const wrc_id_td = "wrc_number_id"+id;
        const wrc_id = document.getElementById(wrc_id_td).innerHTML;
        document.querySelector(".wrc_id").value = wrc_id
    }
</script>



<!-- msg div script -->
<script>
    setTimeout(function(){
        document.getElementById('msg_div').style.display = "none";
    },3000)
</script>


<!-- validateForm script -->
<script>
    function validateForm(event) {
        
        // event.preventDefault() // this will stop the form from submitting
        $(".input_err").css("display", "none");
        $(".input_err").html("");

        var GraphicDesignerQtyTotal = 0;
        var copyWriterQtyTotal = 0;

        var GraphicDesignerNameValues = $("select[name='designerName[]']")
        .map(function(){return $(this).val();}).get();

        var copyWriterNameValues = $("select[name='copywriterName[]']")
              .map(function(){return $(this).val();}).get();

        var GraphicDesignerQtyValues = $("input[name='GraphicDesignerQty[]']")
        .map(function(){return $(this).val();}).get();

        var copyWriterQtyValues = $("input[name='copyWriterQty[]']")
              .map(function(){return $(this).val();}).get();

        let gd = ''
        let gdq = ''
        let cw = ''
        let cwq = ''

        GraphicDesignerNameValues.find((val)=>{
            if(val == 0 || val == ''){
                return gd = 'All Graphic Designer Fields Are required'
                
            }
        })
        if(gd !== ''){
            return alert("All Graphic Designer Fields Are required"), false;
            
        }

        copyWriterNameValues.find((val)=>{
            if(val == 0 || val == ''){
                return cw = 'All Copy Writer Fields Are required'
            }
        })
        if(cw !== ''){
            return alert("All Copy Writer Fields Are required"), false;
        }

        GraphicDesignerQtyValues.find((val)=>{
            if(val == 0 || val == ''){
                return gdq = 'Qty All Fields Are required';
                
            }
        })

        if(gdq !== ''){
            return alert("Qty All Fields Are required"), false;
        }

        copyWriterQtyValues.find((val)=>{
            if(val == 0 || val == ''){
                return cwq = 'Qty All Fields Are required';
            }
        })
        if(cwq !== ''){
            return alert("Qty All Fields Are required"), false;
        }

        $(GraphicDesignerQtyValues).each(function (index, element) {
            GraphicDesignerQtyTotal = GraphicDesignerQtyTotal + Number(element);
        });
        $(copyWriterQtyValues).each(function (index, element) {
            copyWriterQtyTotal = copyWriterQtyTotal + Number(element);
        });

        const pending_qty = document.querySelector('.PendingCount').innerHTML;
        const validate_allocated_qty = (Number(copyWriterQtyTotal) + Number(GraphicDesignerQtyTotal));

        //The allocated quantity cannot be greater than the pending quantity
        if(validate_allocated_qty > pending_qty){
            alert("Sum of Qty cannot be greater than the pending quantity");
            return false
        }
        return true
        
    }
</script>
@endsection