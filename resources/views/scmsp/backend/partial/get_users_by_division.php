<?php
if(isset($user_datas) && !empty($user_datas)){
    echo "<option value=''>Select</option>";
    foreach($user_datas as $users){ ?>
        <option value="<?php echo $users->id; ?>"><?php echo $users->name." (".$users->email.")"; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
}

