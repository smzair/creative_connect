@extends('layouts.admin')
@section('title')
    Create New Commercial for Creative
@endsection
@section('content')
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
    <!-- Commercial Panel -->
    <div class="custom-commercial-creation-panel">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="panel-inner-wrapper">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <h3 class="card-title">Add Commercial</h3>
                                <a style="float: right;" class="btn btn-success swalDefaultSuccess" href="{{route('ViewNewCommercial')}}">View All New Commercials</a>
                            </div>

                            @php
                                $users = getUserCompanyData();
                                // pre($users);
                            @endphp
                            <div class="card-body">
                                {{-- sucsses and false msg div --}}
                                <div id="msg_div">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if (Session::has('false'))
                                        <div class="alert alert-false" role="alert">
                                            {{ Session::get('false') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="custom-panel-form-group">
                                    <form action="{{route('SaveNewCommercial')}}" method="post" class="comm-panel-form" id="panelForm2">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="c_short" id="c_short" value="">
                                                    <input type="hidden" name="short_name" id="short_name" value="">
                                                    <label class="control-label required">Company Name</label>
                                                    <select class="custom-select form-control-border"
                                                        name="commCompanyId" id="commcompanyNameP">
                                                        <option value="0">Select Company Name</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}"
                                                                data-client_id="{{ $user->client_id }}" data-c_short="{{ $user->c_short }}">
                                                                {{ $user->Company . ' (' . $user->client_id . ')' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label class="control-label required">Brand Name</label>
                                                    <select class="custom-select form-control-border" name="commBrandId"
                                                        id="commbrandNameP">
                                                        <option value="0"  data-short_name="" > -- Select Brand Name -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label class="control-label required">Client ID</label>
                                                    <input readonly type="text" class="form-control" name="commClientID"
                                                        id="commClientID" placeholder="Client ID"
                                                        value="{{ $newCommercial->commClientID }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row custom-check-row">
                                            <div class="col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label required">Select Service(s) to generate
                                                        Commercial</label>
                                                    <div class="custom-two-check">
                                                        <div class="checkcontainer">
                                                            <input type="checkbox" class="panel-checkbox" name="commshootcheck" id="commshootcheck" value="1">
                                                            <span class="checkmark"></span>
                                                            Shoot
                                                        </div>
                                                        <div class="checkcontainer">
                                                            <input type="checkbox" class="panel-checkbox" name="commcgcheck" id="commcgcheck" value="1">
                                                            <span class="checkmark"></span>
                                                            Creative Graphics
                                                        </div>
                                                        <div class="checkcontainer">
                                                            <input type="checkbox" class="panel-checkbox" name="commcatcheck" id="commcatcheck" value="1">
                                                            <span class="checkmark"></span>
                                                            Cataloging
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="btn-form-group">
                                                    <div class="custom-action-btn-wrapper">
                                                        <button type="submit" class="btn btn-warning" id="genCommBTN">
                                                            Create Commercial
                                                        </button>
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
                        <div class="accordian-item-wrapper" id="commaccordionPanel">
                            <div class="accordian-item" id="commshoot-accor-item" style="display:none;">
                                <div class="card card-transparent">
                                    <div class="card-header acc-card-header" id="commshootAccor" data-toggle="collapse"
                                        data-target="#commshootcollapse" aria-expanded="true"
                                        aria-controls="commshootcollapse">
                                        <h3 class="card-title">
                                            <span class="card-text">
                                                Shoot
                                            </span>
                                            <i class="right fas fa-angle-left"></i>
                                        </h3>
                                    </div>
                                    <div id="commshootcollapse" class="collapse" aria-labelledby="commshootAccor"
                                        data-parent="#commaccordionPanel">
                                        <div class="card-body">
                                            <form action="" method="post" id="commshootForm">
                                                <div class="row">
                                                    <div class="col-sm-3 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Product Category</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commproductCat" id="commproductCat">
                                                                <option selected>Select Product Category</option>
                                                                <option value="Product 1">Product 1</option>
                                                                <option value="Product 2">Product 2</option>
                                                                <option value="Product 3">Product 3</option>
                                                                <option value="Product 4">Product 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Type of Shoot</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commshootType" id="commshootType">
                                                                <option selected>Select Type of Shoot</option>
                                                                <option value="Shoot 1">Shoot 1</option>
                                                                <option value="Shoot 2">Shoot 2</option>
                                                                <option value="Shoot 3">Shoot 3</option>
                                                                <option value="Shoot 4">Shoot 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Type of Clothing</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commclothingType" id="commclothingType">
                                                                <option selected>Select Type of Clothing</option>
                                                                <option value="Type of Clothing 1">Type of Clothing 1
                                                                </option>
                                                                <option value="Type of Clothing 2">Type of Clothing 2
                                                                </option>
                                                                <option value="Type of Clothing 3">Type of Clothing 3
                                                                </option>
                                                                <option value="Type of Clothing 4">Type of Clothing 4
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Gender</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commGender" id="commGender">
                                                                <option selected>Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Primary
                                                                Adaptation</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commPAdpt" id="commPAdpt">
                                                                <option selected>Select Primary Adaptation</option>
                                                                <option value="Primary Adaptation 1">Primary Adaptation 1
                                                                </option>
                                                                <option value="Primary Adaptation 2">Primary Adaptation 2
                                                                </option>
                                                                <option value="Primary Adaptation 3">Primary Adaptation 3
                                                                </option>
                                                                <option value="Primary Adaptation 4">Primary Adaptation 4
                                                                </option>
                                                                <option value="Primary Adaptation 5">Primary Adaptation 5
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Adaptation 1</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commAdpt1" id="commAdpt1">
                                                                <option selected>Select Adaptation 1</option>
                                                                <option value="Adaptation 1">Adaptation 1</option>
                                                                <option value="Adaptation 2">Adaptation 2</option>
                                                                <option value="Adaptation 3">Adaptation 3</option>
                                                                <option value="Adaptation 4">Adaptation 4</option>
                                                                <option value="Adaptation 5">Adaptation 5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Adaptation 2</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commAdpt2" id="commAdpt2">
                                                                <option selected>Select Adaptation 2</option>
                                                                <option value="Adaptation 1">Adaptation 1</option>
                                                                <option value="Adaptation 2">Adaptation 2</option>
                                                                <option value="Adaptation 3">Adaptation 3</option>
                                                                <option value="Adaptation 4">Adaptation 4</option>
                                                                <option value="Adaptation 5">Adaptation 5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Adaptation 3</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commAdpt3" id="commAdpt3">
                                                                <option selected>Select Adaptation 3</option>
                                                                <option value="Adaptation 1">Adaptation 1</option>
                                                                <option value="Adaptation 2">Adaptation 2</option>
                                                                <option value="Adaptation 3">Adaptation 3</option>
                                                                <option value="Adaptation 4">Adaptation 4</option>
                                                                <option value="Adaptation 5">Adaptation 5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Adaptation 4</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commAdpt4" id="commAdpt4">
                                                                <option selected>Select Adaptation 4</option>
                                                                <option value="Adaptation 1">Adaptation 1</option>
                                                                <option value="Adaptation 2">Adaptation 2</option>
                                                                <option value="Adaptation 3">Adaptation 3</option>
                                                                <option value="Adaptation 4">Adaptation 4</option>
                                                                <option value="Adaptation 5">Adaptation 5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Commercial per
                                                                SKU</label>
                                                            <input type="text" class="form-control" name="commSKU"
                                                                id="commSKU" placeholder="Enter Commercial per SKU">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="btn-form-group">
                                                            <div class="custom-action-btn-wrapper">
                                                                <a href="javascript:;" class="btn btn-warning"
                                                                    id="commshsaveBTN">
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
                            <div class="accordian-item" id="commcg-accor-item" style="display:none;">
                                <div class="card card-transparent">
                                    <div class="card-header acc-card-header" id="commcgAccor" data-toggle="collapse"
                                        data-target="#commcgcollapse" aria-expanded="true"
                                        aria-controls="commcgcollapse">
                                        <h3 class="card-title">
                                            <span class="card-text">
                                                Creative Graphics
                                            </span>
                                            <i class="right fas fa-angle-left"></i>
                                        </h3>
                                    </div>
                                    <div id="commcgcollapse" class="collapse" aria-labelledby="commcgAccor"
                                        data-parent="#commaccordionPanel">
                                        <div class="card-body">
                                            <form action="" method="post" id="commcgForm">
                                                <div class="row">
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Project Name</label>
                                                            <input type="text" class="form-control"
                                                                name="commProjectName" id="commProjectName"
                                                                placeholder="Enter Project Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Kind of Work</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commWorkType" id="commWorkType">
                                                                <option selected>Select Kind of Work</option>
                                                                <option value="Work Type 1">Work Type 1</option>
                                                                <option value="Work Type 2">Work Type 2</option>
                                                                <option value="Work Type 3">Work Type 3</option>
                                                                <option value="Work Type 4">Work Type 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Commercial Per
                                                                Qty</label>
                                                            <input type="text" class="form-control" name="commQty"
                                                                id="commQty" placeholder="Enter Commercial Per Qty">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="btn-form-group">
                                                            <div class="custom-action-btn-wrapper">
                                                                <a href="javascript:;" class="btn btn-warning"
                                                                    id="commcgsaveBTN">
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
                            <div class="accordian-item" id="comm-ct-accor-item" style="display:none;">
                                <div class="card card-transparent">
                                    <div class="card-header acc-card-header" id="commctAccor" data-toggle="collapse"
                                        data-target="#commctcollapse" aria-expanded="true"
                                        aria-controls="commctcollapse">
                                        <h3 class="card-title">
                                            <span class="card-text">
                                                Cataloging
                                            </span>
                                            <i class="right fas fa-angle-left"></i>
                                        </h3>
                                    </div>
                                    <div id="commctcollapse" class="collapse" aria-labelledby="commctAccor"
                                        data-parent="#commaccordionPanel">
                                        <div class="card-body">
                                            <form action="" method="post" id="commctForm">
                                                <div class="row">
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Marketplace</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commMarketplace" id="commMarketplace">
                                                                <option selected>Select Marketplace</option>
                                                                <option value="Marketplace 1">Marketplace 1</option>
                                                                <option value="Marketplace 2">Marketplace 2</option>
                                                                <option value="Marketplace 3">Marketplace 3</option>
                                                                <option value="Marketplace 4">Marketplace 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Type of Service</label>
                                                            <select class="custom-select form-control-border"
                                                                name="commctseviceType" id="commctseviceType">
                                                                <option selected>Select Type of Service</option>
                                                                <option value="Service 1">Service 1</option>
                                                                <option value="Service 2">Service 2</option>
                                                                <option value="Service 3">Service 3</option>
                                                                <option value="Service 4">Service 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <div class="form-group">
                                                            <label class="control-label required">Commercial Per
                                                                Unit</label>
                                                            <input type="text" class="form-control" name="commUnit"
                                                                id="commUnit" placeholder="Enter Commercial Per Unit">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="btn-form-group">
                                                            <div class="custom-action-btn-wrapper">
                                                                <a href="javascript:;" class="btn btn-warning"
                                                                    id="commctsaveBTN">
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

    <script>
        // Commercial Panel

        // Display Shoot Accodian
        $("#commshootcheck").change(function() {
            if (this.checked) {
                $('#commshoot-accor-item').css('display', 'block');
            } else if (!this.checked) {
                $('#commshoot-accor-item').css('display', 'none');
            }
        });

        // Display Creative Accodian
        $("#commcgcheck").change(function() {
            if (this.checked) {
                $('#commcg-accor-item').css('display', 'block');
            } else if (!this.checked) {
                $('#commcg-accor-item').css('display', 'none');
            }
        });

        // Display Catalog Accodian
        $("#commcatcheck").change(function() {
            if (this.checked) {
                $('#comm-ct-accor-item').css('display', 'block');
            } else if (!this.checked) {
                $('#comm-ct-accor-item').css('display', 'none');
            }
        });
    </script>

    {{-- data for update --}}
    <script>
        const user_id_val_is = "{{ $newCommercial->user_id }}";
        const saved_brand_id_is = "{{ $newCommercial->brand_id }}";
    </script>

    {{-- get-brand List --}}
    <script>
        $(document).ready(function() {
            $("#commcompanyNameP").change(async function() {
                const user_id_is = $("#commcompanyNameP").val();
                const client_id = $("#commcompanyNameP").find(':selected').data('client_id')
                const c_short = $("#commcompanyNameP").find(':selected').data('c_short')

                // client_id
                $("#commClientID").val(client_id);
                $("#c_short").val(c_short);
                let options = `<option value="0"> -- Select Brand Name -- </option>`;
                document.getElementById("commbrandNameP").innerHTML = "";
                await $.ajax({
                    url: "{{ url('get-brand') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        user_id: user_id_is,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        res.map(brands => {
                            options +=
                                ` <option value="${brands.brand_id}"  data-short_name="${brands.short_name}" > ${brands.name}</option>`;
                        })
                    }
                });
                document.getElementById("commbrandNameP").innerHTML = options;
                if (saved_brand_id_is > 0 && user_id_val_is === user_id_is) {
                    document.getElementById("commbrandNameP").value = saved_brand_id_is;
                }
            });
        })
    </script>

    <!-- script for setting short_name -->

    <script type="text/javascript">
        $("#commbrandNameP").change(function() { 
            const short_name = $("#commbrandNameP").find(':selected').data('short_name');
                $("#short_name").val(short_name);
        });
    </script>


    <!-- End of Commercial Panel -->
@endsection
