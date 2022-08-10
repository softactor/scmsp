@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Type')
@section('content')


<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
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
    </div>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <!-- @include('scmsp.backend.partial.dashboard_complain_search') -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $pending = 1;
                    $processing = 3;
                    $solved = 2;
                    ?>
                    <!-- Grid column -->
                    <!-- Icon Cards-->
                    <div class="row">
                        <?php

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

                        ?>
                        <div class="col-xl-4 col-sm-6 mb-4">
                            <div class="card text-white bg-danger o-hidden h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <!--<i class="fas fa-fw fa-life-ring"></i>-->
                                    </div>
                                    <div class="mr-5">
                                        <?php echo $totalPending . ' Pending'; ?>
                                    </div>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?php echo url('admin/complain-details-list/' . $pending) ?>">
                                    <span class="float-left">View Details</span>
                                    <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php
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
                        ?>
                        <div class="col-xl-4 col-sm-6 mb-4">
                            <div class="card text-white bg-primary o-hidden h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <!--<i class="fas fa-fw fa-comments"></i>-->
                                    </div>
                                    <div class="mr-5"><?php echo $totalprocessing . ' Processing'; ?></div>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?php echo url('admin/complain-details-list/' . $processing) ?>">
                                    <span class="float-left">View Details</span>
                                    <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php
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
                        <div class="col-xl-4 col-sm-6 mb-4">
                            <div class="card text-white bg-success o-hidden h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <!--<i class="fas fa-fw fa-shopping-cart"></i>-->
                                    </div>
                                    <div class="mr-5"><?php echo $totalsolved . ' Solved'; ?></div>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?php echo url('admin/complain-details-list/' . $solved) ?>">
                                    <span class="float-left">View Details</span>
                                    <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grid row -->

        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $totalPending; ?></h3>

                            <p> Pending</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo url('admin/complain-details-list/' . $pending) ?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalprocessing; ?></h3>

                            <p>Processing</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo url('admin/complain-details-list/' . $processing) ?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $totalsolved ?></h3>

                            <p>Solved</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo url('admin/complain-details-list/' . $solved) ?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


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