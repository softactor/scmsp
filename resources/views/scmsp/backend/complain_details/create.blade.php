@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Create Complain Details</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create Complain Details</h2>
            <form action="/action_page.php">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user">User [Hidden]</label>
                            <input type="text" class="form-control" id="user" placeholder="Enter User" name="user">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pwd">Complain Type</label>
                            <select class="form-control" name="">
                                <option>Select Type</option>
                                <option>Complain Type</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="complainer">Complainer</label>
                            <input type="text" class="form-control" id="complainer" placeholder="Enter Complainer Phone">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="complainer">Issue Date</label>
                            <input type="text" class="form-control" id="complainer" placeholder="Enter Complainer Phone">
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <label for="complain details">Complain Details</label>
                    <textarea class="form-control" id="details" name="complainer"></textarea>
                </div>
                
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection