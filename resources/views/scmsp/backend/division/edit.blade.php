@extends('scmsp.backend.layout.app')
@section('title', 'Create Devision')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Department</a>
        </li>
        <li class="breadcrumb-item active">Edit Department</li>
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
            <form method="POST" action="{{ route('admin.division-update') }}">
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Division Name" name="name" value="{{ old('name',$editData->name) }}">

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