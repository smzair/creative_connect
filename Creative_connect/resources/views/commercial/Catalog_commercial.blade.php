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
                    <h3 class="card-title">Add Commercial</h3>
                </div>
                <div class="card-body">
                    <form metod="POST" action="" id="comform">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label required">Company Name</label>
                                    <select class="custom-select company form-control-border select2 " name="user_id" aria-hidden="true" style="width: 100%;">
                                        <option selected>Select Company Name</option>
                                        @foreach ($users as $user)
                                        <option  value="{{$user->id}}" data-client_id="{{$user->client_id}}">{{$user->Company}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label required">Brand Name</label>
                                    <select class="custom-select form-control-border" name="brand_id" id="brands"> 
                                        <option selected>Select Brand Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Client Id</label>
                                    <input type="text" class="form-control form-control-border" id="client_id" name="client_id" placeholder="Client Id" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="cc-title">
                                    <h5>Enter New Commercial Info</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Marketplace</label>
                                    <select class="custom-select select2 select2bs4 form-control-border reset" placeholder="Select Marketplace" name="market_place" aria-hidden="true" style="width: 100%;">
                                        <option value=""selected disabled>Select Marketplace</option>
                                        @foreach($getProductList as $index => $getProduct)
                                        <option value="{{$index}}">{{$getProduct}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Type of Service</label>
                                    <select class="custom-select form-control-border reset" placeholder="Select Type of Service" name="type_of_service">
                                        <option value=""selected disabled>Select Type of Service</option>
                                        @foreach($typeOfShootList as $index => $typeofShoot)
                                        <option value="{{$index}}">{{$typeofShoot}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Commercial Per SKU*</label>
                                    <input type="text" class="form-control" name="CommercialSKU" id="CommercialSKU" placeholder="Enter Commercial Per SKU">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success swalDefaultSuccess" onclick="saveComForm(0)">Save</button>
                                <button type="button" class="btn btn-info ml-1 wrc-btn" onclick="saveComForm(1)">Save & Add Another </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
