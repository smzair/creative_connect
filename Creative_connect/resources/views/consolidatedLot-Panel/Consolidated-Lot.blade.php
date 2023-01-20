@extends('layouts.admin')
@section('title')
Consolidated-Lot Create
@endsection
@section('content')
    
<!-- New LOT Panel -->

<style>
	/* Lot New Panel Style  */

	.checkcontainer {
	    display: inline-block;
	    vertical-align: middle;
	}

	.checkcontainer:not(:last-child) {
	    margin-right: 15px;
	}

	.checkcontainer .checkmark {
	    display: inline-block;
	    vertical-align: top;
	}

	.checkcontainer input[type="checkbox"] {
	    position: relative;
	    top: 2px;
	    margin-left: 5px;
	    cursor: pointer;
	}

	.custom-check-row {
	    align-items: center;
	}

	.btn-form-group {
	    text-align: right;
	}

	.panel-accrodian-wrapper .fa-angle-left {
	    transition: all 0.5s ease-in-out;
	    float: right;
	    transform: rotate(-90deg);
	}

	.panel-accrodian-wrapper .accordian-item-wrapper .card.card-transparent .card-title {
	    width: 100%;
	}

	.panel-accrodian-wrapper .accordian-item-wrapper .card.card-transparent .card-header {
	    border: 0 !important;
	    cursor: pointer;
	}

	.panel-accrodian-wrapper .angle-top .fa-angle-left {
	    transform: rotate(90deg);
	}

	/* End of Lot New Panel Style */
</style>

<!-- Lot Creation New Panel -->

<div class="custom-lot-creation-panel">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="panel-inner-wrapper">
                    <div class="card card-transparent">
                        <div class="card-header">
                            <h3 class="card-title">LOT Creation</h3>
                        </div>
                        <div class="card-body">
                            <div class="custom-panel-form-group">
                                <form action="{{ route('create_consolidated_lot') }}" method="post" class="lot-panel-form" id="panelForm">
                                    @csrf
                                    <div class="row">
                                        <!-- Company Name -->
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label required">Company Name</label>
                                                <input type="hidden" name="id" value="{{$CreativeLots->id }}"> 
                                                <input type="hidden" name="c_short" id="c_short" value="">
                                                <input type="hidden" name="short_name" id="short_name" value="">
                                                <select class="custom-select form-control-border" id="user_id" name="user_id"  aria-hidden="true" style="width: 100%;">
            
                                                    <option value="" selected>Select Company Name</option>
                                                    @foreach ($users_data as $user)
                                                        <option value="{{ $user->id }}" data-c_short="{{ $user->c_short }}">
                                                            {{ $user->Company ." (" . $user->name.")" }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <script type="text/javascript">
                                                    document.querySelector("#user_id").value = "{{$CreativeLots->user_id }}"
                                                </script>
                                                <p class="input_err" style="color: red; display: none;" id="user_id_err"></p>
                                                @error('user_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Brand Name -->
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label required">Brand Name</label>
                                                <select  class="form-control  brand" id="brand_id" name="brand_id"  data-placeholder = "Select Company" id="brands">
                                                    <option value="">Please Select</option>
                                                </select>
                                                <script type="text/javascript">
                                                    document.querySelector("#brand_id").value = "{{$CreativeLots->brand_id }}"
                                                </script>
                                                <p class="input_err" style="color: red; display: none;" id="brand_id_err"></p>
                                                @error('brand_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row custom-check-row">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label required">Select Services to generate LOT*</label>
                                                <div class="custom-two-check">
                                                    <div class="checkcontainer">
                                                        <input type="checkbox" class="" name="shootcheck" id="shootcheck">
                                                        <span class="checkmark"></span>
                                                        Shoot
                                                    </div>
                                                    <div class="checkcontainer">
                                                        <input type="checkbox" class="" name="cgcheck" id="cgcheck">
                                                        <span class="checkmark"></span>
                                                        Creative Graphics
                                                    </div>
                                                    <div class="checkcontainer">
                                                        <input type="checkbox" class="" name="catcheck" id="catcheck">
                                                        <span class="checkmark"></span>
                                                        Cataloging
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="btn-form-group">
                                                <div class="custom-action-btn-wrapper">
                                                    {{-- <a href="javascript:;" class="btn btn-warning" id="genLotBTN">
                                                        Generate LOT
                                                    </a> --}}
                                                    <button type="submit" class="btn btn-sm btn-warning md-2" id="genLotBTN">Generate LOT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-accrodian-wrapper">
                    <div class="accordian-item-wrapper" id="accordionPanel">
                        <div class="accordian-item" id="shoot-accor-item" style="display:block;">
                            <div class="card card-transparent">
                                <div class="card-header acc-card-header" id="shootAccor" data-toggle="collapse" data-target="#shootcollapse" aria-expanded="true" aria-controls="shootcollapse">
                                    <h3 class="card-title">
                                        <span class="card-text">
                                        Shoot
                                        </span>
                                        <i class="right fas fa-angle-left"></i>
                                    </h3>
                                </div>
                                <div id="shootcollapse" class="collapse" aria-labelledby="shootAccor" data-parent="#accordionPanel">
                                    <div class="card-body">
                                        <form action="" method="post" id="shootForm">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Type of Service</label>
                                                        <select class="custom-select form-control-border" name="servicesType" id="servicesType">
                                                            <option selected>Select Type of Service</option>
                                                            <option value="Service 1">Service 1</option>
                                                            <option value="Service 2">Service 2</option>
                                                            <option value="Service 3">Service 3</option>
                                                            <option value="Service 4">Service 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Location</label>
                                                        <select class="custom-select form-control-border" name="locationType" id="locationType">
                                                            <option selected>Select Location</option>
                                                            <option value="Location 1">Location 1</option>
                                                            <option value="Location 2">Location 2</option>
                                                            <option value="Location 3">Location 3</option>
                                                            <option value="Location 4">Location 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Vertical Type</label>
                                                        <select class="custom-select form-control-border" name="verticalType" id="verticalType">
                                                            <option selected>Select Vertical Type</option>
                                                            <option value="Vertical Type 1">Vertical Type 1</option>
                                                            <option value="Vertical Type 2">Vertical Type 2</option>
                                                            <option value="Vertical Type 3">Vertical Type 3</option>
                                                            <option value="Vertical Type 4">Vertical Type 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Client Bucket</label>
                                                        <select class="custom-select form-control-border" name="clientBucket" id="clientBucket">
                                                            <option selected>Select Client Bucket</option>
                                                            <option value="Client Bucket 1">Client Bucket 1</option>
                                                            <option value="Client Bucket 2">Client Bucket 2</option>
                                                            <option value="Client Bucket 3">Client Bucket 3</option>
                                                            <option value="Client Bucket 4">Client Bucket 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="btn-form-group">
                                                        <div class="custom-action-btn-wrapper">
                                                            <a href="javascript:;" class="btn btn-warning" id="shsaveBTN">
                                                                Save
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordian-item" id="cg-accor-item" style="display:block;">
                            <div class="card card-transparent">
                                    <div class="card-header acc-card-header" id="cgAccor" data-toggle="collapse" data-target="#cgcollapse" aria-expanded="true" aria-controls="cgcollapse">
                                        <h3 class="card-title">
                                            <span class="card-text">
                                            Creative Graphics
                                            </span>
                                            <i class="right fas fa-angle-left"></i>
                                        </h3>
                                    </div>
                                    <div id="cgcollapse" class="collapse" aria-labelledby="cgAccor" data-parent="#accordionPanel">
                                        <div class="card-body">
                                            <form action="" method="post" id="cgForm">
                                                <div class="row">
                                                    <div class="col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Project Name</label>
                                                            <select class="custom-select form-control-border" name="projectName" id="projectName">
                                                                <option selected>Enter Project Name</option>
                                                                <option value="Project Name 1">Project Name 1</option>
                                                                <option value="Project Name 2">Project Name 2</option>
                                                                <option value="Project Name 3">Project Name 3</option>
                                                                <option value="Project Name 4">Project Name 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Vertical Type</label>
                                                            <select class="custom-select form-control-border" name="verticalType" id="verticalType">
                                                                <option selected>Select Vertical Type</option>
                                                                <option value="Vertical Type 1">Vertical Type 1</option>
                                                                <option value="Vertical Type 2">Vertical Type 2</option>
                                                                <option value="Vertical Type 3">Vertical Type 3</option>
                                                                <option value="Vertical Type 4">Vertical Type 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Client Bucket</label>
                                                            <select class="custom-select form-control-border" name="clientBucket" id="clientBucket">
                                                                <option selected>Select Client Bucket</option>
                                                                <option value="Client Bucket 1">Client Bucket 1</option>
                                                                <option value="Client Bucket 2">Client Bucket 2</option>
                                                                <option value="Client Bucket 3">Client Bucket 3</option>
                                                                <option value="Client Bucket 4">Client Bucket 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">LOT Delivery Days</label>
                                                            <select class="custom-select form-control-border" name="deliveryDays" id="deliveryDays">
                                                                <option selected>Enter LOT Delivery Days</option>
                                                                <option value="23">10</option>
                                                                <option value="12">12</option>
                                                                <option value="34">34</option>
                                                                <option value="67">67</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="btn-form-group">
                                                            <div class="custom-action-btn-wrapper">
                                                                <a href="javascript:;" class="btn btn-warning" id="cgsaveBTN">
                                                                    Save
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="accordian-item" id="ct-accor-item" style="display:block;">
                            <div class="card card-transparent">
                                <div class="card-header acc-card-header" id="ctAccor" data-toggle="collapse" data-target="#ctcollapse" aria-expanded="true" aria-controls="ctcollapse">
                                    <h3 class="card-title">
                                        <span class="card-text">
                                        Cataloging
                                        </span>
                                        <i class="right fas fa-angle-left"></i>
                                    </h3>
                                </div>
                                <div id="ctcollapse" class="collapse" aria-labelledby="ctAccor" data-parent="#accordionPanel">
                                    <div class="card-body">
                                        <form action="" method="post" id="ctForm">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Type of Service</label>
                                                        <select class="custom-select form-control-border" name="servicesType" id="servicesType">
                                                            <option selected>Select Type of Service</option>
                                                            <option value="Service 1">Service 1</option>
                                                            <option value="Service 2">Service 2</option>
                                                            <option value="Service 3">Service 3</option>
                                                            <option value="Service 4">Service 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Request Type</label>
                                                        <select class="custom-select form-control-border" name="requestType" id="requestType">
                                                            <option selected>Select Request Type</option>
                                                            <option value="Request Type 1">Request Type 1</option>
                                                            <option value="Request Type 2">Request Type 2</option>
                                                            <option value="Request Type 3">Request Type 3</option>
                                                            <option value="Request Type 4">Request Type 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Request Received Date</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="reqDate" id="reqDate" placeholder="yyyy-mm-dd" data-toggle="datepicker">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label required">Raw Image Receive Date</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="rawimgDate" id="rawimgDate" placeholder="yyyy-mm-dd" data-toggle="datepicker">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="btn-form-group">
                                                        <div class="custom-action-btn-wrapper">
                                                            <a href="javascript:;" class="btn btn-warning" id="ctsaveBTN">
                                                                Save
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

<!-- Lot Creation New Panel -->

<script type="text/javascript">

	$('.acc-card-header').click(function(){
        $(this).toggleClass('angle-top');
        $(this).parents('.accordian-item').siblings('.accordian-item').find('.acc-card-header').removeClass('angle-top');
    });

    // Display Shoot Accodian
    $("#shootcheck").change(function () {
        if (this.checked) {
            $('#shoot-accor-item').css('display', 'block');
        } else if (!this.checked) {
            $('#shoot-accor-item').css('display', 'none');
        }
    });

    // Display Creative Accodian
    $("#cgcheck").change(function () {
        if (this.checked) {
            $('#cg-accor-item').css('display', 'block');
        } else if (!this.checked) {
            $('#cg-accor-item').css('display', 'none');
        }
    });

    // Display Catalog Accodian
    $("#catcheck").change(function () {
        if (this.checked) {
            $('#ct-accor-item').css('display', 'block');
        } else if (!this.checked) {
            $('#ct-accor-item').css('display', 'none');
        }
    });
	
</script>

<!-- script for setting short_name -->

<script type="text/javascript">
    $("#brand_id").change(function() { 
        const short_name = $("#brand_id").find(':selected').data('short_name');
            $("#short_name").val(short_name);
    });
</script>



<!-- Select Brand Name -->
<script type="text/javascript">
    $(document).ready(function() {

        $("#user_id").change(function() {

            const user_id_is = $("#user_id").val();
            console.log('user_id_is', user_id_is)
            const c_short = $("#user_id").find(':selected').data('c_short');
            $("#c_short").val(c_short);


            let options = `<option value="" data-short_name="" > -- Select Brand Name -- </option>`;
            $.ajax({
                url: "{{ url('get-brand') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    user_id: user_id_is,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res)
                    res.map(brands => {
                        options +=
                            ` <option value="${brands.brand_id}" data-short_name="${brands.short_name}"> ${brands.name}</option>`;
                    })
                    console.log(options)
                    document.getElementById("brand_id").innerHTML = options;

                }
            });
            setTimeout(()=>{
                document.querySelector("#brand_id").value = "<?= $CreativeLots->brand_id ?>"
            },1000)
        });
    })
</script>
@endsection
