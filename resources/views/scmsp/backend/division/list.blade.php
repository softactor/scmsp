@extends('scmsp.backend.layout.app')
@section('title', 'List Devision')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Department</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Department</a></li>
                    <li class="breadcrumb-item active">Division List</li>
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
                        <!-- @include('scmsp.backend.partial.operation_message') -->
                        <a class="btn btn-outline-primary mb-4" style="float:right" href="{{route('admin.division-create')}}">Create New</a>
                        <table class="table table-bordered list-table-custom-style" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Division</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $deleteUrl = url('admin/division-delete');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                ?>
                                        <tr id='delete_row_id_{{$data->id}}'>
                                            <td>
                                                <?php
                                                $res    =   get_data_name_by_id('departments', $data->dept_id);
                                                echo (isset($res) && !empty($res) ? $res->name : '');
                                                ?>
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <a href="{{ url('admin/division-edit/'.$data->id) }}">
                                                    <i class="fa fa-edit text-success"></i>
                                                </a>
                                                <a href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
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