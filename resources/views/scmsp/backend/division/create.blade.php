@extends('scmsp.backend.layout.app')
@section('title', 'Create Devision')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Division Create</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create Division</h2>
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Division Name" name="name">
                </div>
                <div class="form-group">
                    <label for="pwd">Department</label>
                    <select class="form-control" name="">
                        <option>Select Department</option>
                        <option>Department</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection