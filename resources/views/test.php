
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/saif_cms/scmsp/icon/cms_200x200.png" />
    <meta name="csrf-token" content="dxP189QyD46oDiXDdJt0qZ7vten98U7mRwMdsLbV">
    <title>Complain Management System</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="http://localhost/saif_cms/theme/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="http://localhost/saif_cms/theme/backend/plugins/summernote/summernote-bs4.min.css">
</head>

<body id="page-top">

    <!-- <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="http://localhost/saif_cms/admin/dashboard">Complain Management System</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
        <a href="http://localhost/saif_cms/admin/complain-details-create">
        <button type="button" class="btn btn-sm btn-success float-right margin-fixing">New Complain</button>
    </a>
        <a href="http://localhost/saif_cms/admin/query-details-create">
        <button style="margin-left: 2px;" type="button" class="btn btn-sm btn-warning float-right margin-fixing">New
            Query</button>
    </a>
        <ul class="navbar-nav ml-auto ml-md-12">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="http://localhost/saif_cms/admin/user-profile">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://localhost/saif_cms/logout">Logout</a>
            </div>
        </li>
    </ul>
</nav> -->


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
</nav>    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/saif_cms/admin/dashboard" class="brand-link">
        <img src="http://localhost/saif_cms/theme/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://avatars.githubusercontent.com/u/4972599?v=4" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Tanveer Qureshee</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/dashboard" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/department-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/division-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Division</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/complain-type-category-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complain Cat.</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/complain-type-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complain Sub Cat.</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/complain-status-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complain Status</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/sms-status-set" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Status</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/address_upazila" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Address Upazila</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/address_union" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Address Union</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/role-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/user-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/saif_cms/admin/permission-create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/complain-details-list" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            Complain Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/query-details-list" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Query Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/report-list" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            Report Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/staff-location" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Staff Location
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/manual-complain-list" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Manual Query Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/saif_cms/admin/common-sms-view" class="nav-link">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            Common SMS
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

    <div class="content-wrapper">

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


        

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="card">
                    <div class="card-body">

                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>75</h3>

                                <p> Pending</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="http://localhost/saif_cms/admin/complain-details-list/1" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>21</h3>

                                <p>Processing</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="http://localhost/saif_cms/admin/complain-details-list/3" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>21</h3>

                                <p>Processing</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="http://localhost/saif_cms/admin/complain-details-list/3" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</section>


        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © SPL 2022</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="http://localhost/saif_cms/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
        <!-- Bootstrap core JavaScript-->
    <script src="http://localhost/saif_cms/scmsp/js/site_url.js"></script>
    <script src="http://localhost/saif_cms/scmsp/vendor/jquery/jquery.min.js"></script>
    <script src="http://localhost/saif_cms/scmsp/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="http://localhost/saif_cms/scmsp/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="http://localhost/saif_cms/scmsp/vendor/chart.js/Chart.min.js"></script>
    <script src="http://localhost/saif_cms/scmsp/vendor/datatables/jquery.dataTables.js"></script>
    <script src="http://localhost/saif_cms/scmsp/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="http://localhost/saif_cms/scmsp/js/jquery-ui.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="http://localhost/saif_cms/scmsp/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="http://localhost/saif_cms/scmsp/js/demo/datatables-demo.js"></script>

    <!-- Demo scripts for this page-->
    <script src="http://localhost/saif_cms/scmsp/js/sweetalert.min.js"></script>
    <script src="http://localhost/saif_cms/scmsp/js/site_custome.js"></script>
    <script>
    $(function() {
        $("#complainStartDatepicker").datepicker();
        $("#complainEndDatepicker").datepicker();
    });
    </script>
    
<script type="text/javascript">
    function complain_details_auto_refresh() {
        setTimeout(function() {
            location.reload();
        }, 30000);
    }
    //complain_details_auto_refresh();
</script>

    <script src="http://localhost/saif_cms/theme/backend/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="http://localhost/saif_cms/theme/backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/moment/moment.min.js"></script>
    <script src="http://localhost/saif_cms/theme/backend/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="http://localhost/saif_cms/theme/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="http://localhost/saif_cms/theme/backend/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="http://localhost/saif_cms/theme/backend/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="http://localhost/saif_cms/theme/backend/dist/js/pages/dashboard.js"></script>
</body>

</html>