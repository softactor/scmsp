@extends('scmsp.backend.layout.app')
@section('title', 'Create Department')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Department Create</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create Department</h2>
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="email">Department Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Department Name" name="name">
                </div>
                
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection