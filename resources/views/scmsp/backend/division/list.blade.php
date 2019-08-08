@extends('scmsp.backend.layout.app')
@section('title', 'List Devision')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Department</a>
        </li>
        <li class="breadcrumb-item active">Department List</li>
    </ol>            
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <a class="btn btn-outline-primary" style="float:right" href="{{route('admin.division-create')}}">Create New</a>            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
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
                                <td>{{ $data->name }}</td>
                                <td>{{ get_data_name_by_id('departments',$data->dept_id)->name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                            <a class="dropdown-item" href="{{ url('admin/division-edit/'.$data->id) }}">Edit</a>

                                            <a class="dropdown-item" href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">Delete</a>
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
@endsection