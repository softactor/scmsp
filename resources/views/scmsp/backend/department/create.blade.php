@extends('scmsp.backend.layout.app')
@section('title', 'Create Department')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Create Department</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <form method="POST" action="{{ route('admin.department-store') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Department Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Department Name" name="name" value="{{ old('name') }}">
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