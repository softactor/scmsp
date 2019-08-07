<?php
if(isset($departmentdata) && !empty($departmentdata)){
    echo "<option value=''>Select</option>";
    foreach($departmentdata as $department){ ?>
        <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
}

