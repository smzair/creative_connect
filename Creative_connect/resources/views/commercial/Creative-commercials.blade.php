@extends('layouts.admin')
@section('title')
    Create New Commercial for Creative
@endsection
@push('styles')
    <style>
        .input_err {
            color: red
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-transparent card-info mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Add Commercial</h3>
                    </div>
                    <div class="card-body">

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
                        <form method="POST" action="{{ route('SAVECOMS') }}"
                            onsubmit="return validateForm(event)">
                            @csrf
                            <div class="row">
                                {{-- Company Name --}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label required">Company Name</label>
                                        <input type="hidden" id="create_commercial_id" name="id"
                                            value="{{ $commercial_data->id }}">
                                        <select id="user_id" class="custom-select form-control-border " name="user_id"
                                            aria-hidden="true" style="width: 100%;">
                                            <option value="">Select Company Name</option>
                                            @foreach ($users_data as $user)
                                                <option value="{{ $user->id }}" data-client_id="{{ $user->client_id }}">
                                                    {{ $user->Company . ' (' . $user->name . ')' }}
                                                </option>
                                            @endforeach
                                            {{-- <option value="{user->id}" data-client_id="{user->client_id}">{user->Company}}</option> --}}
                                        </select>
                                        <p class="input_err" style="color: red; display: none;" id="user_id_err"></p>
                                    </div>
                                </div>

                                {{-- Brand Name --}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label required">Brand Name</label>
                                        <select class="custom-select form-control-border" name="brand_id" id="brands">
                                            <option value="">Select Brand Name</option>
                                        </select>
                                        <p class="input_err" style="color: red; display: none;" id="brands_err"></p>

                                    </div>
                                </div>

                                {{-- Client Id --}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Client Id</label>
                                        <input type="text" class="form-control form-control-border" id="client_id"
                                            name="client_id" placeholder="Client Id" readonly>
                                        <p class="input_err" style="color: red; display: none;" id="client_id_err"></p>
                                    </div>
                                </div>
                            </div>

                            {{-- Enter New Commercial Info row --}}
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="cc-title">
                                        <h5>Enter New Commercial Info</h5>
                                    </div>
                                </div>
                                {{-- Project Type --}}
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label required">Project Name</label>
                                        <input type="text" class="form-control" name="project_name" id="project_name"
                                            placeholder="Enter Project Name" onKeyPress="return inputIsAlphabet(event);">
                                        <p class="input_err" style="color: red; display: none;" id="project_name_err"></p>
                                    </div>
                                </div>
                                {{-- Kind of Work kindOfWork --}}
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label required">Kind of Work</label>
                                        @php
                                            $kindOfWork = kindOfWork();
                                        @endphp
                                        <select class="custom-select form-control-border reset"
                                            placeholder="Select Kind of Work" id="kind_of_work" name="kind_of_work">
                                            <option value="">Select Kind of Work</option>

                                            @foreach ($kindOfWork as $row)
                                                <option value="{{ $row['value'] }}">{{ $row['value'] }}</option>
                                            @endforeach
                                            {{-- <option value="{Id}">Kind Of Work</option> --}}

                                        </select>
                                        <p class="input_err" style="color: red; display: none;" id="kind_of_work_err"></p>
                                    </div>
                                </div>
                                {{-- Commercial Per Qty --}}
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label required">Commercial Per Qty</label>
                                        <input type="text" class="form-control" name="per_qty_value" id="per_qty_value"
                                            placeholder="Enter Order Quantity" onKeyPress="return inputIsNumber(event);">
                                        <p class="input_err" style="color: red; display: none;" id="per_qty_value_err"></p>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" name="save" value="1"
                                        class="btn btn-success swalDefaultSuccess">Save</button>
                                    <button type="submit" name="save" value="2"
                                        class="btn btn-info ml-1 wrc-btn" onclick="">Save & Add
                                        Another </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- jQuery -->
<script src="{{ asset('/js/app.js') }}"></script>
<script type="application/javascript" src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="application/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

{{-- form submiting --}}
<script>
    function validateForm(event) {
        // event.preventDefault() // this will stop the form from submitting
        $(".input_err").css("display", "none");
        $(".input_err").html("");

        const create_commercial_id = $("#create_commercial_id").val();
        const user_id_is = $("#user_id").val();
        const brand_id = $("#brands").val();
        const project_name = $("#project_name").val();
        const kind_of_work = $("#kind_of_work").val();
        const per_qty_value = $("#per_qty_value").val();

        let user_id_is_Valid = true;
        let brand_id_Valid = true;
        let project_name_Valid = true;
        let kind_of_work_Valid = true;
        let per_qty_value_Valid = true;

        if (kind_of_work === '') {
            $("#kind_of_work_err").html("Company Name not Selected");
            document.getElementById("kind_of_work_err").style.display = "block";
            kind_of_work_Valid = false;
        }
        if (per_qty_value === '') {
            $("#per_qty_value_err").html("Commercial Per Qty Not enter");
            document.getElementById("per_qty_value_err").style.display = "block";
            per_qty_value_Valid = false;
        }
        if (user_id_is === '') {
            $("#user_id_err").html("Company Name not Selected");
            document.getElementById("user_id_err").style.display = "block";
            user_id_is_Valid = false;
        }
        if (project_name === '') {
            $("#project_name_err").html("Company Name not Selected");
            document.getElementById("project_name_err").style.display = "block";
            project_name_Valid = false;
        }
        if (brand_id === '') {
            $("#brands_err").html("Brand not Selected");
            document.getElementById("brands_err").style.display = "block";
            brand_id_Valid = false;
        }
        if (user_id_is_Valid && brand_id_Valid && project_name_Valid && per_qty_value_Valid && kind_of_work_Valid) {
            console.log('dasgjddgksa')
            return true
        } else {
            return false
        }
    }
</script>

<script>
    const user_id_val_is = "{{ $commercial_data->user_id }}";
    const saved_brand_id_is = "{{ $commercial_data->brand_id }}";
</script>

{{-- get-brand List --}}
<script>
    $(document).ready(function() {
        $("#user_id").change(async function() {

            const user_id_is = $("#user_id").val();
            const client_id = $("#user_id").find(':selected').data('client_id')
            // client_id
            $("#client_id").val(client_id);
            showLoader();

            let options = `<option value=""> -- Select Brand Name -- </option>`;
            document.getElementById("brands").innerHTML = "";
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
                            ` <option value="${brands.brand_id}"> ${brands.name}</option>`;
                    })
                    hideLoader();

                }
            });
            document.getElementById("brands").innerHTML = options;
            if(saved_brand_id_is > 0){
                document.getElementById("brands").value = saved_brand_id_is;
            }
        });
    })
</script>
{{-- setting data into form --}}
<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('#msg_div').attr("style", "display:none")
        }, 2000);
        if (user_id_val_is > 0) {
            $("#user_id").val(user_id_val_is);
            $("#user_id").trigger("change");
        }
    });
</script>

{{-- input is number --}}
<script>
    function inputIsNumber(evt) {
        evt = evt ? evt : window.event;
        var charCode = evt.which ? evt.which : evt.keyCode;

        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
{{-- input is Alphabet --}}

<script>
    function inputIsAlphabet(evt) {
        evt = evt ? evt : window.event;
        var charCode = evt.which ? evt.which : evt.keyCode;
        if (
            (charCode >= 65 && charCode <= 90) ||
            (charCode >= 97 && charCode <= 122) ||
            charCode == 8 ||
            charCode == 32
        ) {
            return true;
        }
        return false;
    }
</script>
