@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Type')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Complain Type List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Complain Type</a></li>
                    <li class="breadcrumb-item active">Complain Type List</li>
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
                        <a class="btn btn-outline-primary mb-3" style="float:right" href="{{ route('admin.complain-type-create') }}">Create New</a>
                        <table class="table table-bordered list-table-custom-style" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>Department</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Division</th>
                                    <th>Department</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $deleteUrl  =   url('admin/complain-type-delete');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $departRes  =   get_data_name_by_id('departments', $data->dept_id);
                                                echo (isset($departRes) && !empty($departRes) ? $departRes->name : 'Not Found');
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $divRes  =   get_data_name_by_id('divisions', $data->div_id);
                                                echo (isset($divRes) && !empty($divRes) ? $divRes->name : 'Not Found');
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $catRes  =   get_data_name_by_id('complain_type_categories', $data->category_id);
                                                echo (isset($catRes) && !empty($catRes) ? $catRes->name : 'Not Found');
                                                ?>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <a href="{{ url('admin/complain-type-edit/'.$data->id) }}"><i class="fa fa-edit text-success"></i></a>
                                                <a href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');"><i class="fa fa-trash text-danger"></i></a>

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
</section>
@endsection