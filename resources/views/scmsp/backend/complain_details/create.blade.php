@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create Complain Details</h2>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.complain-details-store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Department</label>
                            <select class="form-control" name="dept_id">
                                <option>Select Type</option>
                                <?php
                                $dept_id    =   Session::get('dept_id');
                                $list = get_table_data_by_table('departments');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->id }}"<?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Division</label>
                            <select class="form-control" name="div_id">
                                <option>Select Type</option>
                                <?php
                                $div_id    =   Session::get('div_id');
                                $list = get_table_data_by_table('divisions');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->id }}"<?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Complain Type</label>
                            <select class="form-control" name="complain_type_id">
                                <option>Select Type</option>
                                <?php
                                $complain_type_id    =   Session::get('complain_type_id');
                                $list = get_table_data_by_table('complain_types');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->id }}"<?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="complainer">Complainer</label>
                            <input type="text" class="form-control" name="complainer" placeholder="Enter Complainer Phone" id='search_text' onkeyup="autosearch()">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="complainer">Issue Date</label>
                            <input type="date" class="form-control" name="issued_date" id="demoDatepicker" placeholder="Enter Complainer Phone" autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Complain Status</label>
                            <select class="form-control" name="complain_status">
                                <?php
                                $id    =   Session::get('id');
                                $list = get_table_data_by_table('complain_statuses');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->id }}"<?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Assign To</label>
                            <select class="form-control" name="assign_to">
                                <?php
                                $id    =   Session::get('id');
                                $list = get_table_data_by_table('roles');
                                if(!$list->isEmpty()){
                                    foreach($list as $data){ ?>
                                <option value="{{ $data->name }}"<?php if(isset($id) && $id==$data->id){ echo 'selected'; } ?>>{{ $data->name }}</option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <label for="complain details">Complain Details</label>
                    <textarea class="form-control" id="details" name="complain_details"></textarea>
                </div>
                
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

