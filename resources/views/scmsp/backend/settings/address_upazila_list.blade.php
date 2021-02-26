@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Type')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Upazial</a>
        </li>
        <li class="breadcrumb-item active">Upazila List</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <a class="btn btn-outline-primary" style="float:right" href="{{ route('admin.address_upazila_create') }}" >Create New</a>            
            <table class="table table-bordered list-table-custom-style" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Division</th>
                        <th>District</th>
                        <th>Upazila</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $deleteUrl = url('admin/complain-type-delete');
                    if (!$list->isEmpty()) {
                        foreach ($list as $data) {
                            ?>
                            <tr id="delete_row_id_<?php echo $data->id; ?>">
                                <td>
                                    <?php echo $data->division_name; ?>
                                </td>
                                <td>
                                    <?php echo $data->district_name; ?>
                                </td>
                                <td>
                                    <?php echo $data->upazila_name.' ('.$data->upazila_bn_name.')'; ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php 
                                        $editUrl   = url('admin/address_upazila_edit/'.$data->id);
                                        $deleteUrl = url('admin/address_upazila_delete');
                                    ?>
                                    <a href="<?php echo $editUrl; ?>">
                                        <i class="fa fa-edit text-grey-darker"></i>
                                    </a>
                                    <?php
                                      if(isSuperAdmin(Auth::user()->id)){
                                    ?>
                                    <a href="#" onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
                                        <i class="fa fa-trash text-danger"></i>
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
@endsection