@extends('scmsp.backend.layout.app')
@section('title', 'Create User')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.user-list') }}">Users</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create User</h2>
            @include('scmsp.backend.partial.operation_message')
            <form action="{{ route('admin.user-store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label for="psw">Password</label>
                    <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role_id">
                        <option value="">Select Role</option>
                        <?php
                            $list = get_table_data_by_table('roles');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}">{{ $data->name }}</option>   
                        <?php }} ?>                        
                    </select>
                </div>                
                <input type="submit" name="submit" value="Create" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
@endsection