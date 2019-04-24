@extends('scmsp.backend.layout.app')
@section('title', 'Edit Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Complain Details</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
           <h2>List Complain Details<button type="button" class="btn btn-outline-primary" style="float:right" onclick="window.location.href='{{ route('admin.complain-details-create') }}'" >Create New</button></h2>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Complain Type</th>
                            <th>complainer</th>
                            <th>Details</th>
                            <th>Issue date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User</th>
                            <th>Complain Type</th>
                            <th>complainer</th>
                            <th>Details</th>
                            <th>Issue date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Type</td>
                            <td>complainer</td>
                            <td>Details</td>
                            <td>Issue Date</td>
                            <td>Status</td>
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