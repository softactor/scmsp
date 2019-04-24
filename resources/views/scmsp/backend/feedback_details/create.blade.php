@extends('scmsp.backend.layout.app')
@section('title', 'Create Feedback Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Create Feedback Details</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>Create Feedback Details</h2>
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="complain">Complain</label>
                    <select class="form-control" name="">
                        <option>Select Complain</option>
                        <option>Complain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Engineer feedback</label>
                    <input type="text" class="form-control" id="pwd" placeholder="Engineer feedback" name="pwd">
                </div>
                <div class="form-group">
                    <label for="pwd">Customer feedback</label>
                    <input type="text" class="form-control" id="pwd" placeholder="Customer feedback" name="pwd">
                </div>
                
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection