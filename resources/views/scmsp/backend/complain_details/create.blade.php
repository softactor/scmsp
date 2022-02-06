@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.complain-details-list') }}">Complain</a>
        </li>
        <li class="breadcrumb-item active">Create Complain</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.complain-details-store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="complainer">Mobile<span class="required_text"></span></label>
                            <input type="text" class="form-control" name="complainer" placeholder="Enter Complainer Phone" id='search_text' onkeyup="autosearch()" value="<?php echo old('complainer'); ?>">
                            <?php
                                if ($errors->has('complainer')) {
                                    echo "<div class='alert alert-danger'>Complainer Phone is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="complainer">Name<span class="required_text"></span></label>
                            <input type="text" class="form-control" name="complainer_name" placeholder="Enter Complainer Name" id='search_text' value="<?php echo old('complainer_name'); ?>">
                            <?php
                                if ($errors->has('complainer_name')) {
                                    echo "<div class='alert alert-danger'>Complainer Name is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="complain details">Address<span class="required_text"></span></label>
                            <textarea class="form-control" id="complainer_address" name="complainer_address" rows="3"><?php echo old('complainer_address'); ?></textarea>
                            <?php
                                if ($errors->has('complainer_address')) {
                                    echo "<div class='alert alert-danger'>Complainer Address is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>                
                <div class="row">                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            $get_department_by_division_url = url('admin/get_department_by_division');
                            $get_all_division_service_staff = url('admin/get-all-division-service-staff');
                            ?>
                            <label for="pwd">Complain Division<span class="required_text"></span></label>
                            <select class="form-control" id='div_id' name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>'); get_all_division_service_users(this.value, '<?php echo $get_all_division_service_staff; ?>');">
                                <option value="">Select</option>
                                <?php
                                $list   =   get_dynamic_division();
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
                            <label for="pwd">Department<span class="required_text"></span></label> 
                            <?php
                            if(old('div_id')){
                                $divId  =   old('div_id');
                            }
                            $get_department_wise_user_url   = url('admin/get_department_wise_user');
                            $get_category_by_department     = url('admin/get_category_by_department');
                            ?>
                            <select class="form-control" id="dept_id" name="dept_id" onchange="getCategoryByDepartment(this.value, 'div_id', 'category_id', '<?php echo $get_category_by_department; ?>');">
                                <option value="">Select</option>
                                <?php
                                    if(old('div_id')){
                                        $where      =   [
                                            'dept_id'   =>  $divId
                                        ];
                                        $order_by      =   [
                                            'order_by_column'   =>  'name',
                                            'order_by'          =>  'ASC',
                                        ];
                                        $table      = 'divisions';
                                        $dataType   = 'obj';
                                        $tableData  = get_table_data_by_table_and_where($table, $where, $order_by);
                                        if (isset($tableData) && !empty($tableData)) {
                                            foreach ($tableData as $data) {
                                                ?>
                                                <option value="<?php echo $data->id; ?>" <?php if(old('dept_id') && old('dept_id') == $data->id){ echo 'selected'; } ?>><?php echo $data->name; ?></option>   
                                                <?php
                                            }
                                        }  
                                    }
                                ?>
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
                            <label for="pwd">Category<span class="required_text"></span></label>
                            <?php
                            $url    =   route('admin.get_category_wise_complain_type');
                            ?>
                            <select class="form-control" id="category_id" name="category_id" onchange="getCategoryWiseComplainType(this.value, '<?php echo $url; ?>','complain_type_id','div_id','dept_id');">
                                <option value="">Select</option>
                                <?php
                                if (old('dept_id')) {
                                    $where      =   [
                                        'dept_id'   =>  $divId,
                                        'div_id'    =>  old('dept_id')
                                    ];
                                    $order_by      =   [
                                        'order_by_column'   =>  'name',
                                        'order_by'          =>  'ASC',
                                    ];
                                    $table      = 'complain_type_categories';
                                    $list  = get_table_data_by_table_and_where($table, $where, $order_by);
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
                                }
                                ?>
                            </select>
                            <?php
                                if ($errors->has('category_id')) {
                                    echo "<div class='alert alert-danger'>Complain Type is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Complain Type<span class="required_text"></span></label>
                            <select class="form-control" name="complain_type_id" id='complain_type_id'>
                                <option value="">Select Type</option>
                                <?php
                                if (old('category_id')) {
                                    $where = [
                                        'dept_id'       => $divId,
                                        'div_id'        => old('dept_id'),
                                        'category_id'   => old('category_id'),
                                    ];
                                    $order_by = [
                                        'order_by_column' => 'name',
                                        'order_by' => 'ASC',
                                    ];
                                    $table = 'complain_types';
                                    $list = get_table_data_by_table_and_where($table, $where, $order_by);
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
                            <label for="role">Address Division<span class="required_text"></span></label>
                            <?php $div_by_dis_url = route('admin.get_district_by_division') ?>
                            <select class="form-control" id="addr_div_id" name="addr_div_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_dis_id', '<?php echo $div_by_dis_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('addr_divisions');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php if(old('addr_div_id') && old('addr_div_id') == $data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>   
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
                            <label for="role">Address District<span class="required_text"></span></label>
                            <?php 
                                $up_by_dis_url = route('admin.get_upozila_by_district');
                            ?>
                            <select class="form-control" name="addr_dis_id" id="addr_dis_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_upazila_id', '<?php echo $up_by_dis_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                    if(old('addr_div_id')){
                                        $table = 'addr_districts';
                                        $where = [
                                            'division_id'       => old('addr_div_id')
                                        ];
                                        $order_by = [
                                            'order_by_column'   => 'name',
                                            'order_by'          => 'ASC',
                                        ];
                                        $tableData = get_table_data_by_table_and_where($table, $where, $order_by);
                                        if (isset($tableData) && !empty($tableData)) {
                                            foreach ($tableData as $data) {
                                                ?>
                                                <option value="<?php echo $data->id; ?>" <?php if(old('addr_dis_id') && old('addr_dis_id') == $data->id){ echo 'selected'; } ?>><?php echo $data->name; ?></option>   
                                                <?php
                                            }
                                        }  
                                    }
                                ?>
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
                            <label for="role">Address Upazila<span class="required_text"></span></label>
                            <?php $union_by_up_url = route('admin.get_union_by_upozila') ?>
                            <select class="form-control" name="addr_upazila_id" id="addr_upazila_id" onchange="getusersByDepartment(this.value, 'assign_to', '<?php echo $get_department_wise_user_url; ?>');">
                                <option value="">Select</option>  
                                <?php
                                    if(old('addr_upazila_id')){
                                        $table = 'addr_upazilas';
                                        $where = [
                                            'district_id'       => old('addr_dis_id')
                                        ];
                                        $order_by = [
                                            'order_by_column'   => 'name',
                                            'order_by'          => 'ASC',
                                        ];
                                        $tableData = get_table_data_by_table_and_where($table, $where, $order_by);
                                        if (isset($tableData) && !empty($tableData)) {
                                            foreach ($tableData as $data) {
                                                ?>
                                                <option value="<?php echo $data->id; ?>" <?php if(old('addr_upazila_id') && old('addr_upazila_id') == $data->id){ echo 'selected'; } ?>><?php echo $data->name; ?></option>   
                                                <?php
                                            }
                                        }  
                                    }
                                ?>
                            </select>
                            <?php
                                if ($errors->has('addr_upazila_id')) {
                                    echo "<div class='alert alert-danger'>Upozila is Required</div>";
                                }
                            ?>
                            <div class="new_upazial_union_data" id="addr_upazila_data">
                                <input type="text" name="addr_upazila_new_data">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role">Address Union<span class="required_text"></span></label>
                            <select class="form-control" name="addr_union_id" id="addr_union_id">
                                <option value="">Select</option>     
                                <option value="new">New</option>     
                                <?php
                                    if(old('addr_union_id')){
                                        $table = 'addr_unions';
                                        $where = [
                                            'upazila_id'       => old('addr_upazila_id')
                                        ];
                                        $order_by = [
                                            'order_by_column'   => 'name',
                                            'order_by'          => 'ASC',
                                        ];
                                        $tableData = get_table_data_by_table_and_where($table, $where, $order_by);
                                        if (isset($tableData) && !empty($tableData)) {
                                            foreach ($tableData as $data) {
                                                ?>
                                                <option value="<?php echo $data->id; ?>" <?php if(old('addr_union_id') && old('addr_union_id') == $data->id){ echo 'selected'; } ?>><?php echo $data->bn_name; ?></option>   
                                                <?php
                                            }
                                        }  
                                    }
                                ?>
                            </select>
                            <?php
                                if ($errors->has('addr_union_id')) {
                                    echo "<div class='alert alert-danger'>Union is Required</div>";
                                }
                            ?>
                            <div class="new_upazial_union_data" id="addr_union_data">
                                <input type="text" name="addr_union_new_data">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Assign To<span class="required_text"></span></label>
                            <select class="form-control" name="assign_to" id="assign_to">
                                <option value="">Select</option>
                            <?php
                                if ($errors->has('assign_to')) {
                                    echo "<div class='alert alert-danger'>Technician is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="complain details">Complain<span class="required_text"></span></label>
                            <textarea class="form-control" id="details" name="complain_details" rows="3"><?php echo old('complain_details'); ?></textarea>
                            <?php
                                if ($errors->has('complain_details')) {
                                    echo "<div class='alert alert-danger'>Complain Details is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Priority<span class="required_text"></span></label>
                            <select class="form-control" id='priority_id' name="priority_id">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('complain_priorites');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (old('priority_id') == $data->id) {
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
                            if ($errors->has('priority_id')) {
                                echo "<div class='alert alert-danger'>Priority is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">           
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="entry_type" value="1">
                            <input type="hidden" name="complain_entry_type" value="<?php echo $complain_entry_type; ?>">
                            <button type="submit" class="btn btn-info">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

