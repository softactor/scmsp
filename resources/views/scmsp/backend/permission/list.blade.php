@extends('scmsp.backend.layout.app')
@section('title', 'List Permission')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permission Overview</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Permission</a></li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <div class='row'>
            <div class='col col-md-12 col-sm-12 col-lg-12'>
                <div class="card">
                    <div class="card-body">
                        <h2>Permission List<button type="button" class="btn btn-outline-primary"
                                onclick="window.location.href='{{ route('admin.permission-create') }}'">Create
                                New</button></h2>
                        <table class="table table-bordered data_table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $deleteUrl  =   url('admin/permission-delete');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                ?>
                                <tr id='delete_row_id_{{$data->id}}'>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item"
                                                    href="{{ url('admin/permission-edit/'.$data->id) }}">Edit</a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">Delete</a>
                                            </div>
                                        </div>
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