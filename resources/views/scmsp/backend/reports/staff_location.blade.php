@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Report Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Report</a></li>
                    <li class="breadcrumb-item active">Report Details</li>
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
        </div>
    </div>
</section>
@endsection