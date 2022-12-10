
@extends('layouts.admin')

@section('title')
Catalogin Allocation

<!--- if condition to be applied for update details of the page-->
Update LOT
@endsection
@section('content')
<!-- New Allocation View -->

<!-- New Allocation Table View (For Catalogue) -->

<div class="container-fluid mt-5 plan-shoot new-allocation-table-main">
     <style>
        .form-group .input_err , #msg_box{
            margin: 0.1em 0;
            color: red;
            background: #928c8cfc;
            display: block;
            padding: 0.3em;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title">Catalog Allocation</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">

                    {{-- getCataloguer --}}

                    @php
                        $getCataloguer = getCataloguer();
                        // pre($getCataloguer);
                    @endphp
                    <table id="allocTableC" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th>WRC</th>
                                <th>LOT Numbers</th>
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>SKU Count</th>
                                <th>WRC Created At</th>
                                <th>Request Receive Date</th>
                                <th>Raw Image Receive Date</th>
                                <th>Marketplace</th>
                                <th>Type of Service</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                // pre($wrcList);
                            @endphp
                            @foreach($wrcList as $key => $row)

                            <tr id="tr{{ $key }}" >
                                <td data-value="wrc_number">
                                    {{ $row['wrc_number'] }}
                                </td>
                                <td data-value="lot_number">{{ $row['lot_number'] }}</td>
                                <td data-value="Company">{{ $row['Company'] }}</td>
                                <td data-value="name">{{ $row['name'] }}
                                    <input type="hidden" id="wrc_id{{ $key }}" value="{{ $row['id'] }}">
                                </td>
                                <td data-value="sku_qty">{{ $row['sku_qty'] }}</td>
                                <td data-value="wrc_cr_at">{{ dateFormet_dmy($row['created_at']) }}</td>
                                <td data-value="img_recevied_date">{{ dateFormet_dmy($row['img_recevied_date']) }}</td>
                                <td data-value="raw_img_date">{{ dateFormet_dmy($row['created_at']) }}</td>
                                <td data-value="market_place">{{ $row['market_place'] }}</td>
                                <td data-value="type_of_service">{{ $row['type_of_service'] }}</td>
                                <td>
                                    <button class="btn btn-warning" id="allocateBTnC" data-toggle="modal" 
                                    data-target="#allocateWRCPopupCAt" onclick="setvalue({{ $key }})">
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

<div class="modal fade allocation-wrc-modal" id="allocateWRCPopupCAt">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h4 class="modal-title">Shoot Allocation WRC</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form class="" method="POST" action="" id="allocWRCform"> --}}
                    <div class="custom-dt-row wrc-details">
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="col-ac-details">
                                    <h6>WRC Number</h6>
                                    <p id="wrcNo"></p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>SKU Count</h6>
                                    <p id="sku_qty"></p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>Selected LOT</h6>
                                    <textarea id="lot_number" rows="3" cols="4" style="width: 100%;" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-dt-row allocater-selection">  
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Allocate Cataloguer</label>
                                    <select class="custom-select form-control-border Cataloguer-name" name="CataloguerName"  id="CataloguerName" style="width:100%;">
                                        <option value="">--Select Cataloguer--</option>
                                        @foreach ($getCataloguer as $row)
                                            <option value="{{ $row->id }}" data-name="{{ $row->name }}">{{ $row->name }}</option>
                                        
                                        @endforeach
                                        {{-- <option value="2">Sandeep</option>
                                        <option value="3">Sandeep</option>
                                        <option value="4">Sandeep</option> --}}
                                    </select>
                                    <p class="input_err" style="color: red; display: none;" id="user_id_err"></p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <input id="wrc_id" name="wrcNo" type="hidden" value="">
                                <button class="btn btn-warning" onclick="saveData()" >Complete Allocation</button>
                                <span id="msg_box" style="color: red; display: none;"></span>
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
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

<!-- Data Table Calling Function -->

<script>
  $('#allocTableC').DataTable({
        dom: 'lBfrtip',
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "buttons": ["copy", "csv", "excel", "pdf"]
  }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');
</script>


{{-- setvalue to model --}}
<script>
    function setvalue(val){
        // 
        let data = {}
        var rowItems = $("#tr"+val).children('td').map(function () {
            data = {
                ...data,
                [this.getAttribute('data-value')]: this.innerHTML
            }
        })

        document.querySelector("#wrcNo").innerHTML = data.wrc_number
        document.querySelector("#sku_qty").innerHTML = data.sku_qty
        document.querySelector("#lot_number").innerHTML = data.lot_number
        document.querySelector("#wrc_id").value =  document.querySelector("#wrc_id"+val).value 
        console.log(data)
    }
   
</script>

{{-- save Data to allocation   --}}
<script>
    const saveData = async () => {
        //   const wrc_number =  document.querySelector("#wrcNo").innerHTML 
        //   const sku_qty =  document.querySelector("#sku_qty").innerHTML 
        //   const lot_number =  document.querySelector("#lot_number").innerHTML 
        const user_id_is =  document.querySelector("#CataloguerName").value 
        const wrc_id =  document.querySelector("#wrc_id").value 
        const CataloguerName = $("#CataloguerName").find(':selected').data('name')

         $(".input_err").css("display", "none");
        if(user_id_is === ''){
            document.querySelector("#user_id_err").innerHTML  = "User not selected"
            $(".input_err").css("display", "block");
            return
        }

        await $.ajax({
            url: "{{ url('set-catalog-allocation') }}",
            type: "POST",
            dataType: 'json',
            data: {
                user_id: user_id_is,
                wrc_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {

                if(res == 1){
                    document.querySelector("#CataloguerName").value = "";
                    $("#msg_box").css("color", "green");
                    document.querySelector("#msg_box").innerHTML  = "Catalog Wrc allocated to "+CataloguerName+" Successfully"
                }else if(res == 2){
                    document.querySelector("#CataloguerName").value = "";
                    $("#msg_box").css("color", "red");
                    document.querySelector("#msg_box").innerHTML  = "This Wrc already allocated to "+CataloguerName;
                }else{
                    $("#msg_box").css("color", "red");
                    document.querySelector("#msg_box").innerHTML  = "Somthing went Wrong please try again!!!"
                }
                $("#msg_box").css("display", "block");
            }
        });
        setTimeout( () => {
            $("#msg_box").css("color", "red");
            $('#msg_box').html("");
            $("#msg_box").css("display", "none");
        }, 2000);
    }
</script>
@endsection

<!-- End of Data Table Calling Function  -->