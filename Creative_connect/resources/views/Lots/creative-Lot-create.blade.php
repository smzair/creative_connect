@extends('layouts.admin')

@section('title')
Create LOT

<!--- if condition to be applied for update details of the page-->
Update LOT
@endsection
@section('content')

<link rel="stylesheet" href="{{asset('plugins/datepicker-in-bootstrap-modal/css/datepicker.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    /* New Page Additional CSS  */

    .cc-title {
        margin-bottom: 20px;
        border-top: 1px solid #FFFF00;
        padding-top: 10px;
        margin-top: 10px;
    }

    /* End of New Page Additional CSS  */
</style> 
<div class="container-lg container-fluid my-5 lot-create-updateversion">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent m-0">
                <div class="card-body">
                    <!-- New Create Lot -->
                    <form method="POST" action="">
                        <input type="hidden" name="c_short" id="c_short" value="">
                        <input type="hidden" name="short_name" id="short_name" value="">
                        <div class="row custom-select-row">
                        @csrf
                            <input type="hidden" name="id" value="{id}">
                            <div class="col-sm-4">
                                 <div class="form-group">
                                    <label class="control-label required">Company Name</label>
                                    <select class="custom-select form-control-border select2 com " id="wrc_com" name="user_id"  aria-hidden="true" style="width: 100%;">
                                        <option value="None" selected>Select Company Name</option>
                                      
                                        <option value="">Company List</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label required">Brand Name</label>
                                    <select  class="form-control select2 brand" id="brand_id" name="brand_id"  data-placeholder = "Select Company">
                                        <option disabled selected>Please Select</option>
                                      
                                        <option value="{brand->id}" data-short_name = "{brand->short_name}">{brand->name}</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label required">Project Type</label>
                                    <select  class="form-control select2 brand" id="project_type" name="project_type"  data-placeholder = "Select Project Type">
                                        <option disabled selected>Select Project Type</option>
                                        
                                        <option  value="{brand->id}}" data-short_name = "{brand->short_name}}">{brand->name}</option>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" id="verticalTypeCol">
                                <div class="form-group">
                                    <label class="control-label required">Vertical Type</label>
                                    <select class="form-control" name="verticalType" id="verticalType">
                                        <option value="typeSelect" selected>Please select type</option>
                                        <option value="Reshoot">Reshoot</option>
                                        <option value="New Shoot">New Shoot</option>
                                        <option value="Editing">Editing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" id="clientBucketCol">
                                <div class="form-group">
                                    <label class="control-label required">Client Bucket</label>
                                    <select class="form-control client-bucket-select" name="clientBucket" id="clientBucket">
                                        <option value="selectClientBucket">Please select client bucket</option>
                                        <option value="New">New</option>
                                        <option value="Existing">Existing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label required">Work Initiate Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="intDate" id="intDate" placeholder="yyyy-mm-dd" data-toggle="datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label required">Work Committed Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="cmtDate" id="cmtDate" placeholder="yyyy-mm-dd" data-toggle="datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row custom-select-row">
                            <div class="col-sm-12 mb-3">
                               
                                <button type="submit" class="btn btn-sm btn-warning md-2" >Create Lot</button>
                          
                                <button type="submit" class="btn btn-sm btn-warning md-2" >Create Lot</button>
                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<script type="application/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script type="application/javascript" src="{{asset('plugins/datepicker-in-bootstrap-modal/js/datepicker.js')}}"></script>

<script src="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/js/plugins/mdb-file-upload.min.js"></script>

<script type="text/javascript">
 
 $('[data-toggle="datepicker"]').datepicker({
    autoHide: true,
    zIndex: 2048,
    format: 'yyyy-mm-dd'
});

</script>
@endsection
