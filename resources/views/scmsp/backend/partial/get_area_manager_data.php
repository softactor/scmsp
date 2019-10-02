<?php
if(isset($areaManagerdata) && !empty($areaManagerdata)){
    echo "<option value=''>Select</option>";
    foreach($areaManagerdata as $manager){ ?>
        <option value="<?php echo $manager->user_id; ?>"><?php echo $manager->user_name; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
}

