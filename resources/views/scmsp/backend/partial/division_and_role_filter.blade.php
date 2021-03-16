    <div class="form-group">
        <label for="sel1">Division:</label>
        <select class="form-control" id="division_id" name="division_id">
            <option value="">Please Select</option>
            <?php
                $division   =   get_all_division();
                foreach($division as $row){
            ?>
            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="sel1">&nbsp;Role:</label>
        <select class="form-control" id="role_id" name="role_id">
            <option value="">Please Select</option>
            <?php
                $division   =   get_all_role();
                foreach($division as $row){
            ?>
            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
            <?php } ?>
        </select>
    </div>  