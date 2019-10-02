@extends('scmsp.backend.layout.app')
@section('title', 'Create Devision')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Department</a>
        </li>
        <li class="breadcrumb-item active">Create Department</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.division-store') }}">
                @csrf
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="pwd">Division</label>
							<select class="form-control" name="dept_id">
								<option value="">Select</option>
								<?php
									$dept_id    =   Session::get('dept_id');
									$list = get_table_data_by_table('departments');
									if(!$list->isEmpty()){
										foreach($list as $data){ ?>
								<option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->name }} </option>   
								<?php }} ?>
								
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" placeholder="Enter Department Name" name="name" value="{{ old('name') }}">
							<?php if ($errors->has('name')) { ?>
							<span class='alert-danger'><?php echo $errors->first('name'); ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<button type="submit" class="form-controlbtn btn-info">Create</button>
						</div>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>
@endsection