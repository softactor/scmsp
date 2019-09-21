@extends('scmsp.backend.layout.app')
@section('title', 'Complain Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Settings</a>
        </li>
        <li class="breadcrumb-item active">SMS Status</li>
    </ol>
    <div class='row'>
        <div class='col col-md-12'>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.sms-status-set-update') }}">
                @csrf
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" name="send_sms" value="1" <?php if(isset($send_sms_value) && $send_sms_value==1) { echo 'checked'; } ?>>Enable
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" name="send_sms" value="0" <?php if(isset($send_sms_value) && $send_sms_value==0) { echo 'checked'; } ?>>Disable
                    </label>
                </div>
                <input type="submit" name="sms_status" class="btn btn-primary" value="Save">
            </form>
        </div>
    </div>
</div>
@endsection