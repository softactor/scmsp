<?php
if(!$district->isEmpty()){
    echo "<option value=''>Select</option>";
    foreach($district as $cat){ ?>
        <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
}