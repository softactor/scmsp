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
                    <li class="breadcrumb-item active">Create Complain Status</li>
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
                        <form method="POST" action="{{ route('admin.complain-status-store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Status Name"
                                    name="name" value="{{ old('name') }}">
                                <?php if ($errors->has('name')) { ?>
                                <span class='alert-danger'><?php echo $errors->first('name'); ?></span>
                                <?php } ?>
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