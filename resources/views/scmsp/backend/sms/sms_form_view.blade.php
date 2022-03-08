@extends('scmsp.backend.layout.app')
@section('title', 'Create Role')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Common SMS</a>
        </li>
        <li class="breadcrumb-item active">Create Common SMS</li>
    </ol>
    <div class='row'>
        <div class='col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form id="common_sms_form">


                <div class="box">
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="contact_number">Contact Number:</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number">
                                    
                                    <div class="text-grey-darker text-danger">Contact format: without +88 LIKE: 01716600843</div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="headerTitle">Header Title:</label>
                                    <input type="text" class="form-control" id="header_title" name="header_title" value="প্রিয় মূল্যবান গ্রাহক">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description: <span style="font-style: italic; color: red;">(Max 120 character)</span></label>
                                    <textarea class="form-control" rows="5" id="smsdescription" name="description" maxlength="120"></textarea>
                                    <div id="compteur" class="compteur"></div>
                                </div>
                                <div class="form-group">
                                    <label for="footerTitle">Footer Title:</label>
                                    <input type="text" class="form-control" id="footer_title" name="footer_title" value="সাইফ পাওয়ারটেক লিমিটেড">
                                </div>
                                
                                <?php
                                
                                    $sms_url    =   route('admin.sms_process');//
                                
                                ?>
                                <button type="button" class="btn btn-success btn-block" onclick="send_sms('common_sms_form', '<?php echo $sms_url; ?>')">SEND SMS</button>

                            </div>
                                
                            <div class="col-md-6" id="sms_sent_response">

                            </div>

                        </div>
                    </div><!-- /.box-body -->
                    
                </div><!-- /.box -->



            </form>
        </div>
    </div>
</div>
@endsection