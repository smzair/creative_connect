@extends('layouts.admin')

@section('title')
Create LOT

<!--- if condition to be applied for update details of the page-->
Update LOT
@endsection
@section('content')
<!-- New Create Lot (For Catalogue) -->
<div class="container-lg container-fluid my-5 lot-create-updateversion">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent m-0">
                <div class="card-body">
                    <!-- New Create Lot -->
                    <form method="POST" action="{{route('savelots')}}">
                        <input type="hidden" name="c_short" id="c_short" value="<?php echo isset($lotInfo->c_short) ? $lotInfo->c_short : ''; ?>">
                        <input type="hidden" name="short_name" id="short_name" value="<?php echo isset($lotInfo->short_name) ? $lotInfo->short_name : ''; ?>">
                        <div class="row custom-select-row">
                        @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                           <div class="col-sm-4">
                                 <div class="form-group">
                                    <label class="control-label required">Company Name</label>
                                    <select class="custom-select form-control-border select2 com " id="wrc_com" name="user_id"  aria-hidden="true" style="width: 100%;">
                                        <option value="None" selected>Select Company Name</option>
                                      
                                        <option value="">Company List</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Brand Name</label>
                                    <select  class="form-control select2 brand" id="brand_id" name="brand_id"  data-placeholder = "Select Brand">
                                        <option disabled selected>Select Brand Name</option>
                                        @foreach ( $brands  as $brand)
                                        <option <?php echo (!empty($lotInfo->brand_id) && $lotInfo->brand_id == $brand->id) ? 'selected' : ''; ?> value="{{$brand->id}}" data-short_name = "{{$brand->short_name}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Type of Service</label>
                                    <select class="form-control" name="serviceType" id="serviceType">
                                        <option value="typeSelect" selected>Select Type of Service</option>
                                        <option value="Reshoot">Reshoot</option>
                                        <option value="New Shoot">New Shoot</option>
                                        <option value="Editing">Editing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Request Type</label>
                                    <select class="form-control" name="requestType" id="requestType">
                                        <option value="selectRequestType">Select Request Type</option>
                                        <option value="New">New</option>
                                        <option value="Existing">Existing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Request Received Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="reqReceviedDate" id="reqReceviedDate" placeholder="Select Request Received Date" data-toggle="datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Raw Image Receive Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="imgReceviedDate" id="imgReceviedDate" placeholder="Select Raw Image Receive Date" data-toggle="datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row custom-select-row">
                            <div class="col-sm-12 mb-3">
                                @if ($id === 0)
                                <button type="submit" class="btn btn-sm btn-warning md-2" >Create Lot</button>
                                @else
                                <button type="submit" class="btn btn-sm btn-warning md-2" >Create Lot</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
