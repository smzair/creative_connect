@extends('layouts.admin')
@section('title')
Create New Commercial for Creative
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-transparent card-info mt-3">
                <div class="card-header">
                    <h3 class="card-title">Add Commercial Logs</h3>
                    <a style="float: right;" class="btn btn-success swalDefaultSuccess" href="{{route('viewCommercial')}}">Commercial Logs List</a>
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
                    <form method="POST" action="{{ route('SAVECATALOG') }}" id="">
                        @csrf
                        {{-- row 1 --}}
                        <div class="row">
                            {{-- Company Name --}}
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label required">Company Name</label>
                                    <select class="custom-select form-control-border" id="user_id" name="user_id" aria-hidden="true" style="width: 100%;">
                                        <option selected>Select Company Name</option>
                                        @foreach ($users as $user)
                                        <option  value="{{$user->id}}" data-client_id="{{$user->client_id}}">{{$user->Company}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Brand Name --}}
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label required">Brand Name</label>
                                    <select class="custom-select form-control-border" name="brand_id" id="brands"> 
                                        <option selected>Select Brand Name</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Client Id --}}
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Client Id</label>
                                    <input type="text" class="form-control form-control-border" id="client_id" name="client_id" placeholder="Client Id" readonly>
                                </div>
                            </div>
                        </div>
                        {{-- 2nd row --}}
                        <div class="row">
                             @php
                                    $marketPlace = getMarketPlace();
                                    $typeOfService = getTypeOfService();
                                @endphp
                            <div class="col-sm-12 col-12">
                                <div class="cc-title">
                                    <h5>Enter New Commercial Info</h5>
                                </div>
                            </div>
                            {{-- Marketplace --}}
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Marketplace</label>
                                    <select class="custom-select select2bs4 form-control-border reset" placeholder="Select Marketplace" name="market_place" aria-hidden="true" style="width: 100%;">
                                        <option value=""selected disabled>Select Marketplace</option>
                                        @foreach($marketPlace as $index => $getProduct)
                                        <option value="{{$index}}">{{$getProduct}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Type of Service --}}
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Type of Service</label>
                                    <select class="custom-select form-control-border reset" placeholder="Select Type of Service" name="type_of_service">
                                        <option value=""selected disabled>Select Type of Service</option>
                                        @foreach($typeOfService as $index => $service)
                                        <option value="{{$index}}">{{$service}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Commercial Per SKU --}}
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Commercial Per SKU*</label>
                                    <input type="text" class="form-control" name="CommercialSKU" id="CommercialSKU" placeholder="Enter Commercial Per SKU">
                                </div>
                            </div>

                            {{-- submit buttons --}}
                            <div class="col-sm-12">
                                <button type="submit" name="save" value="1" class="btn btn-success swalDefaultSuccess">Save</button>

                                <button type="submit" name="save" value="2" class="btn btn-info ml-1 wrc-btn">Save And Add</button>

                                {{-- <button type="submit" class="btn btn-success swalDefaultSuccess" onclick="saveComForm(0)">Save</button> --}}

                                {{-- <button type="button" class="btn btn-info ml-1 wrc-btn" onclick="saveComForm(1)">Save & Add Another </button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('/js/app.js') }}"></script>
<script type="application/javascript" src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script type="application/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

{{-- data for update --}}
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
            console.log(user_id_is);
            console.log(client_id);
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
                }
            });
            document.getElementById("brands").innerHTML = options;
            if(saved_brand_id_is > 0 && user_id_val_is === user_id_is){
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
        }, 1500);
        if (user_id_val_is > 0) {
            $("#user_id").val(user_id_val_is);
            $("#user_id").trigger("change");
        }
    });
</script>
@endsection