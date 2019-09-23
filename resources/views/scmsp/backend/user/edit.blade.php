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
            <form action="{{ route('admin.user-update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name',$editData->name) }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('name',$editData->email) }}">
                </div>
                <div class="form-group">
                    <label for="psw">Mobile</label>
                    <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" value="{{ old('mobile',$editData->mobile) }}">
                </div>
                <div class="form-group">
                    <label for="psw">Password</label>
                    <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role_id">
                        <option value="">Select Role</option>
                        <?php
                            $list = get_table_data_by_table('roles');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($editData->role_id) && $editData->role_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>   
                        <?php }} ?>                        
                    </select>
                </div>
                <div class="form-group">
                    <?php
                        $get_department_by_division_url     =   url('admin/get_department_by_division');
                    ?>
                    <label for="pwd">Complain Division</label>
                    <select class="form-control" name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                        <option value="">Select</option>
                        <?php
                        $list = get_table_data_by_table('departments');
                        if (!$list->isEmpty()) {
                            foreach ($list as $data) {
                                ?>
                                <option value="{{ $data->id }}"<?php if(isset($editData->division_id) && $editData->division_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Complain Department</label>                            
                    <select class="form-control" id="dept_id" name="dept_id">
                        <option value="">Select</option>
                        <?php
                        $list = get_table_data_by_table('divisions');
                        if (!$list->isEmpty()) {
                            foreach ($list as $data) {
                                ?>
                                <option value="{{ $data->id }}"<?php if(isset($editData->department_id) && $editData->department_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                </div>
                <input type='hidden' name="user_update_id" value="<?php echo $editData->id; ?>">
                <input type="submit" name="update" value="Update" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
@endsection