@extends('scmsp.backend.layout.app')
@section('title', 'Create Permission')
@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Permission Create</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create Permission</h2>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.permission-store') }}">
                @csrf
                <div class="form-group">
                    <label for="pwd">User Type</label>
                    <select class="form-control" name="user_type">
                        <option value="">Select Type</option>
                        <?php
                            $role_id    =   Session::get('role_id');
                            $list = get_table_data_by_table('roles');
                            if(!$list->isEmpty()){
                            foreach($list as $data){ ?>
                        <option value="{{ $data->name }}" <?php if(isset($role_id) && $role_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>
                
                
                <div class="row">
                    <div class="col-md-3"><h5>All Modules</h5></div>
                    <div class="col-md-1"> :</div>
                    <div class="col-md-8"><h3>
                            <input type="checkbox" name="isallpermission" id="isallpermission" class="minimal" onchange="allcheck()" value="1" >
                        </h3></div>
                </div>
                <!-- checkbox -->
                <?php
                    $modules = get_table_data_by_table('modules');
                    if(isset($modules) && !empty($modules)){
                        foreach($modules as $module){
                    ?>
                <div class="form-group"> 
                  <div class="row">
                    <div class="col-md-3"><?php echo $module->name ?></div>
                    <div class="col-md-1"> :</div>
                    <div class="col-md-8"> 
                        <label>
                          Add 
                          <input type="checkbox" name="addaccess" class="minimal module_common_class" value="module[<?php echo $module->name ?>]['add'][<?php echo $module->id ?>]">
                        </label>
                        <label>
                          Edit 
                          <input type="checkbox" name="editaccess" class="minimal module_common_class" value="module[<?php echo $module->name ?>]['edit'][<?php echo $module->id ?>]">
                        </label>
                        <label>
                          List 
                          <input type="checkbox" name="listaccess" class="minimal module_common_class" value="module[<?php echo $module->name ?>]['list'][<?php echo $module->id ?>]">
                        </label>
                        <label>
                          Delete 
                          <input type="checkbox" name="deleteaccess" class="minimal module_common_class" value="module[<?php echo $module->name ?>]['del'][<?php echo $module->id ?>]">
                        </label>
                        <label>
                          All 
                          <input type="checkbox" name="isallmodulepermission" class="minimal module_common_class" value="module[<?php echo $module->name ?>]['all'][<?php echo $module->id ?>]">
                        </label>
                    </div>
                  </div>
                </div>
                <?php }} ?>
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection



