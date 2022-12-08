
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
                                <th>WRC Created At</th>
                                <th>Work Initiate Date</th>
                                <th>Work Committed Date</th>
                                <th>Project Type</th>
                                <th>Kind of Work</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allocationList as $lotinfo)
                            <tr>
                                <td>WRC-1234</td>
                                <td>{{$lotinfo['lot_id']}}</td>
                                <td>{{$lotinfo['Company']}}</td>
                                <td>Venkat Charan</td>
                                <td>{{count($lotinfo['wrcs'])}}</td>
                                <td>01-Dec-2022</td>
                                <td>01-Dec-2022</td>
                                <td>01-Dec-2022</td>
                                <td>Product Shoot</td>
                                <td>Not Applicable</td>
                                <td>
                                    <a href="javascript:;" class="btn btn-warning" id="allocateBTn" data-toggle="modal" data-target="#allocateWRCPopup">
                                        Allocate
                                    </a>
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
                        <div class="col-sm-4 col-12">
                            <div class="col-ac-details">
                                <h6>WRC Number</h6>
                                <p id="wrcNo">fneivnsdvi;msdol;dvm</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Quantity Count</h6>
                                <p id="QuntyCount">12312</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="col-ac-details">
                                <h6>Selected LOT</h6>
                                <p id="selLot">ODN11jidfv23e4r</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-dt-row allocater-selection">
                    <form class="" method="POST" action="" id="allocWRCform">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group custom-new-form-group">
                                    <div class="group-inner select-wrapper">
                                        <label class="control-label required">Graphic Designer 1</label>
                                        <select class="custom-select form-control-border designer-name" name="designerName1"  id="designerName1">
                                            <option selected>Select Graphic Designer</option>
                                            <option value="Sunil">Sunil</option>
                                            <option value="Sandeep">Sandeep</option>
                                            <option value="Raj">Sandeep</option>
                                            <option value="Rohit">Sandeep</option>
                                        </select>
                                    </div>
                                    <div class="group-inner input-wrapper">
                                        <label class="control-label">Qty</label>
                                        <input type="number" class="form-control" name="Qty" id="Qty">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group custom-new-form-group">
                                    <div class="group-inner select-wrapper">
                                        <label class="control-label required">Copy Writer 1</label>
                                        <select class="custom-select form-control-border copywriter-name" name="copywriterName1"  id="copywriterName1">
                                            <option selected>Select Copywriter</option>
                                            <option value="Shruti">Shruti</option>
                                            <option value="Kamna">Kamna</option>
                                            <option value="Tanya">Tanya</option>
                                            <option value="Ayushi">Ayushi</option>
                                        </select>
                                    </div>
                                    <div class="group-inner input-wrapper">
                                        <label class="control-label">Qty</label>
                                        <input type="number" class="form-control" name="Qty" id="Qty">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group custom-new-form-group">
                                    <div class="group-inner select-wrapper">
                                        <label class="control-label">Graphic Designer 2</label>
                                        <select class="custom-select form-control-border designer-name" name="designerName2"  id="designerName2">
                                            <option selected>Select Graphic Designer</option>
                                            <option value="Sunil">Sunil</option>
                                            <option value="Sandeep">Sandeep</option>
                                            <option value="Raj">Sandeep</option>
                                            <option value="Rohit">Sandeep</option>
                                        </select>
                                    </div>
                                    <div class="group-inner input-wrapper">
                                        <label class="control-label">Qty</label>
                                        <input type="number" class="form-control" name="Qty" id="Qty">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group custom-new-form-group">
                                    <div class="group-inner select-wrapper">
                                        <label class="control-label required">Copy Writer 2</label>
                                        <select class="custom-select form-control-border copywriter-name" name="copywriterName2"  id="copywriterName2">
                                            <option selected>Select Copy Writer</option>
                                            <option value="Shruti">Shruti</option>
                                            <option value="Kamna">Kamna</option>
                                            <option value="Tanya">Tanya</option>
                                            <option value="Ayushi">Ayushi</option>
                                        </select>
                                    </div>
                                    <div class="group-inner input-wrapper">
                                        <label class="control-label">Qty</label>
                                        <input type="number" class="form-control" name="Qty" id="Qty">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group custom-new-form-group">
                                    <div class="group-inner select-wrapper">
                                        <label class="control-label required">Graphic Designer 3</label>
                                        <select class="custom-select form-control-border designer-name" name="designerName3"  id="designerName3">
                                            <option selected>Select Graphic Designer</option>
                                            <option value="Sunil">Sunil</option>
                                            <option value="Sandeep">Sandeep</option>
                                            <option value="Raj">Sandeep</option>
                                            <option value="Rohit">Sandeep</option>
                                        </select>
                                    </div>
                                    <div class="group-inner input-wrapper">
                                        <label class="control-label">Qty</label>
                                        <input type="number" class="form-control" name="Qty" id="Qty" min="0" width="50px">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group custom-new-form-group">
                                    <div class="group-inner select-wrapper">
                                        <label class="control-label required">Copy Writer 3</label>
                                        <select class="custom-select form-control-border copywriter-name" name="copywriterName3"  id="copywriterName3">
                                            <option selected>Select Copy Writer</option>
                                            <option value="Shruti">Shruti</option>
                                            <option value="Kamna">Kamna</option>
                                            <option value="Tanya">Tanya</option>
                                            <option value="Ayushi">Ayushi</option>
                                        </select>
                                    </div>
                                    <div class="group-inner input-wrapper">
                                        <label class="control-label">Qty</label>
                                        <input type="number" class="form-control" name="Qty" id="Qty">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <a class="btn btn-warning" href="javascript:void(0)">Complete Allocation</a>
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
    $('#allocTable').DataTable({
        dom: 'lBfrtip',
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');
</script>

@endsection