@extends('scmsp.backend.layout.app')
@section('title', 'Create Devision')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Create Division</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>

            <h2>Create Division</h2>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.division-update') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Division Name" name="name" value="{{ old('name',$editData->name) }}">

                    <?php if ($errors->has('name')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('name'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Department</label>
                    <select class="form-control" name="dept_id">
                        <option value="">Select Department</option>
                        <?php
                            $dept_id    =   Session::get('dept_id');

                            $dept_id    =   $editData->dept_id;

                            $list = get_table_data_by_table('departments');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>

                <input type='hidden' name='edit_id' value="{{$editData->id}}">
                <button type="submit" class="btn btn-info">Update</button>

            </form>
        </div>
    </div>
</div>
@endsection