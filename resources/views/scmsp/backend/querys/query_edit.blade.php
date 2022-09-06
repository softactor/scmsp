@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.complain-details-list') }}">Query Details</a>
        </li>
        <li class="breadcrumb-item active">Update Query Details</li>
    </ol>
    <div class='row'>
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.query-details-update') }}">
                @include('scmsp.backend.partial.operation_message')
                <?php
                if (isset($editData->feedback_details) && !empty($editData->feedback_details)) {
                    $feedback_details = true;
                } else {
                    $feedback_details = false;
                }
                ?>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complainer">Query Mobile<span class="required_text"></span></label>
                            <input type="text" class="form-control" name="complainer" placeholder="Enter Complainer Phone" id='search_text' onkeyup="autosearch()" value="{{ old('complainer',$editData->complainer) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--demoDatepicker-->
                            <label for="complainer">Query Date<span class="required_text"></span></label>
                            <input type="text" class="form-control" name="complain_date" id="complain_date" placeholder="Complainer Date" autocomplete="off" value="{{ old('complain_date',$editData->issued_date) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complainer">Name<span class="required_text"></span></label>
                            <input type="text" class="form-control" name="complainer_name" placeholder="Enter Complainer Name" id='search_text' onkeyup="autosearch()" value="{{ old('name',$editData->name) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--demoDatepicker-->
                            <label for="complainer">Address<span class="required_text"></span></label>
                            <input type="text" class="form-control" name="complainer_address" id="complainer_address" placeholder="Complainer address" autocomplete="off" value="{{ old('address',$editData->address) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="complain details">Query<span class="required_text"></span></label>
                            <textarea class="form-control" id="details" name="complain_details">{{ old('complain_details',$editData->complain_details) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="complain details"><strong><u>Feedback<span class="required_text"></span></u></strong>
                                <?php
                                    if(isset($editData->feedback_details) && !empty($editData->feedback_details)){
                                ?>
                                <span style="font-style: italic;"> &nbsp;&nbsp; (Last update on <?php echo human_format_date($editData->updated_at); ?>)</span>
                                <?php } ?>
                            </label>
                            <textarea class="form-control" id="feedback_details" name="feedback_details">{{ old('feedback_details',$editData->feedback_details) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Division<span class="required_text"></span></label>
                            <?php
                            $get_department_by_division_url = url('admin/get_department_by_division');
                            ?>
                            <select class="form-control" id='div_id' name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('departments');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (isset($editData->division_id) && $editData->division_id == $data->id) {
                                                    echo 'selected';
                                                }
                                                ?>>{{ $data->name }}</option>
        <?php
    }
}
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Department<span class="required_text"></span></label> 
                                <?php
                                $get_department_wise_user_url = url('admin/get_department_wise_user');
                                ?>
                            <select class="form-control" id="dept_id" name="dept_id" onchange="getusersByDepartment(this.value, 'assign_to', '<?php echo $get_department_wise_user_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                $param = [];
                                $param['table'] = 'divisions';
                                $param['where']['dept_id'] = $editData->division_id;
                                $list = get_table_data_by_clause($param);
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (isset($editData->department_id) && $editData->department_id == $data->id) {
                                                    echo 'selected';
                                                }
                                                ?>>{{ $data->name }}</option>
        <?php
    }
}
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Category<span class="required_text"></span></label>
                            <?php
                            $url = route('admin.get_category_wise_complain_type');
                            ?>
                            <select class="form-control" name="category_id" onchange="getCategoryWiseComplainType(this.value, '<?php echo $url; ?>','complain_type_id','div_id','dept_id');">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('complain_type_categories');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (isset($editData->category_id) && $editData->category_id == $data->id) {
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
                            <label for="pwd">Query Type<span class="required_text"></span></label>
                            <select class="form-control" id='complain_type_id' name="complain_type_id">
                                <option>Select Type</option>
                                <?php
                                $list = get_table_data_by_table('complain_types');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (isset($editData->complain_type_id) && $editData->complain_type_id == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}</option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd">Assign To<span class="required_text"></span></label>
                            <select class="form-control" name="assign_to" id="assign_to">
                                <option value="">Select</option>
                                <?php
                                $param = [];
                                $param['table'] = 'users';
                                $param['where']['division_id'] = $editData->division_id;
                                $param['where']['department_id'] = $editData->department_id;
                                $list = get_table_data_by_clause($param);
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (isset($editData->assign_to) && $editData->assign_to == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>><?php echo $data->name . " (" . $data->email . ")"; ?></option>
        <?php
    }
}
?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">           
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Query Status<span class="required_text"></span></label>
                            <select class="form-control" name="complain_status">
                                        <?php
                                        $list = get_table_data_by_table('complain_statuses');
                                        if (!$list->isEmpty()) {
                                            foreach ($list as $data) {
                                                ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (isset($editData->complain_status) && $editData->complain_status == $data->id) {
                                                    echo 'selected';
                                                }
                                                ?>>{{ $data->name }}</option>
                    <?php
                    }
                }
                ?>
                            </select>
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
                                                if (isset($editData->priority_id) && $editData->priority_id == $data->id) {
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
                <input type="hidden" name="edit_id" value="{{ $editData->id }}">
                    <button type="submit" class="btn btn-info btn-block">Update</button>
            </form>
        </div>
        <div class="col-md-6">
            <?php
            $param                 =   [];
            $param['table']                 =   'complain_details_history';
            $param['where']['complain_id']  =   $editData->id;
            $param['order_by_column']       =   'id';
            $param['order_by']              =   'DESC';
            $complainHistory                =   get_table_data_by_clause($param);
            ?>
            <?php 
                $data=[
                    'history' => $complainHistory
                ]  ?>
                @include('scmsp.backend.partial.complain_history', $data)
        </div>
    </div>
</div>
@endsection