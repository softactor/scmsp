@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Status')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Complain Status</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Complain Status</a></li>
                    <li class="breadcrumb-item active">Edit Complain Status</li>
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
                        <?php
                        $sessionEditData   =   Session::get('editData');
                        if (isset($sessionEditData) && !empty($sessionEditData)) {
                            $editData   =   $sessionEditData;
                        }
                        ?>
                        <form method="POST" action="{{ route('admin.complain-status-update') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Status Name"
                                    name="name" value="{{ old('name',$editData->name) }}">
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
        </div>
    </div>
</section>
@endsection