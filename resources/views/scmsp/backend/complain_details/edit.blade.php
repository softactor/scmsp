@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.complain-details-list') }}">Complain Details</a>
        </li>
        <li class="breadcrumb-item active">Update Complain Details</li>
    </ol>
    <div class='row'>
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.complain-details-update') }}">
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
                            <label for="complainer">Complainer</label>
                            <input type="text" class="form-control" name="complainer" placeholder="Enter Complainer Phone" id='search_text' onkeyup="autosearch()" value="{{ old('name',$editData->complainer) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--demoDatepicker-->
                            <label for="complainer">Complain Date</label>
                            <input type="text" class="form-control" name="complain_date" id="complain_date" placeholder="Complainer Date" autocomplete="off" value="{{ old('complain_date',$editData->issued_date) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="complain details">Complain</label>
                            <textarea class="form-control" id="details" name="complain_details">{{ old('complain_details',$editData->complain_details) }}</textarea>
                        </div>
                    </div>
                </div>
                <?php
                if ($feedback_details) {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="complain details"><strong><u>Feedback</u></strong><span style="font-style: italic;"> &nbsp;&nbsp; (Last update on <?php echo human_format_date($editData->updated_at); ?>)</span></label>
                                <p class="complain_n_feedback_para">{{ $editData->feedback_details }}</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Complain Type</label>
                            <select class="form-control" name="complain_type_id">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Division</label>
                            <?php
                            $get_department_by_division_url = url('admin/get_department_by_division');
                            ?>
                            <select class="form-control" name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
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
                            <label for="pwd">Department</label> 
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
                            <label for="pwd">Assign To</label>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Complain Status</label>
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
                </div>
                <input type="hidden" name="edit_id" value="{{ $editData->id }}">
<?php
if (!$feedback_details) {
    ?>
                    <button type="submit" class="btn btn-info">Update</button>
<?php } ?>
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
            <?php $data=[
                    'history' => $complainHistory
                ]  ?>
            @include('scmsp.backend.partial.complain_history', $data)
        </div>
    </div>
</div>
@endsection