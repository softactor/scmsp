@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Type')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">


        <?php
        $pending = 1;
        $processing = 3;
        $solved = 2;


        $countParam = [];
        $countParam['table'] = 'complain_details';
        $countParam['field'] = 'id';
        $countParam['where']['complain_status'] = $pending;
        $role = getRoleNameByUserId(Auth::user()->id);
        if ($role == 'Service Staff') {
            $countParam['where']['assign_to'] = Auth::user()->id;
            $totalPending = getTableTotalRows($countParam)->total;
        } else if ($role == 'Area Manager') {
            $list = get_complain_details_by_area_manager(Auth::user()->id, $pending);
            $totalPending = count($list);
        } else if ($role == 'Zonal Manager') {
            $list = get_complain_details_by_zonal_manager(Auth::user()->id, $pending);
            $totalPending = count($list);
        } else {
            $totalPending = getTableTotalRows($countParam)->total;
        }

        $countParam = [];
        $countParam['table'] = 'complain_details';
        $countParam['field'] = 'id';
        $countParam['where']['complain_status'] = $processing;
        $role = getRoleNameByUserId(Auth::user()->id);
        if ($role == 'Service Staff') {
            $countParam['where']['assign_to'] = Auth::user()->id;
            $totalprocessing = getTableTotalRows($countParam)->total;
        } else if ($role == 'Area Manager') {
            $list = get_complain_details_by_area_manager(Auth::user()->id, $processing);
            $totalprocessing = count($list);
        } else if ($role == 'Zonal Manager') {
            $list = get_complain_details_by_zonal_manager(Auth::user()->id, $processing);
            $totalprocessing = count($list);
        } else {
            $totalprocessing = getTableTotalRows($countParam)->total;
        }

        $countParam = [];
        $countParam['table'] = 'complain_details';
        $countParam['field'] = 'id';
        $countParam['where']['complain_status'] = $solved;
        $role = getRoleNameByUserId(Auth::user()->id);
        if ($role == 'Service Staff') {
            $countParam['where']['assign_to'] = Auth::user()->id;
            $totalsolved = getTableTotalRows($countParam)->total;
        } else if ($role == 'Area Manager') {
            $list = get_complain_details_by_area_manager(Auth::user()->id, $solved);
            $totalsolved = count($list);
        } else if ($role == 'Zonal Manager') {
            $list = get_complain_details_by_zonal_manager(Auth::user()->id, $solved);
            $totalsolved = count($list);
        } else {
            $totalsolved = getTableTotalRows($countParam)->total;
        }
        ?>


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-center">

                            <div class="col-md-2 col-lg-2">
                                <!-- small box -->
                                <a href="<?php echo url('admin/complain-details-list/' . $pending) ?>">
                                    <div class="small-box bg-info rounded-circle text-center d-flex justify-content-center align-items-center"
                                        style="height: 160px;">
                                        <div class="inner">
                                            <h2 style="font-size: 3.2rem;"><?php echo $totalPending; ?></h2>

                                            <p> Pending</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <!-- small box -->
                                <a href="<?php echo url('admin/complain-details-list/' . $processing) ?>">
                                    <div class="small-box bg-success text-center rounded-circle d-flex justify-content-center align-items-center"
                                        style="height: 160px;">
                                        <div class="inner">
                                            <h2 style="font-size: 3.2rem;"><?php echo $totalprocessing; ?></h2>

                                            <p>Processing</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <!-- small box -->
                                <a href="<?php echo url('admin/complain-details-list/' . $solved) ?>" class="">
                                    <div class="small-box bg-warning text-center rounded-circle d-flex justify-content-center align-items-center"
                                        style="height: 160px;">
                                        <div class="inner">
                                            <h2 style="font-size: 3.2rem;"><?php echo $totalsolved ?></h2>
                                            <p>Solved</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

@section('footer_js_scrip_area')
@parent
<script type="text/javascript">
function complain_details_auto_refresh() {
    setTimeout(function() {
        location.reload();
    }, 30000);
}
//complain_details_auto_refresh();
</script>
@endsection
@endsection