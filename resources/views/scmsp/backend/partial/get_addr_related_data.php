<?php
if(isset($districtdata) && !empty($districtdata)){
    echo "<option value=''>Select</option>";
    echo "<option value='new'>New</option>";
    foreach($districtdata as $district){ ?>
        <option value="<?php echo $district->id; ?>"><?php echo $district->name; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
    echo "<option value='new'>New</option>";
}

