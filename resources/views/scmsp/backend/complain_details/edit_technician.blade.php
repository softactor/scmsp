@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Details</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.complain-details-update') }}">
                @csrf
                <h2>Update Complain</h2>
                @include('scmsp.backend.partial.operation_message')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong><u>Main Complain</u></strong>
                            <p>{{ $editData->complain_details }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="complain details"><strong><u>Complain Details</u></strong></label>
                            <textarea class="form-control" id="details" name="complain_details">{{ old('complain_details',$editData->complain_details) }}</textarea>
                        </div>
                    </div>
                </div>                    
                <div class="row">           
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Status</label>
                            <select class="form-control" name="complain_status">
                                <?php
                                $list = get_table_data_by_table('complain_statuses');
                                if (!$list->isEmpty()) {
                                    foreach ($list as $data) {
                                        ?>
                                        <option value="{{ $data->id }}"<?php
                                        if (isset($editData->complain_status) && $editData->complain_status == $data->id) {
                                            echo 'selected';
                                        }
                                        ?>>{{ $data->name }}</option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                    </div>
                </div>   
                <input type="hidden" name="edit_id" value="{{ $editData->id }}">
                <button type="submit" class="btn btn-info">Update</button>
            </form>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">          
                <table class="table table-bordered">
                    <tr>
                        <th>Complainer</th>
                        <th colspan="4">Complain Date</th>
                    </tr>
                    <tr>
                        <td><?php echo $editData->complainer; ?></td>
                        <td colspan="4"><?php echo $editData->issued_date; ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            Others details
                        </td>
                    </tr>
                    <tr>
                        <th>Complain Type</th>
                        <th>Division</th>
                        <th>Department</th>
                        <th>Assign To</th>
                        <th>Assign By</th>
                    </tr>
                    <tr>
                        <td><?php echo get_data_name_by_id('complain_types', $editData->complain_type_id)->name; ?></td>
                        <td><?php echo get_data_name_by_id('departments', $editData->division_id)->name; ?></td>
                        <td><?php echo get_data_name_by_id('divisions', $editData->department_id)->name; ?></td>
                        <td><?php echo (isset($editData->assign_to) && !empty($editData->assign_to) ? get_data_name_by_id('users', $editData->assign_to)->name : ''); ?></td>
                        <td><?php echo (isset($editData->user_id) && !empty($editData->user_id) ? get_data_name_by_id('users', $editData->user_id)->name : ''); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection