@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Details</a>
        </li>
        <li class="breadcrumb-item active">Complain Details List</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
               <?php
                    $roleName                   =   getRoleNameByUserId(Auth::user()->id);
                    if(hasAccessPermission($roleName, 'Complain details', 'addaccess')){
                ?>
               <a class="btn btn-outline-primary" style="float:right" href="{{ route('admin.complain-details-create') }}" >Create New</a>
                <?php } ?>
           @include('scmsp.backend.partial.operation_message') 
           <table class="table table-bordered complain_details_table_style list-table-custom-style" id="complainDetailsdataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Priority</th>
                            <th>Complain date</th>
                            <th>Complain raw date</th>
                            <th>complainer</th>
                            <th>Complain Type</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>In-Charge</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Priority</th>
                            <th>Complain date</th>
                            <th>Complain raw date</th>
                            <th>complainer</th>
                            <th>Complain Type</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>In-Charge</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $deleteUrl  =   url('admin/complain-details-delete');
                            if(!$list->isEmpty()){
                                foreach($list as $data){
                                $rawColor   =   get_status_wise_row_color($data->complain_status);
                        ?>
                        <tr id='delete_row_id_{{$data->id}}' class="<?php echo $rawColor; ?>">
                            <td>{{ get_data_name_by_id('complain_priorites',$data->priority_id)->name }}</td>
                            <td><?php echo human_format_date($data->created_at); ?></td>
                            <td><?php echo $data->created_at; ?></td>
                            <td>{{ $data->complainer }}</td>                            
                            <td>{{ get_data_name_by_id('complain_types',$data->complain_type_id)->name }}</td>                            
                            <td>{{ $data->complain_details }}</td>
                            <td>
                                <a href="{{ url('admin/complain-details-edit/'.$data->id) }}">
                                    {{ get_data_name_by_id('complain_statuses',$data->complain_status)->name }}
                                </a>
                            </td>
                            <td>{{ (isset($data->assign_to) && !empty($data->assign_to) ? get_data_name_by_id('users',$data->assign_to)->name : '') }}</td>
                            <td>{{ (isset($data->user_id) && !empty($data->user_id) ? get_data_name_by_id('users',$data->user_id)->name : '') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      <a class="dropdown-item" href="{{ url('admin/complain-details-edit/'.$data->id) }}">Edit</a>
                                      <a class="dropdown-item" href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">Delete</a>
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