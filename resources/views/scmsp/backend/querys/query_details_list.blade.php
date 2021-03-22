@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Query Details</a>
        </li>
        <li class="breadcrumb-item active">Query Details List</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
               <?php
                    $roleName                   =   getRoleNameByUserId(Auth::user()->id);
                    if(hasAccessPermission($roleName, 'Complain details', 'addaccess')){
                ?>
            <a class="" href="{{ route('admin.query-details-create') }}" >
                <button type="button" class="btn btn-sm btn-success float-right margin-fixing">New Query</button>
            </a>
                <?php } ?>
           @include('scmsp.backend.partial.operation_message') 
           <div class="table-responsive">
           <table class="table table-bordered complain_details_table_style list-table-custom-style" id="complainDetailsdataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Priority</th>
                            <th>Query date</th>
                            <th>Complain raw date</th>
                            <th>Query By</th>
                            <th>Contact</th>
                            <th>Query Type</th>
                            <th>Status</th>
                            <th>In-Charge</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Code</th>
                            <th>Priority</th>
                            <th>Query date</th>
                            <th>Complain raw date</th>
                            <th>Query By</th>
                            <th>Contact</th>
                            <th>Query Type</th>
                            <th>Status</th>
                            <th>In-Charge</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="complain_details">
                        <?php
                        $deleteUrl  =   url('admin/complain-details-delete');
                            if(!$list->isEmpty()){
                                foreach($list as $data){
                                $rawColor   =   get_status_wise_row_color($data->complain_status);
                        ?>
                        <tr id='delete_row_id_{{$data->id}}' class="<?php echo $rawColor; ?>">
                            <td>
                                <a href="{{ url('admin/query-details-edit/'.$data->id) }}"> 
                                <?php echo $data->complainer_code; ?>
                                </a>
                            </td>
                            <td>
                                <?php 
                                    $res    =   get_data_name_by_id('complain_priorites',$data->priority_id);
                                    echo    (isset($res) && !empty($res) ? $res->name : 'No data found');
                                ?>
                            </td>
                            <td><?php echo human_format_date($data->created_at); ?></td>
                            <td><?php echo $data->created_at; ?></td>
                            <td>{{ $data->name }}</td>                            
                            <td>{{ $data->complainer }}</td>                            
                            <td>
                                <?php 
                                    $res    =   get_data_name_by_id('complain_types',$data->complain_type_id);
                                    echo    (isset($res) && !empty($res) ? short_str($res->name) : 'No data found');
                                ?>
                            </td>                            
                            <td>
                                <a href="{{ url('admin/complain-details-edit/'.$data->id) }}">                                    
                                    <?php 
                                        $res    =   get_data_name_by_id('complain_statuses',$data->complain_status);
                                        echo    (isset($res) && !empty($res) ? $res->name : 'No data found');
                                    ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                    if(isset($data->assign_to) && !empty($data->assign_to)){
                                        $res    =   get_data_name_by_id('users',$data->assign_to);
                                        echo    (isset($res) && !empty($res) ? $res->name : 'No data found');                                        
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(isset($data->user_id) && !empty($data->user_id)){
                                        $res    =   get_data_name_by_id('users',$data->user_id);
                                        echo    (isset($res) && !empty($res) ? $res->name : 'No data found');                                        
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="{{ url('admin/query-details-edit/'.$data->id) }}">
                                    <i class="fa fa-edit text-grey-darker"></i>
                                </a>
                                <?php
                                  if(isSuperAdmin(Auth::user()->id)){
                                ?>
                                <a href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
                                    <i class="fa fa-trash text-grey-darker"></i>
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
</div>
@section('footer_js_scrip_area')
    @parent
    <script type="text/javascript">
        function complain_details_auto_refresh(){
            setTimeout(function() {
                location.reload();
            }, 30000);
        }
        complain_details_auto_refresh();
    </script>
@endsection
@endsection