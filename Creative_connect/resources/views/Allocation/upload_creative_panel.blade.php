@extends('layouts.admin')

@section('title')

Designers Panel

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
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title">Designers Panel</h3>
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
                                <th>Assigned GD</th>
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
                                    <a href="javascript:;" class="btn btn-warning alloc-action-btn inactive" id="uploadBTn" data-toggle="modal" data-target="#editpanelPopup">
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

<div class="modal fade" id="editpanelPopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h4 class="modal-title">Uploading Panel - Creatives</h4>
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

<!-- End of New Editor Panel (For Creative) -->

<!-- End of New Allocation Details View -->

<script>
    $('.task-start-button .btn').click(function(){
      $(this).parent('.task-start-button').next('.task-start-timings').css('display', 'block');
      $(this).css('display', 'none');
      $(this).parents('td').siblings('td').find('.alloc-action-btn').removeClass('inactive');
    });
</script>

@endsection

<!-- End of New Allocation View -->