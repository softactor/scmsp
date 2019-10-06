@extends('scmsp.backend.layout.app')
@section('title', 'List User')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.user-list') }}">Users</a>
        </li>
        <li class="breadcrumb-item active">Users List</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <a class="btn btn-outline-primary" style="float:right" href="{{ route('admin.user-create') }}" >Create New</a>
            @include('scmsp.backend.partial.operation_message')
            <table class="table table-bordered list-table-custom-style" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $deleteUrl  =   url('admin/user-delete');
                            if(!$list->isEmpty()){
                                foreach($list as $data){
                        ?>
                        <tr id='delete_row_id_{{$data->id}}'>
                            <td><a href="{{ url('admin/user-edit/'.$data->id) }}" title="Click here to edit">{{ $data->name }}</a></td>
                            <td>{{ $data->email }}</td>
                            <td><?php echo (isset($data->role_id) && !empty($data->role_id) ? get_data_name_by_id('roles',$data->role_id)->name : 'Role unassigned!') ?></td>
                            <td><?php echo (isset($data->mobile) && !empty($data->mobile) ? $data->mobile : 'No Data') ?></td>
                            <td>
                                <a title="Edit" href="{{ url('admin/user-edit/'.$data->id) }}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                    <?php
                                    $loggedinUser     =   Auth::user()->id;
                                    if($loggedinUser != $data->id){
                                    ?>
                                      <a title="Delete" href="javascript:void(0)" onclick="user_delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
                                          <i class="fa fa-trash text-danger"></i>
                                      </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection