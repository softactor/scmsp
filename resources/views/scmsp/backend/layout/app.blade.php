<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('scmsp/icon/cms_200x200.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name')}}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('theme/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('theme/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('theme/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('theme/backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('theme/backend/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('theme/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('theme/backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('theme/backend/plugins/summernote/summernote-bs4.min.css') }}">

    <link href="{{ asset('scmsp/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom Css  -->
    <link rel="stylesheet" href="{{ asset('theme/backend/dist/css/custom.css') }}">

    <link href="{{ asset('scmsp/css/custom.css') }}" rel="stylesheet" />

    <link href="{{ asset('scmsp/css/custom_table_style.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    @include('scmsp.backend.layout.top_menu')
    <!-- Sidebar -->
    @include('scmsp.backend.layout.left_menu')

    <div class="content-wrapper">

            @yield('content')

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © SPL <?php echo date('Y'); ?></span>
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
                    <a class="btn btn-primary" href="{{ url('/logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    @section('footer_js_scrip_area')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('scmsp/js/site_url.js') }}"></script>
    <script src="{{ asset('scmsp/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('scmsp/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('scmsp/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('scmsp/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('scmsp/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('scmsp/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    
    <script src="{{ asset('scmsp/js/jquery-ui.js') }}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{ asset('scmsp/js/sweetalert.min.js') }}"></script>
    
    <script src="{{ asset('theme/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('theme/backend/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('scmsp/js/site_custome.js') }}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{ asset('scmsp/js/demo/datatables-demo.js') }}"></script>
    <script>
    $(function() {
        $("#complainStartDatepicker").datepicker();
        $("#complainEndDatepicker").datepicker();
    });
    </script>
    @show
    
    
</body>

</html>