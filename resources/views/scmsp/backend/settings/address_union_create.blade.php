@extends('scmsp.backend.layout.app')
@section('title', 'Create User')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.address_union') }}">Union</a>
        </li>
        <li class="breadcrumb-item active">Create Union</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form action="{{ route('admin.address_union_store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="division">Division<span class="required_text"></span></label>
                            <!--divisionId, selector, url-->
                            <?php
                                $getDisByDivUrl      =   url('admin/get_address_district_by_division');
                            ?>
                            <select class="form-control" name="division_id" onchange="getAddressDistrictByDivision(this.value,'district_id','<?php echo $getDisByDivUrl; ?>');">
                                <option value="">Select Division</option>
                                <?php
                                if (!$divisions->isEmpty()) {
                                    foreach ($divisions as $data) {
                                        ?>
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    <?php 
                                    } // foreach
                                }
                                ?>                        
                            </select>
                            <?php
                            if ($errors->has('division_id')) {
                                echo "<div class='alert alert-danger'>Division is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="division">District<span class="required_text"></span></label>
                            <?php
                                $getDisByDivUrl      =   url('admin/get_address_upazila_by_district');
                            ?>
                            <select class="form-control" name="district_id" id="district_id" onchange="getAddressUpazialByDistrict(this.value,'upazila_id','<?php echo $getDisByDivUrl; ?>');">
                                <option value="">Select District</option>                        
                            </select>
                            <?php
                            if ($errors->has('district_id')) {
                                echo "<div class='alert alert-danger'>District is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="division">Upazila<span class="required_text"></span></label>
                            <select class="form-control" name="upazila_id" id="upazila_id">
                                <option value="">Select Upazila</option>                        
                            </select>
                            <?php
                            if ($errors->has('upazila_id')) {
                                echo "<div class='alert alert-danger'>Upazila is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name<span class="required_text"></span></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo old('name'); ?>">
                            <?php
                            if ($errors->has('name')) {
                                echo "<div class='alert alert-danger'>Name is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Bangla Name</label>
                            <input type="text" class="form-control" id="bn_name" placeholder="Enter Bangla name" name="bn_name" value="<?php echo old('bn_name'); ?>">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Create" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
@endsection