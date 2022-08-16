@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Complain Details List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Complain Details</a></li>
                    <li class="breadcrumb-item active">Complain Details List</li>
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
                        <?php
                        $createUrl                  =   url("admin/complain-details-create/" . $complain_entry_type);
                        $roleName                   =   getRoleNameByUserId(Auth::user()->id);
                        if (hasAccessPermission($roleName, 'Complain details', 'addaccess')) {
                        ?>
                            <a class="" href="{{ $createUrl }}">
                                <button type="button" class="btn btn-sm btn-success float-right margin-fixing mb-3">New
                                    Complain</button>
                            </a>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-bordered complain_details_table_style list-table-custom-style" id="complainDetailsdataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 20px; text-align: right;">SL No.</th>
                                        <th>Division</th>
                                        <th>Code</th>
                                        <th>Priority</th>
                                        <th>Complain date</th>
                                        <th>Complain raw date</th>
                                        <th>Complainer</th>
                                        <th>Contact</th>
                                        <th>Complain Type</th>
                                        <th>Status</th>
                                        <th>In-Charge</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="width: 20px; text-align: right;">SL No.</th>
                                        <th>Division</th>
                                        <th>Code</th>
                                        <th>Priority</th>
                                        <th>Complain date</th>
                                        <th>Complain raw date</th>
                                        <th>Complainer</th>
                                        <th>Contact</th>
                                        <th>Complain Type</th>
                                        <th>Status</th>
                                        <th>In-Charge</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody id="complain_details">
                                    <?php
                                    $deleteUrl  =   url('admin/complain-details-delete');
                                    if (!$list->isEmpty()) {
                                        $sl    =    1;
                                        foreach ($list as $data) {
                                            $rawColor   =   get_status_wise_row_color($data->complain_status);
                                    ?>
                                            <tr id='delete_row_id_{{$data->id}}' class="<?php echo $rawColor; ?>">
                                                <td style="width: 20px; text-align: right;"><?php echo $sl++; ?></td>
                                                <td>
                                                    <?php
                                                    echo get_division_name_by_id($data->division_id)
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/complain-details-edit/'.$data->id) }}">
                                                        <?php echo $data->complainer_code; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $res    =   get_data_name_by_id('complain_priorites', $data->priority_id);
                                                    echo (isset($res) && !empty($res) ? $res->name : 'No data found');
                                                    ?>
                                                </td>
                                                <td><?php echo human_format_date($data->created_at); ?></td>
                                                <td><?php echo $data->created_at; ?></td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->complainer }}</td>
                                                <td>
                                                    <?php
                                                    $res    =   get_data_name_by_id('complain_types', $data->complain_type_id);
                                                    echo (isset($res) && !empty($res) ? short_str($res->name) : 'No data found');
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/complain-details-edit/'.$data->id) }}">
                                                        <?php
                                                        $res    =   get_data_name_by_id('complain_statuses', $data->complain_status);
                                                        echo (isset($res) && !empty($res) ? $res->name : 'No data found');
                                                        ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($data->assign_to) && !empty($data->assign_to)) {
                                                        $nameDetails    =   get_data_name_by_id('users', $data->assign_to);
                                                        if (isset($nameDetails) && !empty($nameDetails)) {
                                                            echo $nameDetails->name;
                                                        } else {
                                                            echo 'No Data';
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($data->user_id) && !empty($data->user_id)) {
                                                        $nameDetails    =   get_data_name_by_id('users', $data->user_id);
                                                        if (isset($nameDetails) && !empty($nameDetails)) {
                                                            echo $nameDetails->name;
                                                        } else {
                                                            echo 'No Data';
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/complain-details-edit/'.$data->id) }}">
                                                        <i class="fa fa-edit text-grey-darker"></i>
                                                    </a>
                                                    <?php
                                                    if (isSuperAdmin(Auth::user()->id)) {
                                                    ?>
                                                        <a href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
                                                            <i class="fa fa-trash text-grey-darker"></i>
                                                        </a>
                                                    <?php } ?>
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
    </div>
</section>
@section('footer_js_scrip_area')
@parent
<script type="text/javascript">
    function complain_details_auto_refresh() {
        setTimeout(function() {
            //location.reload();
        }, 30000);
    }
    complain_details_auto_refresh();
</script>
@endsection
@endsection