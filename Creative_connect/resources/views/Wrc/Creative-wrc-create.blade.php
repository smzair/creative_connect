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
                    <form method="POST" action=""  id="" >
                        @csrf
                        <div class="row">
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  

                                    <label class="control-label required">Company Name</label>
                                    <select class="custom-select form-control-border select2 com " id="wrc_com" name="user_id"  aria-hidden="true" style="width: 100%;">
                                        <option value="None" selected>Select Company Name</option>
                                      
                                        <option value="">Company List</option>

                                        
                                     

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Brand Name</label>
                                    <select class="custom-select form-control-border brand " name="brand_id"  id="wrc_brands">
                                        <option selected>Select Brand</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">LOT Number</label>
                                    <select class="custom-select form-control-border " name="lot_id" id="wrc_lots">
                                        <option selected>Select LOT Number</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Work Bucket</label>
                                    <select class="custom-select form-control-border " name="commercial_id" id="product_category">
                                        <option value="null" selected disabled>Select Commercial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Order Qty</label>
                                    <input type="text" class="form-control" name="orderQty" id="orderQty" placeholder="Enter Order Quantity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="cc-title">
                                    <h5>Guidelines</h5>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Work Brief</label>
                                    <input type="text" class="form-control" name="workBrief" id="workBrief" placeholder="Add Link">
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Guidelines</label>
                                    <input type="text" class="form-control" name="guidelines" id="guidelines" placeholder="Add Link">
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Add Document</label>
                                    <input type="text" class="form-control" name="document1" id="document1" placeholder="Add Link">
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                    <label class="required">Add Document</label>
                                    <input type="text" class="form-control" name="document2" id="document2" placeholder="Add Link">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success btn-xl btn-warning mb-2" onclick="">Create New WRC</button>
                              
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection