@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Type')
@section('content')


<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">

    </div>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <form action="/action_page.php">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date">Start date:</label>
                                    <input autocomplete="off" type="text" class="form-control" id="complainDatepicker"  name="start_date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date">End date:</label>
                                    <input autocomplete="off" type="text" class="form-control" id="start_date"  name="start_date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pwd">Division:</label>
                                    <select class="form-control" name="dept_id">
                                        <option>Select Type</option>
                                        <?php
                                        $dept_id = Session::get('dept_id');
                                        $list = get_table_data_by_table('departments');
                                        if (!$list->isEmpty()) {
                                            foreach ($list as $data) {
                                                ?>
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pwd">Department:</label>
                                    <select class="form-control" name="div_id">
                                        <option>Select Type</option>
                                        <?php
                                        $list = get_table_data_by_table('divisions');
                                        if (!$list->isEmpty()) {
                                            foreach ($list as $data) {
                                                ?>
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <?php 
                    $pending        =   1;
                    $processing     =   3;
                    $solved         =   2;
                ?>
                <!-- Grid column -->
                <div class="col-md-12">                    
                    <!-- Icon Cards-->
                    <div class="row">
                        <?php
                            $countParam                                 =   [];
                            $countParam['table']                        =   'complain_details';
                            $countParam['field']                        =   'id';
                            $countParam['where']['complain_status']     =   $pending;
                            $role                                       =   getRoleNameByUserId(Auth::user()->id);
                            if($role    ==  'Technician'){
                                $countParam['where']['assign_to']           =   Auth::user()->id;
                            }
                            $totalPending                               =   getTableTotalRows($countParam)->total;
                        ?>                        
                            <div class="col-xl-3 col-sm-6 mb-3">
                                <div class="card text-white bg-danger o-hidden h-100">
                                    <div class="card-body">
                                        <div class="card-body-icon">
                                            <i class="fas fa-fw fa-life-ring"></i>
                                        </div>
                                        <div class="mr-5">
                                            <?php echo $totalPending.' Pending'; ?>
                                        </div>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1" href="<?php echo url('admin/complain-details-list/'.$pending) ?>">
                                        <span class="float-left">View Details</span>
                                        <span class="float-right">
                                            <i class="fas fa-angle-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php
                            $countParam                                 =   [];
                            $countParam['table']                        =   'complain_details';
                            $countParam['field']                        =   'id';
                            $countParam['where']['complain_status']     =   $processing;
                            $role                                       =   getRoleNameByUserId(Auth::user()->id);
                            if($role    ==  'Technician'){
                                $countParam['where']['assign_to']           =   Auth::user()->id;
                            }
                            $totalprocessing                              =   getTableTotalRows($countParam)->total;
                        ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="card text-white bg-primary o-hidden h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-fw fa-comments"></i>
                                    </div>
                                    <div class="mr-5"><?php echo $totalprocessing.' Processing'; ?></div>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?php echo url('admin/complain-details-list/'.$processing) ?>">
                                    <span class="float-left">View Details</span>
                                    <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php
                            $countParam                                 =   [];
                            $countParam['table']                        =   'complain_details';
                            $countParam['field']                        =   'id';
                            $countParam['where']['complain_status']     =   $solved;
                            $role                                       =   getRoleNameByUserId(Auth::user()->id);
                            if($role    ==  'Technician'){
                                $countParam['where']['assign_to']           =   Auth::user()->id;
                            }
                            $totalsolved                               =   getTableTotalRows($countParam)->total;
                        ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="card text-white bg-success o-hidden h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-fw fa-shopping-cart"></i>
                                    </div>
                                    <div class="mr-5"><?php echo $totalsolved.' Solved'; ?></div>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?php echo url('admin/complain-details-list/'.$solved) ?>">
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

</div>
<!-- /.container-fluid -->
@endsection