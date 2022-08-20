@extends('scmsp.backend.layout.app')
@section('title', 'List User')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Users List</li>
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
                    <div class='col-md-12'>
                        <?php
                        $filterDataUrl  =   route("admin.get_user_data_by_division_role")
                        ?>
                        <div class="row">
                            <div class="col-md-10 mb-4">
                                <form class="form-inline" id="division_role_filter_form">
                                    @include('scmsp.backend.partial.division_and_role_filter')
                                    <button type="button" class="btn btn-primary ml-3" onclick="get_user_data_by_division_role('<?php echo $filterDataUrl; ?>');">Search</button>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-outline-primary" href="{{ route('admin.user-create') }}">Create New</a>
                            </div>
                        </div>
                        <div class="filter_separation"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="user_list_data_table_section">
                                    <table class="data_table table table-bordered list-table-custom-style" id="user_list_data_table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Division</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users_list_data_body">
                                            <?php
                                            $sl = 1;
                                            $deleteUrl = url('admin/user-delete');
                                            if (!$list->isEmpty()) {
                                                foreach ($list as $data) {
                                            ?>
                                                    <tr id='delete_row_id_{{$data->id}}'>
                                                        <td><?php echo $sl++; ?></td>
                                                        <td>
                                                            <?php
                                                            if (isset($data->division_id) && !empty($data->division_id)) {
                                                                $divname = get_data_name_by_id('departments', $data->division_id);
                                                                if (isset($divname) && !empty($divname)) {
                                                                    echo $divname->name;
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><a href="{{ url('admin/user-edit/'.$data->id) }}" title="Click here to edit">{{ $data->name }}</a></td>
                                                        <td>{{ $data->email }}</td>
                                                        <td><?php echo (isset($data->role_id) && !empty($data->role_id) ? get_data_name_by_id('roles', $data->role_id)->name : 'Role unassigned!') ?>
                                                        </td>
                                                        <td><?php echo (isset($data->mobile) && !empty($data->mobile) ? $data->mobile : 'No Data') ?>
                                                        </td>
                                                        <td>
                                                            <a title="Edit" href="{{ url('admin/user-edit/'.$data->id) }}">
                                                                <i class="fa fa-edit text-success"></i>
                                                            </a>
                                                            <?php
                                                            $loggedinUser = Auth::user()->id;
                                                            if ($loggedinUser != $data->id) {
                                                            ?>
                                                                <a title="Delete" href="javascript:void(0)" onclick="user_delete_operation('{{ $deleteUrl }}', '{{ $data->id }}');">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection