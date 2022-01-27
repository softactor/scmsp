<tr id="more_address_row_<?php echo $row_id; ?>">
    <td>
        <div class="form-group">
            <?php $div_by_dis_url = route('admin.get_district_by_division') ?>
            <select class="form-control" id="addr_div_id_<?php echo $row_id; ?>" name="addr_div_id[]" onchange="getAddressRelatedAjaxdata(this.value, 'addr_dis_id_<?php echo $row_id; ?>', '<?php echo $div_by_dis_url; ?>');">
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
    </td>
    <td>
        <div class="form-group">
            <?php $up_by_dis_url = route('admin.get_upozila_by_district') ?>
            <select class="form-control" name="addr_dis_id[]" id="addr_dis_id_<?php echo $row_id; ?>" onchange="getAddressRelatedAjaxdata(this.value, 'addr_upazila_id_<?php echo $row_id; ?>', '<?php echo $up_by_dis_url; ?>');">
                <option value="">Select</option>                       
            </select>
            <?php
            if ($errors->has('addr_dis_id')) {
                echo "<div class='alert alert-danger'>District is Required</div>";
            }
            ?>
        </div>
    </td>
    <td>
        <div class="form-group">
            <?php $union_by_up_url = route('admin.get_union_by_upozila') ?>
            <select class="form-control" name="addr_upazila_id[]" id="addr_upazila_id_<?php echo $row_id; ?>" onchange="getAddressRelatedAjaxdata(this.value, 'addr_union_id_<?php echo $row_id; ?>', '<?php echo $union_by_up_url; ?>');">
                <option value="">Select</option>                        
            </select>
            <?php
            if ($errors->has('addr_upazila_id')) {
                echo "<div class='alert alert-danger'>Upazila is Required</div>";
            }
            ?>
        </div>
    </td>
    <td>
        <div class="form-group">
            <select class="form-control" name="addr_union_id[]" id="addr_union_id_<?php echo $row_id; ?>">
                <option value="">Select</option>                       
            </select>
            <?php
            if ($errors->has('addr_union_id')) {
                echo "<div class='alert alert-danger'>Union is Required</div>";
            }
            ?>
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-sm btn-danger" onclick="remove_more_address_row('<?php echo $row_id; ?>')">Remove Address</button>
    </td>
</tr>