

@extends('layouts.admin')

@section('title')

Allocation Details (For Catalogue)

@endsection
@section('content')
<!-- New Allocation Details (For Catalogue) -->

<div class="container-fluid mt-5">
    <div class="row m-0">

      @php
          // pre($allocationList);
      @endphp
      <div class="col-12 card card-transparent py-4" style="border-radius: 15px; box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;">
        <div class="row m-0">
          <div class="col-xl-4 col-md-4 col-sm-4 col-12 editor-list-grp">
            <div class="card m-0" style="border-radius: 10px; box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;">
              <div class="card-body p-0">
                <div class="editor-links">
                  <div class="edit-upld-info">
                    <h2 style="color: #333">Catloger</h2>
                  </div>
                  <ul class="nav flex-column" style="margin-bottom: 10px;">
                    @foreach($allocationList as $editorId => $allo)
                    <li class="nav-item">
                      <a id="{{ $allo['editor'].$editorId }}" class="nav-link" href="#{{$editorId}}" data-toggle="tab">
                        {{ $allo['editor'] }}
                        {{-- <a id="editorname1" class="nav-link"  data-toggle="tab"> --}}
                        {{-- {{$allo['editor']}} --}}

                     </a>
                   </li>
                   @endforeach
                 </ul>
               </div>
             </div>
           </div>
         </div>
         <div class="col-xl-8 col-md-8 col-sm-8 col-12 editor-table-grp">
          <div class="editor-dtl card m-0">
            <div class="edit-upld-info">
              <h2 style="color: #333">Select Name To View Allocations Details</h2>
            </div>
            <div class="edit-upld-pop">
              <div class="table-responsive p-0 editor-table-list tab-content" style="max-height: 350px; height: 100%;">
                @foreach($allocationList as $editorId => $allo)

                @php
                  $lot_number_arr = explode(',',$allo['lot_numbers']);
                  $wrc_info_arr = explode(',',$allo['wrc_ids']);
                @endphp
                <table class="table table-dark text-nowrap mb-0 tab-pane" id="{{$editorId}}">
                  <thead>
                    <tr>
                      <th class="align-middle border-top-0" width="1%">#</th>
                      <th class="align-middle border-top-0">LOT Number</th>
                      <th class="align-middle border-top-0">WRC Count</th>
                      <th class="align-middle border-top-0">SKU Count</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sr = 1; ?>
                    {{-- @foreach($allo['lot_info'] as $lotInfo) --}}
                    <tr>
                      <td class="align-middle" width="1%">{{$sr++}}</td>
                      <td class="align-middle">{{ $allo['lot_number'] }}</td>
                      <td class="align-middle position-relative">
                        <span class="dropdown-toggle d-inline-block ed-wrc-cnt" onclick="showhideli({{ $editorId }})"  style="cursor: pointer;">{{ $allo['wrc_cnt'] }}</span>
                        <ol class="list-group mt-2 edt-sku-list" id="wrcInfo{{ $editorId }}" style="display: none;">
                          @foreach($wrc_info_arr as $wrcInfo)
                          <li class="list-group-item" style="color: #999">{{$wrcInfo}}</li>
                          @endforeach
                        </ol>
                      </td>
                      <td class="align-middle">{{ $allo['tot_sku_qty'] }}</td>
                    </tr>
                    {{-- @endforeach --}}
                  </tbody>
                </table>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
  function showhideli(val){
    var x = document.getElementById("wrcInfo"+val);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }

  }
</script>
@endsection