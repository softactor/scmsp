@extends('scmsp.backend.layout.app')
@section('title', 'Edit User Role')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">User Role</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Edit User Role</h2>
            @include('scmsp.backend.partial.operation_message')
            <?php
            $sessionEditData   =   Session::get('editData');
            if(isset($sessionEditData) && !empty($sessionEditData)){
                $editData   =   $sessionEditData; 
            }
            ?>
            <form method="POST" action="{{ route('admin.user-role-update') }}">
                @csrf
                <div class="form-group">
                    <label for="pwd">User</label>
                    <select class="form-control" name="user_id">
                        <option value="">Select User</option>
                        <?php
                            $list = get_table_data_by_table('users');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if((isset($_POST['user_id']) && $_POST['user_id']==$data->id) || isset($editData->user_id) && $editData->user_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>                        
                    </select>
                    <?php if ($errors->has('user_id')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('user_id'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Role</label>
                    <select class="form-control" name="role_id">
                        <option value="">Select Role</option>
                        <?php
                            $list = get_table_data_by_table('roles');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if((isset($_POST['role_id']) && $_POST['role_id']==$data->id) || isset($editData->role_id) && $editData->role_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>                        
                    </select>
                    <?php if ($errors->has('role_id')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('role_id'); ?></span>
                    <?php } ?>
                </div>
                
                <input type='hidden' name='edit_id' value="{{$editData->id}}">
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection