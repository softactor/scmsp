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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="complainer">Complainer</label>
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
                            <!--demoDatepicker-->
                            <label for="complainer">Complain Date</label>
                            <input type="text" class="form-control" name="complain_date" id="complain_date" placeholder="Complainer Date" autocomplete="off" value="<?php echo date('Y-m-d') ?>">
                            <?php
                                if ($errors->has('complain_date')) {
                                    echo "<div class='alert alert-danger'>Complain Date is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>                
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
                                        ?>>{{ $data->name }}</option>
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
                            <select class="form-control" id="dept_id" name="dept_id" onchange="getusersByDepartment(this.value, 'assign_to', '<?php echo $get_department_wise_user_url; ?>');getCategoryByDepartment(this.value, 'div_id', 'category_id', '<?php echo $get_category_by_department; ?>');">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Assign To</label>
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
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="complain details">Complain</label>
                            <textarea class="form-control" id="details" name="complain_details" rows="6"><?php echo old('complain_details'); ?></textarea>
                            <?php
                                if ($errors->has('complain_details')) {
                                    echo "<div class='alert alert-danger'>Complain Details is Required</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">           
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Status</label>
                            <select class="form-control" name="complain_status">
                                <?php
                                $list = get_table_data_by_table('complain_statuses');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (old('complain_status') == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}</option>
                                <?php }
                            }
                            ?>
                            </select>
                            <?php
                            if ($errors->has('complain_status')) {
                                echo "<div class='alert alert-danger'>Complain status is Required</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Priority</label>
                            <select class="form-control" id='priority_id' name="priority_id">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('complain_priorites');
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
                            <button type="submit" class="btn btn-info">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

