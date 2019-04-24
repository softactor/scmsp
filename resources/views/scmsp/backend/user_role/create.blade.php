@extends('scmsp.backend.layout.app')
@section('title', 'Create User Role')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">User Role Create</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create User Role</h2>
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="pwd">User</label>
                    <select class="form-control" name="">
                        <option>Select User</option>
                        <option>Tiger Nixon</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Role</label>
                    <select class="form-control" name="">
                        <option>Select User Role</option>
                        <option>Admin</option>
                        <option>Moderator</option>
                    </select>
                </div>
                
                
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection