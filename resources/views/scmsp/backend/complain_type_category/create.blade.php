@extends('scmsp.backend.layout.app')
@section('title', 'Create Department')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Complain Type Category</a>
        </li>
        <li class="breadcrumb-item active">Create Complain Type Category</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.complain-type-category-store') }}">
                @csrf
                <div class="form-group">
                    <label for="pwd">Division</label>
                    <?php
                        $get_department_by_division_url = url('admin/get_department_by_division');
                    ?>
                    <select class="form-control" name="dept_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                        <option value="">Select</option>
                        <?php
                            $dept_id    =   Session::get('dept_id');
                            $list = get_table_data_by_table('departments');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>                        
                    </select>
                    <?php if ($errors->has('dept_id')) { ?>
                        <span class='alert-danger'><?php echo $errors->first('dept_id'); ?></span>
<?php } ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Department</label>
                    <select class="form-control" id="dept_id" name="div_id">
                        <option value="">Select</option>
                        <?php
                            $div_id    =   Session::get('div_id');
                            $list = get_table_data_by_table('divisions');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>                        
                    </select>
                    <?php if ($errors->has('div_id')) { ?>
                        <span class='alert-danger'><?php echo $errors->first('div_id'); ?></span>
<?php } ?>
                </div>
                <div class="form-group">
                    <label for="email">Category Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name" value="{{ old('name') }}">
                    <?php if ($errors->has('name')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('name'); ?></span>
                    <?php } ?>
                </div>
                
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection