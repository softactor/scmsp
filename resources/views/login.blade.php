<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('scmsp/icon/favicon_25X25.png') }}" />
    <title>Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="{{ asset('theme/backend/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        id="bootstrap-css">
    <!-- icheck-bootstrap -->
    <link href="{{ asset('theme/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet"
        id="bootstrap-css">
    <!-- theme style  -->
    <link href="{{ asset('theme/backend/dist/css/adminlte.min.css') }}" rel="stylesheet" id="bootstrap-css">

    <script src="{{ asset('scmsp/js/site_url.js') }}"></script>
    <script src="{{ asset('scmsp/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('scmsp/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('scmsp/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body id="app-layout">
    <div class="main-body vh-100 d-flex align-items-center justify-content-center">
        <div class="login-box">
            <center>
                <div class="row">
                    <!-- <div class="col-md-6">
                        @include('opmessage')
                    </div> -->
                </div>
                <div class="login-logo">
                    <img src="{{ asset('scmsp/icon/cms_200x200.png') }}">
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="<?php echo old('email') ?>"
                                    placeholder="E-mail Address" name="email" type="text" id="email" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" placeholder="Password" name="password" type="password"
                                    id="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div> -->
                            </div>
                            <!-- /.col -->
                            <div class="my-3">
                                <input type="submit" value="Login" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </center>
        </div>
    </div>
</body>

</html>