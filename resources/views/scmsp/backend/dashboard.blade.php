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

                        <div class="row">

                            <div class="col-md-2 col-lg-2">
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
                            <div class="col-md-2 col-lg-2">
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
                            <div class="col-md-2 col-lg-2">
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