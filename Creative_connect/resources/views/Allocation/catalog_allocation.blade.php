
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
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title">Catalog Allocation</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
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
                            @foreach($allocationList as $lotinfo)
                            <tr>
                                <td>WRC-1234</td>
                                <td>{$lotinfo['lot_id']}</td>
                                <td>{$lotinfo['Company']}</td>
                                <td>Venkat Charan</td>
                                <td>{count($lotinfo['wrcs'])}</td>
                                <td>01-Dec-2022</td>
                                <td>01-Dec-2022</td>
                                <td>01-Dec-2022</td>
                                <td>Product Shoot</td>
                                <td>Not Applicable</td>
                                <td>
                                    <a href="javascript:;" class="btn btn-warning" id="allocateBTnC" data-toggle="modal" data-target="#allocateWRCPopupCAt">
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
                <form class="" method="POST" action="" id="allocWRCform">
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
                                    <h6>SKU Count</h6>
                                    <p id="SKUCount">100</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="col-ac-details">
                                    <h6>Selected LOT</h6>
                                    <textarea rows="4" cols="4" style="width: 100%;" disabled>ODN-23456777</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-dt-row allocater-selection">  
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Allocate Cataloguer</label>
                                    <select class="custom-select form-control-border select2 Cataloguer-name" name="CataloguerName"  id="CataloguerName" style="width:100%;">
                                        <option selected>Select Cataloguer</option>
                                        <option value="Sunil">Sunil</option>
                                        <option value="Sandeep">Sandeep</option>
                                        <option value="Raj">Sandeep</option>
                                        <option value="Rohit">Sandeep</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <a class="btn btn-warning" href="javascript:void(0)">Complete Allocation</a>
                            </div>
                        </div>
                    </div>
                </form>
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
@endsection

<!-- End of Data Table Calling Function -->