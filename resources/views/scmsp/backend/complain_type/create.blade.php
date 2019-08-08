@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Type')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Type</a>
        </li>
        <li class="breadcrumb-item active">Complain Type Create</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.complain-type-store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Complain Type" name="name" value="{{ old('name') }}">
                    <?php if ($errors->has('name')) { ?>
                    <span class='alert-danger'><?php echo $errors->first('name'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Division</label>
                    <select class="form-control" name="dept_id">
                        <option value="">Select Department</option>
                        <?php
                            $dept_id    =   Session::get('dept_id');
                            $list = get_table_data_by_table('departments');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Department</label>
                    <select class="form-control" name="div_id">
                        <option value="">Select Division</option>
                        <?php
                            $div_id    =   Session::get('div_id');
                            $list = get_table_data_by_table('divisions');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
                        <?php }} ?>
                        
                    </select>
                </div>
                
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection