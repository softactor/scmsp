@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Type')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Upazila List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Upazila</a></li>
                    <li class="breadcrumb-item active">Upazila List</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-primary" style="float:right"
                            href="{{ route('admin.address_upazila_create') }}">Create New</a>
                        <form class="form-inline mb-3" id="division_role_filter_form">
                            @include('scmsp.backend.partial.division_and_district_filter')
                            <?php
                            $filterDataUrl  =   url('admin/get_upazilla_list_by_district');
                            ?>
                            <button type="button" class="btn btn-primary ml-3"
                                onclick="get_upazilla_list_by_district('<?php echo $filterDataUrl; ?>');">Search</button>
                        </form>
                        <div class='row'>
                            <div class='col col-md-12 col-sm-12 col-lg-12'>
                                <table class="data_table table table-bordered list-table-custom-style" id="dataTable"
                                    width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Division</th>
                                            <th>District</th>
                                            <th>Upazila</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="upazila_list_tbody">
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
                                                <?php echo $data->upazila_name . ' (' . $data->upazila_bn_name . ')'; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php
                                                $editUrl   = url('admin/address_upazila_edit/' . $data->id);
                                                $deleteUrl = url('admin/address_upazila_delete');
                                                ?>
                                                <a href="<?php echo $editUrl; ?>">
                                                    <i class="fa fa-edit text-grey-darker"></i>
                                                </a>
                                                <?php
                                                if (isSuperAdmin(Auth::user()->id)) {
                                                ?>
                                                <a href="#"
                                                    onclick="delete_operation('{{ $deleteUrl }}','{{ $data->id }}');">
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection