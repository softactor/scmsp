@extends('scmsp.backend.layout.app')
@section('title', 'Create Permission')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Permission</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Permission</a></li>
                    <li class="breadcrumb-item active">Create Permission</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <div class="card">
            <div class="card-body">
                <div class='row'>
                    <div class='col col-md-12'>
                        <form method="POST" action="{{ route('admin.permission-store') }}">
                            @csrf
                            <div class="form-group">
                                <?php
                        $getPermissionUrl = route('admin.get_role_wise_permission');
                        ?>
                                <label for="pwd">User Type</label>
                                <select class="form-control" name="user_type"
                                    onchange="getRoleWisePermission('<?php echo $getPermissionUrl; ?>', this.value);">
                                    <option value="">Select Type</option>
                                    <?php
                            $role_id = Session::get('role_id');
                            $list = get_table_data_by_table('roles');
                            if (!$list->isEmpty()) {
                                foreach ($list as $data) {
                                    ?>
                                    <option value="{{ $data->name }}" <?php if (isset($role_id) && $role_id == $data->id) {
                                echo 'selected';
                            } ?>> {{ $data->name }} </option>
                                    <?php }
} ?>
                                </select>
                            </div>
                            <div id='permission_access_section'>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>All Modules</h5>
                                    </div>
                                    <div class="col-md-1"> :</div>
                                    <div class="col-md-8">
                                        <h3>
                                            <input type="checkbox" name="isallpermission" id="isallpermission"
                                                class="minimal" onchange="allcheck()" value="1">
                                        </h3>
                                    </div>
                                </div>
                                <!-- checkbox -->
                                <?php
                        $modules = get_table_data_by_table('modules');
                        if (isset($modules) && !empty($modules)) {
                            foreach ($modules as $module) {
                                ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><?php echo $module->name ?></div>
                                        <div class="col-md-1"> :</div>
                                        <div class="col-md-8">
                                            <label>
                                                <input type="checkbox" name="module[<?php echo $module->id ?>][add]"
                                                    class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>"
                                                    value="1">
                                                Add
                                            </label>
                                            <label>
                                                <input type="checkbox" name="module[<?php echo $module->id ?>][edit]"
                                                    class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>"
                                                    value="1">
                                                Edit
                                            </label>
                                            <label>
                                                <input type="checkbox" name="module[<?php echo $module->id ?>][list]"
                                                    class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>"
                                                    value="1">
                                                List
                                            </label>
                                            <label>
                                                <input type="checkbox" name="module[<?php echo $module->id ?>][del]"
                                                    class="minimal module_common_class <?php echo 'module_type_' . $module->id; ?>"
                                                    value="1">
                                                Delete
                                            </label>
                                            <label>
                                                <input type="checkbox"
                                                    id="ind_module_all_selector_<?php echo $module->id; ?>"
                                                    name="module[<?php echo $module->id ?>][all]"
                                                    class="minimal module_common_class" value="1"
                                                    onclick="toggleIndividualModuleChecked('<?php echo $module->id; ?>');">
                                                All
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                        } ?>
                            </div>
                            <button type="submit" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection