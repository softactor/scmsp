@extends('scmsp.backend.layout.app')
@section('title', 'Create User Role')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">User Role Create</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create User Role</h2>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.user-role-store') }}">
                @csrf
                <div class="form-group">
                    <label for="pwd">User</label>
                    <select class="form-control" name="user_id">
                        <option value="">Select User</option>
                        <?php
                            $user_id    =   Session::get('user_id');
                            $list = get_table_data_by_table('users');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($user_id) && $user_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Role</label>
                    <select class="form-control" name="role_id">
                        <option value="">Select Role</option>
                        <?php
                            $role_id    =   Session::get('role_id');
                            $list = get_table_data_by_table('roles');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($role_id) && $role_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection