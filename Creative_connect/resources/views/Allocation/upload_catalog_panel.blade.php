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
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <table id="allocTableCat" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th>WRC Number</th>
                                <th>Company Name</th>
                                <th>Brand Name</th>
                                <th>SKU Count</th>
                                <th>Assigned Cataloguer</th>
                                <th>Guidelines Links</th>
                                <th>Task Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allocationList as $lotinfo)
                            <tr>
                                <td>WRC-1234</td>
                                <td>Tital</td>
                                <td>Venkat Charan</td>
                                <td>300</td>
                                <td>
                                  <ul class="info-list">
                                    <li><span class="gd-name">Tanya</span></li>
                                    <li><span class="gd-name">Sunil</span></li>
                                    <li><span class="gd-name">Rohit</span></li>
                                    <li><span class="gd-name">Shruti</span></li>
                                  </ul>
                                </td>
                                <td>
                                  <ul class="info-list">
                                    <li><a href="#" class="work-link">cascv vsdnvksjdv vaeflj</a></li>
                                    <li><a href="#" class="work-link">cascv vsdnvksjdv vaeflj</a></li>
                                    <li><a href="#" class="work-link">cascv vsdnvksjdv vaeflj</a></li>
                                    <li><a href="#" class="work-link">cascv vsdnvksjdv vaeflj</a></li>
                                  </ul>
                                </td>
                                <td>
                                  <div class="task-action task-start-button">
                                    <a href="javascript:;" class="btn btn-warning" id="startBTN">
                                      Start
                                    </a>
                                  </div>
                                  <div class="task-action task-start-timings" style="display:none;">
                                    <span class="date">20-oct-2022</span>
                                    <span class="time">05:48:08 AM</span>
                                  </div>
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-warning alloc-action-btn inactive" id="uploadBTn" data-toggle="modal" data-target="#editpanelPopupCat">
                                        Upload
                                    </a>
                                    <a href="javascript:;" class="btn btn-warning alloc-action-btn inactive" id="editBTn">
                                        Edit
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
                            <div class="col-sm-6 col-12">
                                <a class="btn btn-warning" href="javascript:void(0)" style="float:right;">Complete Allocation</a>
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
          "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
          "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');

    $('.task-start-button .btn').click(function(){
      $(this).parent('.task-start-button').next('.task-start-timings').css('display', 'block');
      $(this).css('display', 'none');
      $(this).parents('td').siblings('td').find('.alloc-action-btn').removeClass('inactive');
    });
</script>
endsection