@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Report Details</a>
        </li>
        <li class="breadcrumb-item active">Report</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <?php
            $roleName = getRoleNameByUserId(Auth::user()->id);
            if (hasAccessPermission($roleName, 'Complain details', 'addaccess')) {
                
            }
            ?>
            @include('scmsp.backend.partial.operation_message') 
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form action="" method="post" id="report_search_form">
                @csrf                
                <div class="row">                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Division</label>
                            <?php
                            $get_department_by_division_url = url('admin/get_department_by_division');
                            ?>
                            <label for="pwd">Complain Division</label>
                            <select class="form-control" id='div_id' name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('departments');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (old('div_id') == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}
                                        </option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                            <?php
                                if ($errors->has('div_id')) {
                                    echo "<div class='alert alert-danger'>Division is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Department</label> 
                            <?php
                            $get_department_wise_user_url   = url('admin/get_department_wise_user');
                            $get_category_by_department     = url('admin/get_category_by_department');
                            ?>
                            <select class="form-control" id="dept_id" name="dept_id" onchange="getCategoryByDepartment(this.value, 'div_id', 'category_id', '<?php echo $get_category_by_department; ?>');">
                                <option value="">Select</option>
                            </select>
                            <?php
                                if ($errors->has('dept_id')) {
                                    echo "<div class='alert alert-danger'>Department is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Category</label>
                            <?php
                            $url    =   route('admin.get_category_wise_complain_type');
                            ?>
                            <select class="form-control" id="category_id" name="category_id" onchange="getCategoryWiseComplainType(this.value, '<?php echo $url; ?>','complain_type_id','div_id','dept_id');">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('complain_type_categories');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (old('category_id') == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}
                                        </option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                            <?php
                                if ($errors->has('complain_type_id')) {
                                    echo "<div class='alert alert-danger'>Complain Type is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Complain Type</label>
                            <select class="form-control" name="complain_type_id" id='complain_type_id'>
                                <option value="">Select Type</option>
                                <?php
                                $list = get_table_data_by_table('complain_types');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (old('complain_type_id') == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}
                                        </option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                            <?php
                                if ($errors->has('complain_type_id')) {
                                    echo "<div class='alert alert-danger'>Complain Type is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role">Address Division</label>
                            <?php $div_by_dis_url = route('admin.get_district_by_division') ?>
                            <select class="form-control" id="addr_div_id" name="addr_div_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_dis_id', '<?php echo $div_by_dis_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('addr_divisions');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (old('addr_div_id') == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}
                                        </option>
                                        <?php
                                    }
                                }
                                ?>                        
                            </select>
                            <?php
                            if ($errors->has('addr_div_id')) {
                                echo "<div class='alert alert-danger'>Division is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role">Address District</label>
                            <?php $up_by_dis_url = route('admin.get_upozila_by_district') ?>
                            <select class="form-control" name="addr_dis_id" id="addr_dis_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_upazila_id', '<?php echo $up_by_dis_url; ?>');">
                                <option value="">Select</option>                       
                            </select>
                            <?php
                            if ($errors->has('addr_dis_id')) {
                                echo "<div class='alert alert-danger'>District is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role">Address Upazila</label>
                            <?php $union_by_up_url = route('admin.get_union_by_upozila') ?>
                            <select class="form-control" name="addr_upazila_id" id="addr_upazila_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_union_id', '<?php echo $union_by_up_url; ?>');">
                                <option value="">Select</option>                        
                            </select>
                            <?php
                            if ($errors->has('addr_upazila_id')) {
                                echo "<div class='alert alert-danger'>Upazila is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                                $get_department_wise_user_url   = url('admin/get_department_wise_user');
                            ?>
                            <label for="role">Address Union</label>
                            <select class="form-control" name="addr_union_id" id="addr_union_id" onchange="getusersByDepartment(this.value, 'assign_to', '<?php echo $get_department_wise_user_url; ?>');">
                                <option value="">Select</option>                       
                            </select>
                            <?php
                            if ($errors->has('addr_union_id')) {
                                echo "<div class='alert alert-danger'>Union is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">From Date</label>
                            <input type="text" class="form-control" id="from_date" placeholder="From Date" name="from_date" value="<?php echo old('from_date'); ?>">
                            <?php
                            if ($errors->has('from_date')) {
                                echo "<div class='alert alert-danger'>Name is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">To Date</label>
                            <input type="text" class="form-control" id="to_date" placeholder="To Date" name="to_date" value="<?php echo old('to_date'); ?>">
                            <?php
                            if ($errors->has('to_date')) {
                                echo "<div class='alert alert-danger'>Name is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Service Staff</label>
                            <select class="form-control" name="assign_to" id="assign_to">
                                <option value="">Select</option>
                            </select>
                            <?php
                                if ($errors->has('assign_to')) {
                                    echo "<div class='alert alert-danger'>Technician is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Customer Phone</label>
                            <input type="text" class="form-control" id="complainer" placeholder="Enter Customer Phone" name="complainer" value="<?php echo old('complainer'); ?>">
                            <?php
                            if ($errors->has('complainer')) {
                                echo "<div class='alert alert-danger'>Name is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $url    = route('admin.get-cms-general-report');
                ?>
                <button type="button" name="form_search" class="btn btn-info" onclick="getCMSReport('report_show_section','<?php echo $url; ?>');">Search</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <span id="report_show_section"></span>
        </div>
    </div>
</div>
@endsection