<?php
if(!$usersData->isEmpty()){
    echo "<option value=''>Select</option>";
    foreach($usersData as $users){ ?>
        <option value="<?php echo $users->id; ?>"><?php echo $users->name." (".$users->email.")"; ?></option>
    <?php }
}else{
    echo "<option value=''>Select</option>";
}

