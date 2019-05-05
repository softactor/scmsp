@extends('scmsp.backend.layout.app')
@section('title', 'List Devision')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Devision</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>List Division<button type="button" class="btn btn-outline-primary" style="float:right" onclick="window.location.href='{{ route('admin.division-create') }}'" >Create New</button></h2>
            @include('scmsp.backend.partial.operation_message')
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
                            if(!$list->isEmpty()){
                                foreach($list as $data){
                        ?>
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ get_data_name_by_id('departments',$data->dept_id)->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      <a class="dropdown-item" href="{{ url('admin/division-edit/'.$data->id) }}">Edit</a>
                                      <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection