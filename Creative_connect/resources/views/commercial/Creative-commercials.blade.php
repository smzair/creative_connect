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
                                        <option  value="{user->id}" data-client_id="{user->client_id}">{user->Company}}</option>
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
                                    <label class="control-label required">Project Type</label>
                                    <select class="custom-select select2 select2bs4 form-control-border reset" placeholder="Project Type" name="project_type" aria-hidden="true" style="width: 100%;">
                                        <option value=""selected disabled>Select Project Type</option>
                                       
                                        <option value="{Id}">Project Type</option>
                                     
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="control-label required">Kind of Work</label>
                                    <select class="custom-select form-control-border reset" placeholder="Select Kind of Work" name="kind_of_work">
                                        <option value=""selected disabled>Kind of Work</option>
                                       
                                        <option value="{Id}">Kind Of Work</option>
                                   
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                               <div class="form-group">
                                    <label class="control-label required">Commercial Per Qty</label>
                                    <input type="text" class="form-control" name="orderQty" id="orderQty" placeholder="Enter Order Quantity">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success swalDefaultSuccess" onclick="">Save</button>
                                <button type="button" class="btn btn-info ml-1 wrc-btn" onclick="">Save & Add Another </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
