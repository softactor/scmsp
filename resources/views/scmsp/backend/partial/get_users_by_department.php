<?php
if(!$usersData->isEmpty()){
    echo "<option value=''>Select</option>";
    foreach($usersData as $users){ ?>
        <option value="<?php echo $users->user_id; ?>"><?php echo $users->user_name." (".$users->email.")"; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
}

