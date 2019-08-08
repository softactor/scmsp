@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Type')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Type</a>
        </li>
        <li class="breadcrumb-item active">Complain Type Edit</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <?php
            $sessionEditData   =   Session::get('editData');
            if(isset($sessionEditData) && !empty($sessionEditData)){
                $editData   =   $sessionEditData; 
            }
            ?>
            <form method="POST" action="{{ route('admin.complain-type-update') }}">
                @csrf
                <div class="form-group">
                    <label for="pwd">Division</label>
                    <select class="form-control" name="dept_id">
                        <option value="">Select Department</option>
                        <?php
                            $list = get_table_data_by_table('departments');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if((isset($_POST['dept_id']) && $_POST['dept_id']==$data->id) || isset($editData->dept_id) && $editData->dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>                        
                    </select>
                    <?php if ($errors->has('dept_id')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('dept_id'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Department</label>
                    <select class="form-control" name="div_id">
                        <option value="">Select Division</option>
                        <?php
                            $list = get_table_data_by_table('divisions');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if((isset($_POST['div_id']) && $_POST['div_id']==$data->id) || isset($editData->div_id) && $editData->div_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>                        
                    </select>
                    <?php if ($errors->has('div_id')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('div_id'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">Select</option>
                        <?php
                            $list = get_table_data_by_table('complain_type_categories');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if((isset($_POST['category_id']) && $_POST['category_id']==$data->id) || isset($editData->category_id) && $editData->category_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Complain Type" name="name" value="{{ old('name',$editData->name) }}">
                    <?php if ($errors->has('name')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('name'); ?></span>
                    <?php } ?>
                </div>                
                <input type='hidden' name='edit_id' value="{{$editData->id}}">
                <button type="submit" class="btn btn-info">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection