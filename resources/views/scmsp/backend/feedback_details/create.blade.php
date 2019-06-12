@extends('scmsp.backend.layout.app')
@section('title', 'Create Feedback Details')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class='row'>
        <div class='col-md-12'>
            <h2>Create Feedback Details</h2>
            @include('scmsp.backend.partial.operation_message')
            <form method="POST" action="{{ route('admin.feedback-details-store') }}">
                @csrf
                <div class="form-group">
                    <label for="complain">Complain</label>
                    <select class="form-control" name="complain_id">
                        <option value="">Select Complain</option>
                        <?php
                            $complain_id    =   Session::get('complain_id');
                            $list = get_table_data_by_table('complain_details');
                            if(!$list->isEmpty()){
                                foreach($list as $data){ ?>
                        <option value="{{ $data->id }}" <?php if(isset($dept_id) && $dept_id==$data->id){ echo 'selected'; } ?>> {{ $data->complain_details }} </option>   
                        <?php }} ?>
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Engineer Feedback">Engineer feedback</label>
                            <textarea class="form-control" name="eng_feedback" rows="5" id="comment"></textarea>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="Customer Feedback">Customer feedback</label>
                            <textarea class="form-control" name="customer_feedback" rows="5" id="comment"></textarea>
                          </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection