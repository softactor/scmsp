@extends('scmsp.backend.layout.app')
@section('title', 'Create User')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update Upazila</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Upazila</a></li>
                    <li class="breadcrumb-item active">Update Upazila</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <div class="card">
            <div class="card-body">
                <div class='row'>
                    <div class='col col-md-12'>
                        <form action="{{ route('admin.address_upazila_update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="division">Division<span class="required_text"></span></label>
                                        <!--divisionId, selector, url-->
                                        <?php
                                $getDisByDivUrl      =   url('admin/get_address_district_by_division');
                            ?>
                                        <select class="form-control" name="division_id"
                                            onchange="getAddressDistrictByDivision(this.value,'district_id','<?php echo $getDisByDivUrl; ?>');">
                                            <option value="">Select Division</option>
                                            <?php
                                if (!$divisions->isEmpty()) {
                                    foreach ($divisions as $data) {
                                        ?>
                                            <option value="{{ $data->id }}"
                                                <?php if(isset($selectedDivisionId) && $selectedDivisionId == $data->id){ echo 'selected'; } ?>>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="division">District<span class="required_text"></span></label>
                                        <select class="form-control" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                            <!--districtData-->
                                            <?php
                                if (!$districtData->isEmpty()) {
                                    foreach ($districtData as $data) {
                                        ?>
                                            <option value="{{ $data->id }}"
                                                <?php if(isset($upazila->district_id) && $upazila->district_id == $data->id){ echo 'selected'; } ?>>
                                                {{ $data->name }}
                                            </option>
                                            <?php 
                                    } // foreach
                                }
                                ?>
                                        </select>
                                        <?php
                            if ($errors->has('district_id')) {
                                echo "<div class='alert alert-danger'>District is Required</div>";
                            }
                            ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Name<span class="required_text"></span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name"
                                            name="name" value="<?php echo old('name', $upazila->name); ?>">
                                        <?php
                            if ($errors->has('name')) {
                                echo "<div class='alert alert-danger'>Name is Required</div>";
                            }
                            ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Bangla Name</label>
                                        <input type="text" class="form-control" id="bn_name"
                                            placeholder="Enter Bangla name" name="bn_name"
                                            value="<?php echo old('bn_name', $upazila->bn_name); ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="edit_id" value="<?php echo $upazila->id; ?>" />
                            <input type="submit" name="submit" value="Update" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection