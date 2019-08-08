@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Type')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Type</a>
        </li>
        <li class="breadcrumb-item active">Complain Type List</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <a class="btn btn-outline-primary" style="float:right" href="{{ route('admin.complain-type-create') }}" >Create New</a>            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Division</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Division</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $deleteUrl  =   url('admin/complain-type-delete');    
                        if(!$list->isEmpty()){
                                foreach($list as $data){
                        ?>
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ get_data_name_by_id('departments',$data->dept_id)->name }}</td>
                            <td>{{ get_data_name_by_id('divisions',$data->div_id)->name }}</td>
                            <td>
                                <a href="{{ url('admin/complain-type-edit/'.$data->id) }}"><i class="fa fa-edit text-success"></i></a>
                                <a href="#"  onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');"><i class="fa fa-trash text-danger"></i></a>
                                
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection