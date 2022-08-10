<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('scmsp/icon/favicon_25X25.png') }}" />
        <title>CMS</title>
        <link href="{{ asset('scmsp/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
        <script src="{{ asset('scmsp/js/site_url.js') }}"></script>
        <script src="{{ asset('scmsp/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('scmsp/js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('scmsp/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body id="app-layout">
        <div class="main">
            <div class="container">                
                <center>
                    <div class="row">
                        <div class="col-md-6">
                            @include('opmessage')
                        </div>
                    </div>
                    <div class="row" style="max-width:600px;padding-right:150px;">
                        <div class="col-md-6">
                            <div class="logo">
                                <img src="{{ asset('scmsp/icon/cms_200x200.png') }}"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="login">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <fieldset class="clearfix">
                                        <p><span class="fa fa-user"></span><input value="<?php echo old('email') ?>" placeholder="E-mail Address" name="email" type="text" id="email" required></p>
                                        <p><span class="fa fa-lock"></span><input placeholder="Password" name="password" type="password" id="password" required></p>
                                        <div>
                                            <span style="width:100%; text-align:right;  display: inline-block;">
                                                <input style="width: 100%" type="submit" value="Login"></span>
                                        </div>
                                    </fieldset>
                                    <div class="clearfix"></div>
                                </form>
                                <div class="clearfix"></div>
                            </div> <!-- end login -->
                        </div>
                    </div>
                    <div class="middle">
                        
                        
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>