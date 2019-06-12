<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('scmsp/icon/favicon_25X25.png') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name')}}</title>

        <!-- Custom fonts for this template-->
        <link href="{{ asset('scmsp/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('scmsp/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('scmsp/css/bootstrap.min.css') }}" rel="stylesheet" />
        <!-- Page level plugin CSS-->
        <link href="{{ asset('scmsp/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
        <!-- Sweet alert CSS-->
        <link href="{{ asset('scmsp/css/sweetalert.css') }}" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('scmsp/css/sb-admin.css') }}" rel="stylesheet">
        <link href="{{ asset('scmsp/css/custom.css') }}" rel="stylesheet" />
        <link href="{{ asset('scmsp/css/scroll.css') }}" rel="stylesheet">
    </head>
    <body id="page-top">

        @include('scmsp.backend.layout.top_menu')

        <div id="wrapper">

            <!-- Sidebar -->
            @include('scmsp.backend.layout.left_menu')

            <div id="content-wrapper">

                @yield('content')
                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Your Website 2019</span>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('scmsp/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('scmsp/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('scmsp/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Page level plugin JavaScript-->
        <script src="{{ asset('scmsp/vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('scmsp/vendor/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('scmsp/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('scmsp/js/sb-admin.min.js') }}"></script>

        <!-- Demo scripts for this page-->
        <script src="{{ asset('scmsp/js/demo/datatables-demo.js') }}"></script>
        
        <!-- Demo scripts for this page-->
        <script src="{{ asset('scmsp/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('scmsp/js/site_custome.js') }}"></script>
        
        
    </body>
</html>
