@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Edit Complain Details</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Edit Complain Details</h2>
            @include('scmsp.backend.partial.operation_message')
            <?php
            $sessionEditData   =   Session::get('editData');
            if(isset($sessionEditData) && !empty($sessionEditData)){
                $editData   =   $sessionEditData; 
            }
            ?>
            <form method="POST" action="{{ route('admin.complain-details-update') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Type</label>
                            <select class="form-control" name="complain_type_id">
                                <option>Select Type</option>
                                <?php
                                $list = get_table_data_by_table('complain_types');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->id }}"<?php if((isset($complain_type_id) && $complain_type_id==$data->id) || isset($editData->complain_type_id) && $editData->complain_type_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="complainer">Complainer</label>
                            <input type="text" class="form-control" name="complainer" id="complainer" value="{{ old('name',$editData->complainer) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="complainer">Issue Date</label>
                            <input type="text" class="form-control" name="issued_date" id="datepicker" value="{{ old('name',$editData->issued_date) }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Status</label>
                            <select class="form-control" name="complain_status">
                                <?php
                                $list = get_table_data_by_table('complain_statuses');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->id }}"<?php if((isset($complain_status) && $complain_status==$data->id) || isset($editData->complain_status) && $editData->complain_status==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <label for="complain details">Complain Details</label>
                    <textarea class="form-control" id="details" name="complain_details">{{ old('complain_details',$editData->complain_details) }}</textarea>
                </div>
                <input type='hidden' name='edit_id' value="{{$editData->id}}">
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection