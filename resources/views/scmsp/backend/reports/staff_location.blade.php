@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Report Details</a>
        </li>
        <li class="breadcrumb-item active">Report</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            @include('scmsp.backend.reports.users_filter')
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <span id="report_show_section"></span>
        </div>
    </div>
</div>
@endsection