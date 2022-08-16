@extends('scmsp.backend.layout.app')
@section('title', 'Create User')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Create User</li>
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
                        <form action="{{ route('admin.user-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role_id">
                                            <option value="">Select Role</option>
                                            <?php
                                            $staticRole         =   ['Service Staff', 'Area Manager'];
                                            $list = get_table_data_by_table('roles');
                                            if (!$list->isEmpty()) {
                                                foreach ($list as $data) {
                                                    if ($role != 'Admin') {
                                                        if (in_array($data->name, $staticRole)) {
                                            ?>
                                                            <option value="{{ $data->id }}" <?php
                                                                                            if (old('role_id') == $data->id) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                            ?>>{{ $data->name }}
                                                            </option>
                                                        <?php
                                                        }
                                                    } else { ?>
                                                        <option value="{{ $data->id }}" <?php
                                                                                        if (old('role_id') == $data->id) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                        ?>>{{ $data->name }}
                                                        </option>
                                            <?php }
                                                } // foreach
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        if ($errors->has('role_id')) {
                                            echo "<div class='alert alert-danger'>Role is Required</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo old('name'); ?>">
                                        <?php
                                        if ($errors->has('name')) {
                                            echo "<div class='alert alert-danger'>Name is Required</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo old('email'); ?>">
                                        <?php
                                        if ($errors->has('email')) {
                                            echo "<div class='alert alert-danger'>Email is Required</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="psw">Password</label>
                                        <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password">
                                        <?php
                                        if ($errors->has('password')) {
                                            echo "<div class='alert alert-danger'>Password is Required</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="psw">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" value="<?php echo old('mobile'); ?>">
                                        <?php
                                        if ($errors->has('mobile')) {
                                            echo "<div class='alert alert-danger'>Mobile is Required</div>";
                                        }
                                        ?>
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
                                        <select class="form-control" name="div_id" id="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                                            <option value="">Select</option>
                                            <?php
                                            if ($role != 'Admin') {
                                                $divWhere       =   [
                                                    'id'          =>  $userDetails->division_id
                                                ];
                                                $list = get_table_data_by_table_and_where('departments', $divWhere);
                                            } else {
                                                $list = get_table_data_by_table('departments');
                                            }
                                            if (!$list->isEmpty()) {
                                                foreach ($list as $data) {
                                            ?>
                                                    <option value="{{ $data->id }}" <?php
                                                                                    if (isset($_POST['div_id']) && $_POST['div_id'] == $data->id) {
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Complain Department</label>
                                        <?php $getAreaManagerUrl = route('admin.get_area_manager_by_department') ?>
                                        <select class="form-control" id="dept_id" name="dept_id" onchange="getAreaManagerByDepartment(this.value, 'div_id', 'area_manager_id', '<?php echo $getAreaManagerUrl; ?>')">
                                            <option value="">Select</option>
                                        </select>
                                        <?php
                                        if ($errors->has('dept_id')) {
                                            echo "<div class='alert alert-danger'>Department is Required</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                            <!--Multi address add section-->

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
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <?php $div_by_dis_url = route('admin.get_district_by_division') ?>
                                                            <select class="form-control" name="addr_div_id[]" onchange="getAddressRelatedAjaxdata(this.value, 'addr_dis_id', '<?php echo $div_by_dis_url; ?>');">
                                                                <option value="">Select</option>
                                                                <?php
                                                                $list = get_table_data_by_table('addr_divisions');
                                                                if (!$list->isEmpty()) {
                                                                    foreach ($list as $data) {
                                                                ?>
                                                                        <option value="{{ $data->id }}" <?php
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
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <?php $up_by_dis_url = route('admin.get_upozila_by_district') ?>
                                                            <select class="form-control" name="addr_dis_id[]" id="addr_dis_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_upazila_id', '<?php echo $up_by_dis_url; ?>');">
                                                                <option value="">Select</option>
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
                                                            <select class="form-control" name="addr_upazila_id[]" id="addr_upazila_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_union_id', '<?php echo $union_by_up_url; ?>');">
                                                                <option value="">Select</option>
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
                                                            <select class="form-control" name="addr_union_id[]" id="addr_union_id">
                                                                <option value="">Select</option>
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
                                                        ?>
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="add_more_address_row('<?php echo $more_address_row; ?>')">Add
                                                            More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>



                            <!--End Multi address add section-->


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Area Manager</label>
                                        <select class="form-control" id="area_manager_id" name="area_manager_id">
                                            <option value="">Select</option>
                                        </select>
                                        <span style="color: red;font-style: italic; font-size: 12px; font-weight: bold;">(This
                                            option only be needed when role is service incharge and he/she will under
                                            one Area Manager)</span>
                                        <?php
                                        if ($errors->has('area_manager_id')) {
                                            echo "<div class='alert alert-danger'>Area Manager is Required</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">All Location?</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="all_division" value="1"> Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Create" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection