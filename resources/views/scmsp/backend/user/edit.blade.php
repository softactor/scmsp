@extends('scmsp.backend.layout.app')
@section('title', 'Create User')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.user-list') }}">Users</a>
        </li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <!--<form action="{{ route('admin.user-update') }}" method="post">-->
            <form action="{{ route('admin.user-update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role_id">
                                <option value="">Select Role</option>
                                <?php
                                $staticRole         =   ['Service Staff','Area Manager'];
                                $list = get_table_data_by_table('roles');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        if($role!= 'Admin'){
                                            if(in_array($data->name, $staticRole)){
                                        ?>
                                        <option value="{{ $data->id }}" <?php
                                        if (isset($editData->role_id) && $editData->role_id == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}</option>   
    <?php }
    }else{ ?>
        <option value="{{ $data->id }}" <?php
                                        if (isset($editData->role_id) && $editData->role_id == $data->id) {
                                            echo 'selected';
                                        }
            ?>>{{ $data->name }}
            </option>
    <?php }
        }// foreach
    }

?>                        
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name',$editData->name) }}">
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email',$editData->email) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="psw">Password</label>
                            <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="psw">Mobile</label>
                            <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" value="{{ old('mobile',$editData->mobile) }}">
                        </div>                
                    </div>                
                </div>  
                <div class="row">
                    <div class="col-md-6">                    
                        <div class="form-group">
<?php
$get_department_by_division_url = url('admin/get_department_by_division');
?>
                            <label for="pwd">Complain Division</label>
                            <select class="form-control" name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                                <option value="">Select</option>
                                <?php
                                if($role!= 'Admin'){
                                    $divWhere       =   [
                                        'id'          =>  $userDetails->division_id
                                    ];
                                    $list = get_table_data_by_table_and_where('departments', $divWhere);
                                }else{
                                    $list = get_table_data_by_table('departments');
                                }
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php if (isset($editData->division_id) && $editData->division_id == $data->id) {
                                    echo 'selected';
                                } ?>>{{ $data->name }}</option>
        <?php
    }
}
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd">Complain Department</label>
                                <?php $getAreaManagerUrl = route('admin.get_area_manager_by_department') ?>                            
                            <select class="form-control" id="dept_id" name="dept_id">
                                <option value="">Select</option>
                                <?php
                                $list = get_table_data_by_table('divisions');
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
                </div>
                <?php
                $table = 'staff_locations';
                $where = [
                    'user_id' => $editData->id
                ];
                $addressDatas = get_table_data_by_table_and_where($table, $where);
                if(!$addressDatas->isEmpty()){                    
                ?>
                <div class="row">
                    
                    <div class="col-md-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered list-table-custom-style">
                                <thead>
                                    <tr>
                                        <th>Address Division</th>
                                        <th>Address District</th>
                                        <th>Address Upazila</th>
                                        <th>Address Union</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user_address_body">
                                    <?php
                                    
                                        foreach($addressDatas as $addressData_key=>$addressData){
                                            $row_id     =   $addressData->id;
                
                                            $is_all_location    = (isset($addressData->all_division) && !empty($addressData->all_division) ? $addressData->all_division : '');
                                            $addr_div_id        = (isset($addressData->addr_div_id) && !empty($addressData->addr_div_id) ? $addressData->addr_div_id : '');
                                            $addr_dis_id        = (isset($addressData->addr_dis_id) && !empty($addressData->addr_dis_id) ? $addressData->addr_dis_id : '');
                                            $addr_up_id         = (isset($addressData->addr_up_id) && !empty($addressData->addr_up_id) ? $addressData->addr_up_id : '');
                                            $addr_union_id      = (isset($addressData->addr_union_id) && !empty($addressData->addr_union_id) ? $addressData->addr_union_id : '');
                                            $area_mng_id        = (isset($addressData->area_mng_id) && !empty($addressData->area_mng_id) ? $addressData->area_mng_id : '');
                                    
                                    ?>
                                    <tr id="more_address_row_<?php echo $row_id; ?>">
                                        <td>
                                            <div class="form-group">
                                                <?php $div_by_dis_url = route('admin.get_district_by_division') ?>
                                                <select class="form-control" name="addr_div_id[]" onchange="getAddressRelatedAjaxdata(this.value, 'addr_dis_id_<?php echo $row_id; ?>', '<?php echo $div_by_dis_url; ?>');">
                                <option value="">Select</option>
                                        <?php
                                        $list = get_table_data_by_table('addr_divisions');
                                        if (!$list->isEmpty()) {
                                            foreach ($list as $data) {
                                                ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (isset($addr_div_id) && $addr_div_id == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}</option>
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
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <?php $up_by_dis_url = route('admin.get_upozila_by_district') ?>
                                                <select class="form-control" name="addr_dis_id[]" id="addr_dis_id_<?php echo $row_id; ?>" onchange="getAddressRelatedAjaxdata(this.value, 'addr_upazila_id_<?php echo $row_id; ?>', '<?php echo $up_by_dis_url; ?>');">
                                <option value="">Select</option>
                                        <?php
                                        $list = get_table_data_by_table('addr_districts');
                                        if (!$list->isEmpty()) {
                                            foreach ($list as $data) {
                                                ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (isset($addr_dis_id) && $addr_dis_id == $data->id) {
                                                    echo 'selected';
                                                }
                                                ?>>{{ $data->name }}</option>
        <?php
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
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <?php $union_by_up_url = route('admin.get_union_by_upozila') ?>
                                                <select class="form-control" name="addr_upazila_id[]" id="addr_upazila_id_<?php echo $row_id; ?>" onchange="getAddressRelatedAjaxdata(this.value, 'addr_union_id_<?php echo $row_id; ?>', '<?php echo $union_by_up_url; ?>');">
                                <option value="">Select</option> 
                                        <?php
                                        $list = get_table_data_by_table('addr_upazilas');
                                        if (!$list->isEmpty()) {
                                            foreach ($list as $data) {
                                                ?>
                                        <option value="{{ $data->id }}"<?php
                                                if (isset($addr_up_id) && $addr_up_id == $data->id) {
                                                    echo 'selected';
                                                }
                                                ?>>{{ $data->name }}</option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                                                <?php
                                                if ($errors->has('addr_upazila_id')) {
                                                    echo "<div class='alert alert-danger'>Upazila is Required</div>";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="addr_union_id[]" id="addr_union_id_<?php echo $row_id; ?>">
                                                    <option value="">Select</option> 
                    <?php
                    $list = get_table_data_by_table('addr_unions');
                    if (!$list->isEmpty()) {
                        foreach ($list as $data) {
                            ?>
                                                            <option value="{{ $data->id }}"<?php
                            if (isset($addr_union_id) && $addr_union_id == $data->id) {
                                echo 'selected';
                            }
                            ?>>{{ $data->bn_name }}</option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                                if ($errors->has('addr_union_id')) {
                                                    echo "<div class='alert alert-danger'>Union is Required</div>";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            
                                                $more_address_row   = route('admin.more_address_row');
                                                if($addressData_key == 0){
                                            ?>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="add_more_address_row('<?php echo $more_address_row; ?>')">Add More</button>
                                                <?php }else{ ?>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="remove_more_address_row('<?php echo $row_id; ?>')">Remove Address</button>
                                                <?php } ?>
                                        </td>
                                    </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd">Area Manager                            
                            <select class="form-control" id="area_manager_id" name="area_manager_id">
                                <option value="">Select</option>
                                <?php
                                    $managerParamData          =   (object)[
                                        'division_id'   => $editData->division_id,
                                        'department_id' => $editData->department_id
                                    ];
                                    $list = get_area_manager_by_department($managerParamData);
                                    if (!$list->isEmpty()) {
                                        foreach ($list as $data) {
                                            ?>
                                                                            <option value="{{ $data->user_id }}"<?php
                                            if (isset($area_mng_id) && $area_mng_id == $data->user_id) {
                                                echo 'selected';
                                            }
                                            ?>>{{ $data->user_name }}</option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
<span style="color: red;font-style: italic; font-size: 12px; font-weight: bold;">(This option only be needed when role is service incharge and he/she will under one Area Manager)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">All Location?</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="all_division" value="1" <?php if(isset($is_all_location) && !empty($is_all_location)){ echo 'checked'; } ?>> Yes
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type='hidden' name="user_update_id" value="<?php echo $editData->id; ?>">
                <input type="submit" name="update" value="Update" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
@endsection