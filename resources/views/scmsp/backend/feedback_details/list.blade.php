@extends('scmsp.backend.layout.app')
@section('title', 'Edit Feedback Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Feedback Details</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            <h2>List Feedback Details<button type="button" class="btn btn-outline-primary" style="float:right" onclick="window.location.href='{{ route('admin.feedback-details-create') }}'" >Create New</button></h2>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Complain</th>
                            <th>Engineer Feedback</th>
                            <th>Customer Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Complain</th>
                            <th>Engineer Feedback</th>
                            <th>Customer Feedback</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Complain</td>
                            <td>Engineer Feedback</td>
                            <td>Customer Feedback</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                      <a class="dropdown-item" href="#">Edit</a>
                                      <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection