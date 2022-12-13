@extends('layouts.admin')
@section('title')
Creative Create WRC
@endsection
@section('content')

<div class="container">
    <div class="row mt-5">
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-transparent card-info mt-3">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Create New WRC</h3>
                    <a href="javascript:;" class="btn btn-warning upld-action-btn float-right d-none" id="uploadActionBTN" data-toggle="modal" data-target="#skuUploaderModal">
                        Click to open
                    </a>
                </div>
                <div class="card-body"> 
                    @if (Session::has('success'))
                        <div class="alert alert-success" id="msg_div" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form method="POST" onsubmit="return validateForm(event)" action="{{ route($CreativeWrc->route)}}"  id = "form" action="{{ route($CreativeWrc->route) }}" >

                        @csrf
                        <div class="row">
                            <!-- Company Name -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">

                                    <input type="hidden" name="id" value="{{$CreativeWrc->id }}"> 
                                    <input type="hidden" name="c_short" id="c_short" value="">
                                    <input type="hidden" name="short_name" id="short_name" value="">
                                    <input type="hidden" name="s_type" id="s_type" value="">

                                    <label class="control-label required">Company Name</label>
                                    <select class="custom-select form-control-border" id="user_id" name="user_id"  aria-hidden="true" style="width: 100%;">
                                        <option value="" selected>Select Company Name</option>
                                      
                                        @foreach ($users_data as $user)
                                                <option value="{{ $user->id }}" data-c_short="{{ $user->c_short }}">
                                                    {{ $user->Company ." (" . $user->name.")" }}
                                                </option>
                                        @endforeach
                                    </select>
                                    <script>
                                        document.querySelector("#user_id").value = "{{$CreativeWrc->user_id }}"
                                    </script>
                                    <p class="input_err" style="color: red; display: none;" id="user_id_err"></p>
                                </div>
                            </div>
                            <!-- Brand Name -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Brand Name</label>
                                    <select class="custom-select form-control-border" name="brand_id"  id="brand_id">
                                        <option value = "">Select Brand</option>
                                    </select>
                                    <script>
                                        document.querySelector("#brand_id").value = "{{$CreativeWrc->brand_id }}"
                                    </script>
                                    <p class="input_err" style="color: red; display: none;" id="brand_id_err"></p>
                                </div>
                            </div>
                            <!-- Select LOT Number -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">LOT Number</label>
                                    <select class="custom-select form-control-border " name="lot_id" id="lot_id" onchange="setStype()">
                                        <option value = "">Select LOT Number</option>

                                    </select>
                                    <script>
                                        document.querySelector("#lot_id").value = "{{$CreativeWrc->lot_id }}"
                                    </script>
                                    <p class="input_err" style="color: red; display: none;" id="lot_id_err"></p>
                                </div>
                            </div>
                            <!-- Select Commercial -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Work Bucket</label>
                                    <select class="custom-select form-control-border " name="commercial_id" id="commercial_id">
                                        <option value="" selected disabled>Select Commercial</option>
                                    </select>
                                    <script>
                                        document.querySelector("#commercial_id").value = "{{$CreativeWrc->commercial_id }}"
                                    </script>
                                    <p class="input_err" style="color: red; display: none;" id="commercial_id_err"></p>
                                </div>
                            </div>
                            <!-- Order Quantity -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Order Qty</label>
                                    <input type="text" class="form-control" name="order_qty" id="order_qty" value="{{$CreativeWrc->order_qty }}" placeholder="Enter Order Quantity" onkeypress="return isNumber(event);">
                                    <p class="input_err" style="color: red; display: none;" id="order_qty_err"></p>
                                </div>
                            </div>
                            {{-- Allow to Copy Writer --}}
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label  required" style="display: block">Allow to Copy Writer</label>
                                    <input type="checkbox" class="form-control" name="alloacte_to_copy_writer" value="1" <?php if($CreativeWrc->alloacte_to_copy_writer == 1)echo 'checked'?>>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="cc-title">
                                    <h5>Guidelines</h5>
                                </div>
                            </div>
                            <!-- Work Brief -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Work Brief</label>
                                    <input type="text" class="form-control" name="work_brief" id="work_brief" placeholder="Add Link" value="{{$CreativeWrc->work_brief }}">
                                    <p class="input_err" style="color: red; display: none;" id="work_brief_err"></p>
                                </div>
                            </div>
                            <!-- Guidelines -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Guidelines</label>
                                    <input type="text" class="form-control" name="guide_lines" id="guide_lines" placeholder="Add Link" value="{{$CreativeWrc->guidelines }}">
                                    <p class="input_err" style="color: red; display: none;" id="guide_lines_err"></p>
                                </div>
                            </div>
                            <!-- Add Document -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Add Document</label>
                                    <input type="text" class="form-control" name="document1" id="document1" placeholder="Add Link" value="{{$CreativeWrc->document1 }}">
                                    <p class="input_err" style="color: red; display: none;" id="document1_err"></p>
                                </div>
                            </div>
                            <!-- Add Document -->
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Add Document</label>
                                    <input type="text" class="form-control" name="document2" id="document2" placeholder="Add Link" value="{{$CreativeWrc->document2 }}">
                                    <p class="input_err" style="color: red; display: none;" id="document2_err"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success btn-xl btn-warning mb-2" onclick="">{{$CreativeWrc->button_name}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

@if(isset($CreativeWrc->id))

<script>
    const brand_id_val = "<?= $CreativeWrc->brand_id ?>";
    const lot_id_val = "<?= $CreativeWrc->lot_id ?>";
    console.log({brand_id_val});
    setTimeout(()=>{      
    if(brand_id_val > 0){
        $("#user_id").trigger("change");
        setTimeout(()=>{      
        $("#brand_id").trigger("change");
        document.querySelector("#brand_id").value = "<?= $CreativeWrc->brand_id ?>"
        setTimeout(()=>{      
            if(lot_id_val > 0){
                document.querySelector("#lot_id").value = "<?= $CreativeWrc->lot_id ?>"
                document.querySelector("#commercial_id").value = "<?= $CreativeWrc->commercial_id ?>"
                $("#lot_id").trigger("change");
            }
        },2000)

    },2000)
}
},2000)
</script>

<script defer>  
    // setTimeout(()=>{
    //     $("#brand_id").change();
    //     document.querySelector("#lot_id").value = "<?= $CreativeWrc->lot_id ?>"
    // },3000)
    
</script>
@endif

<!-- script for setting short_name -->

<!-- Select Brand Name -->
<script>
    $(document).ready(function() {

        $("#user_id").change(function() {
            const user_id_is = $("#user_id").val();
            const c_short = $("#user_id").find(':selected').data('c_short');
            $("#c_short").val(c_short);


            let options = `<option value="" data-short_name=""  > -- Select Brand Name -- </option>`;
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
                            ` <option value="${brands.brand_id}" data-short_name="${brands.short_name}" > ${brands.name}</option>`;
                    })
                    console.log(options)
                    document.getElementById("brand_id").innerHTML = options;

                }
            });
            setTimeout(()=>{
                document.querySelector("#brand_id").value = "<?= $CreativeWrc->brand_id ?>"
            },1000)
        });
    })
</script>


<!-- Select LOT Number  -->
<script>
    $(document).ready(function() {

        $("#brand_id").change(function() {
            const user_id_is = $("#user_id").val();
            const brand_id_is = $("#brand_id").val();
            const short_name = $("#brand_id").find(':selected').data('short_name');
            $("#short_name").val(short_name);

            let options = `<option value="" data-s_type="" > -- Select LOT Number -- </option>`;
            let options_work = `<option value="" > -- Select Commercial -- </option>`;
            $.ajax({
                url: "{{ url('get-lot-number') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    user_id: user_id_is,
                    brand_id: brand_id_is,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {

                 const {commercial_data,lot_number_data} = res;
                 lot_number_data?.length >0 && lot_number_data.map(lots => {
                        options +=
                            ` <option value="${lots.id}" data-s_type="${lots.project_name}"> ${lots.lot_number}</option>`;

                    })
                    commercial_data?.length >0 && commercial_data.map(lots => {
                            options_work +=
                            ` <option value="${lots.create_commercial_id}" > ${lots.project_name} | ${lots.kind_of_work} | ${lots.per_qty_value}</option>`;
                    })
                    document.getElementById("lot_id").innerHTML = options;
                    document.getElementById("commercial_id").innerHTML = options_work;
                }
            });
           
        });
    })
</script>

<!-- Select Project Name -->
<script>

    function setStype(){
        console.log("-->");
       const s_type = $("#lot_id").find(':selected').data('s_type');
            $("#s_type").val(s_type);
            console.log(s_type);
    }
</script>



<!-- validateForm script -->
<script>
    function validateForm(event) {
        // event.preventDefault() // this will stop the form from submitting
        $(".input_err").css("display", "none");
        $(".input_err").html("");

        const check_user_id = $('#user_id').val();
        const check_brand_id = $('#brand_id').val();
        const check_lot_id = $('#lot_id').val();
        const check_commercial_id = $('#commercial_id').val();
        const check_order_qty = $('#order_qty').val();
        const check_work_brief = $('#work_brief').val();
        const check_guide_lines = $('#guide_lines').val();
        const check_document1 = $('#document1').val();
        const check_document2 = $('#document2').val();
       

        let user_id_is_Valid = true;
        let brand_id_Valid = true;
        let lot_id_Valid = true;
        let commercial_id_Valid = true;
        let order_qty_Valid = true;
        let work_brief_Valid = true;
        let guide_lines_Valid = true;
        let document1_Valid = true;
        let document2_Valid = true;

        if (check_document2 === '') {
            $("#document2_err").html("Add Document is required");
            document.getElementById("document2_err").style.display = "block";
            document2_Valid = false;
        }

        if (check_document1 === '') {
            $("#document1_err").html("Add Document is required");
            document.getElementById("document1_err").style.display = "block";
            document1_Valid = false;
        }

        if (check_guide_lines === '') {
            $("#guide_lines_err").html("Guidelines is required");
            document.getElementById("guide_lines_err").style.display = "block";
            guide_lines_Valid = false;
        }

        if (check_work_brief === '') {
            $("#work_brief_err").html("Work Brief is required");
            document.getElementById("work_brief_err").style.display = "block";
            work_brief_Valid = false;
        }

        if (check_order_qty === '') {
            $("#order_qty_err").html("Order Qty is required");
            document.getElementById("order_qty_err").style.display = "block";
            order_qty_Valid = false;
        }

        if (check_commercial_id === '') {
            $("#commercial_id_err").html("Work Bucket is required");
            document.getElementById("commercial_id_err").style.display = "block";
            commercial_id_Valid = false;
        }
       
        if (check_lot_id === '') {
            $("#lot_id_err").html("LOT Number is required");
            document.getElementById("lot_id_err").style.display = "block";
            lot_id_Valid = false;
        }

        if (check_user_id === '') {
            $("#user_id_err").html("Company Name is required");
            document.getElementById("user_id_err").style.display = "block";
            user_id_is_Valid = false;
        }

        if (check_brand_id === '') {
            $("#brand_id_err").html("Brand Name is required");
            document.getElementById("brand_id_err").style.display = "block";
            brand_id_Valid = false;
        }
        
        if (user_id_is_Valid && brand_id_Valid && lot_id_Valid && commercial_id_Valid && order_qty_Valid && work_brief_Valid && guide_lines_Valid && document1_Valid && document2_Valid) {
        return true
        } else {
            return false
        }
        
    }
</script>
<!-- msg div script -->
<script>
    setTimeout(function(){
        document.getElementById('msg_div').style.display = "none";
    },3000)
</script>

@endsection
