@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Status')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Status</a>
        </li>
        <li class="breadcrumb-item active">Create Complain Status</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.complain-status-store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Status Name" name="name" value="{{ old('name') }}">
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