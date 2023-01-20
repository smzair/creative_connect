@extends('layouts.admin')
@section('title')
Allocation Details (For Catalogue)
@endsection
@section('content')
<!-- New Allocation Details (For Catalogue) -->

<div class="container-fluid mt-5">
    <div class="row m-0" >
      <div style="background: #fff;">
        @php
              // pre($catalog_allocated_users_list);
              // pre($catalog_allocation_List_by_lot_numbers);
              $catalog_user_list = array_column($catalog_allocation_List_by_lot_numbers, 'user_id');
              // foreach ($catalog_allocated_users_list as $editorId => $value) {
              //   $lot_info_keys = array_intersect($catalog_user_list,[$value['user_id']]);
              //   foreach ($lot_info_keys as $key => $user_id) {
              //     $lot_info_array = $catalog_allocation_List_by_lot_numbers[$key];
              //     pre($lot_info_array);
              //     echo  "<br> " .$value['user_id']." => " . $lot_info_array['wrc_numbers'];
              //   }
              // }
          @endphp

      </div>

     
      <div class="col-12 card card-transparent py-4" style="border-radius: 15px; box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;">
        <div class="row m-0">
          <div class="col-xl-4 col-md-4 col-sm-4 col-12 editor-list-grp">
            <div class=" m-0" style="border-radius: 10px; box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;">
              <div class="card-body p-0 ">
                <div class="editor-links card-transparent">
                  <div class="edit-upld-info">
                    <h4 style="color: #333">Team Members</h4>
                  </div>
                  <ul class="nav flex-column" style="margin-bottom: 10px;">
                    @foreach($catalog_allocated_users_list as $editorId => $value)
                    <li class="nav-item">
                      <a style="color: #fff;" id="{{ $value['editor'].$editorId }}" class="nav-link" href="#{{$editorId}}" data-toggle="tab">
                        {{ $value['editor'] }}
                     </a>
                   </li>
                   @endforeach
                 </ul>
               </div>
             </div>
           </div>
         </div>
         <div class="col-xl-8 col-md-8 col-sm-8 col-12 editor-table-grp card-transparent">
          <div class="editor-dtl card m-0 card-transparent">
            <div class="edit-upld-info">
              <h4 style="">Select Team Member To View Allocation Details</h4>
            </div>
            <div class="edit-upld-pop">
              <div class="table-responsive p-0 editor-table-list tab-content" style="max-height: 350px; height: 100%;">
                @foreach($catalog_allocated_users_list as $editorId => $value)
               
                <table class="table  text-nowrap mb-0 tab-pane" id="{{$editorId}}">
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
                     @php
                      $lot_info_keys = array_intersect($catalog_user_list,[$value['user_id']]);
                    @endphp
                    @foreach($lot_info_keys as $key => $user_id)
                    @php
                      $lot_info_array = $catalog_allocation_List_by_lot_numbers[$key];
                      // pre($lot_info_array); // allocated_qtys
                      $wrc_number_arr = explode(',',$lot_info_array['wrc_numbers']);
                      $batch_no_arr = explode(',',$lot_info_array['batch_nos']);
                      $allocated_qty_arr = explode(',',$lot_info_array['allocated_qtys']);
                      $wrc_info_arr = explode(',',$lot_info_array['wrc_ids']);
                    @endphp

                    <tr>
                      <td class="align-middle" width="1%">{{$sr++}}</td>
                      <td class="align-middle">{{ $lot_info_array['lot_number'] }}</td>
                      <td class="align-middle position-relative">
                        <span class="dropdown-toggle d-inline-block ed-wrc-cnt" onclick="showhideli({{ $lot_info_array['lot_id'].$lot_info_array['user_id'] }})"  style="cursor: pointer;">{{ $lot_info_array['wrc_cnt'] }}</span>
                        <ol class="list-group mt-2 edt-sku-list" id="wrcInfo{{ $lot_info_array['lot_id'].$lot_info_array['user_id'] }}" style="display: none;">
                          @foreach($wrc_number_arr as $wrc_key => $wrc_number)
                          @php
                          $batch_no_is = $batch_no_arr[$wrc_key] > 0 ? " (Batch No. ".$batch_no_arr[$wrc_key].")" : "";
                          @endphp
                          <li class="list-group-item" style="color: #999">{{$wrc_number_arr[$wrc_key].$batch_no_is . " ( Allocated Qty ".$allocated_qty_arr[$wrc_key].")"}}</li>
                          @endforeach
                        </ol>
                      </td>
                      <td class="align-middle">{{$lot_info_array['tot_sku_qty']}}</td>
                    </tr>
                    @endforeach
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