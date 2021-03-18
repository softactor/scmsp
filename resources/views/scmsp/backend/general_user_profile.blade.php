@extends('scmsp.backend.layout.app')
@section('title', 'Create User')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.user-list') }}">Users</a>
        </li>
        <li class="breadcrumb-item active">User Profile</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <!--<form action="{{ route('admin.user-update') }}" method="post">-->
            <form action="{{ route('admin.general-user-update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role"><b>Role</b></label><br>
                            <?php echo $role; ?>                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>Name</b></label><br>
                            <?php echo $usersData->name; ?>
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"><b>Email</b></label><br>
                            <?php echo $usersData->email; ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="psw">Password</label>
                            <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="psw">Mobile</label>
                            <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" value="{{ old('mobile',$usersData->mobile) }}">
                        </div>                
                    </div>                
                </div>  
                <div class="row">
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="pwd"><b>Division</b></label><br> 
                            <?php
                                $divisionData   =   get_data_name_by_id('departments', $usersData->division_id);
                                echo $divisionData->name;
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pwd"><b>Department</b></label><br>
                            <?php
                                $departmentData   =   get_data_name_by_id('divisions', $usersData->department_id);
                                echo $departmentData->name;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role"><b>Address Division</b></label><br>
                                
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role"><b>Address District</b></label><br>
                                
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role"><b>Address Upazila</b></label><br>
                                        
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role"><b>Address Union</b></label><br>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>All Location?</b></label><br>
                            <?php if(isset($is_all_location) && !empty($is_all_location)){ echo 'Yes'; }else{ echo "No";} ?>
                        </div>
                    </div>
                </div>
                <input type='hidden' name="user_update_id" value="<?php echo $usersData->id; ?>">
                <input type="submit" name="update" value="Update" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
@endsection