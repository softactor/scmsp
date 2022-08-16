<div class='row'>
    <div class='col col-md-12'>
        <form action="" method="post" id="staff_location_report_search_form">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <?php
                        $get_department_by_division_url = url('admin/get_department_by_division');
                        ?>
                        <label for="pwd">Complain Division</label>
                        <select class="form-control" id='div_id' name="div_id" onchange="getDepartmentByDivision(this.value, 'dept_id', '<?php echo $get_department_by_division_url; ?>');">
                            <option value="">Select</option>
                            <?php
                            $list = get_table_data_by_table('departments');
                            if (!$list->isEmpty()) {
                                foreach ($list as $data) {
                                    ?>
                                    <option value="{{ $data->id }}"<?php
                                    if (old('div_id') == $data->id) {
                                        echo 'selected';
                                    }
                                    ?>>{{ $data->name }}
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php
                        if ($errors->has('div_id')) {
                            echo "<div class='alert alert-danger'>Division is Required</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="pwd">Department</label> 
                        <?php
                        $get_department_wise_user_url = url('admin/get_department_wise_user');
                        $get_category_by_department = url('admin/get_category_by_department');
                        ?>
                        <select class="form-control" id="dept_id" name="dept_id" onchange="getCategoryByDepartment(this.value, 'div_id', 'category_id', '<?php echo $get_category_by_department; ?>');">
                            <option value="">Select</option>
                        </select>
                        <?php
                        if ($errors->has('dept_id')) {
                            echo "<div class='alert alert-danger'>Department is Required</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="role">Address Division</label>
                        <?php $div_by_dis_url = route('admin.get_district_by_division') ?>
                        <select class="form-control" id="addr_div_id" name="addr_div_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_dis_id', '<?php echo $div_by_dis_url; ?>');">
                            <option value="">Select</option>
                            <?php
                            $list = get_table_data_by_table('addr_divisions');
                            if (!$list->isEmpty()) {
                                foreach ($list as $data) {
                                    ?>
                                    <option value="{{ $data->id }}"<?php
                                    if (old('addr_div_id') == $data->id) {
                                        echo 'selected';
                                    }
                                    ?>>{{ $data->name }}
                                    </option>
                                    <?php
                                }
                            }
                            ?>                        
                        </select>
                        <?php
                        if ($errors->has('addr_div_id')) {
                            echo "<div class='alert alert-danger'>Division is Required</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="role">Address District</label>
                        <?php $up_by_dis_url = route('admin.get_upozila_by_district') ?>
                        <select class="form-control" name="addr_dis_id" id="addr_dis_id" onchange="getAddressRelatedAjaxdata(this.value, 'addr_upazila_id', '<?php echo $up_by_dis_url; ?>');">
                            <option value="">Select</option>                       
                        </select>
                        <?php
                        if ($errors->has('addr_dis_id')) {
                            echo "<div class='alert alert-danger'>District is Required</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="role">Address Upazila</label>
                        <?php $union_by_up_url = route('admin.get_union_by_upozila') ?>
                        <select class="form-control" name="addr_upazila_id" id="addr_upazila_id">
                            <option value="">Select</option>                        
                        </select>
                        <?php
                        if ($errors->has('addr_upazila_id')) {
                            echo "<div class='alert alert-danger'>Upazila is Required</div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </form>
        <?php
        $data_url = url('admin/get-staff-location-report');
        ?>
        <button type="button" name="form_search" class="btn btn-info" onclick="getStaffLocationReport('report_show_section', '<?php echo $data_url; ?>');">Search</button>
    </div>

</div>