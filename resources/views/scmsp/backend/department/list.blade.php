@extends('scmsp.backend.layout.app')
@section('title', 'List Department')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Division</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Division</a></li>
                    <li class="breadcrumb-item active">Division List</li>
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
                        <a class="btn btn-outline-primary mb-4"
                            href="{{ route('admin.department-create') }}">Create New</a>
                        <table class="data_table table table-bordered list-table-custom-style" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> -->
                            <tbody>
                                <?php
                            $deleteUrl  =   url('admin/department-delete');
                            if(!$list->isEmpty()){
                                foreach($list as $data){
                        ?>
                                <tr id='delete_row_id_{{$data->id}}'>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <a href="{{ url('admin/department-edit/'.$data->id) }}">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <a href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection