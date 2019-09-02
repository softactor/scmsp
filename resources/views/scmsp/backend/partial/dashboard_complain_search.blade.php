<form action="" method="post" id="complain_search_form">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="start_date">Start date:</label>
                    <input autocomplete="off" type="text" class="form-control" id="complainStartDatepicker"  name="start_date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="end_date">End date:</label>
                    <input autocomplete="off" type="text" class="form-control" id="complainEndDatepicker"  name="start_date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pwd">Division</label>
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
                                ?>>{{ $data->name }}</option>
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
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pwd">Department</label> 
                    <?php
                    $get_department_wise_user_url = url('admin/get_department_wise_user');
                    $get_category_by_department = url('admin/get_category_by_department');
                    ?>
                    <select class="form-control" id="dept_id" name="dept_id" onchange="getusersByDepartment(this.value, 'assign_to', '<?php echo $get_department_wise_user_url; ?>');getCategoryByDepartment(this.value, 'div_id', 'category_id', '<?php echo $get_category_by_department; ?>');">
                        <option value="">Select</option>
                    </select>
                    <?php
                    if ($errors->has('dept_id')) {
                        echo "<div class='alert alert-danger'>Department is Required</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pwd">Assign To</label>
                    <select class="form-control" name="assign_to" id="assign_to">
                        <option value="">Select</option>
                    </select>
                    <?php
                    if ($errors->has('assign_to')) {
                        echo "<div class='alert alert-danger'>Technician is Required</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pwd">Priority</label>
                    <select class="form-control" id='priority_id' name="priority_id">
                        <option value="">Select</option>
                        <?php
                        $list = get_table_data_by_table('complain_priorites');
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
                    if ($errors->has('priority_id')) {
                        echo "<div class='alert alert-danger'>Priority is Required</div>";
                    }
                    ?>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </div>
    </div>
</form>