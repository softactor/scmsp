    <div class="form-group">
        <label for="sel1">Division:</label>
        <?php
            $divisions           = get_address_division();
            $getDisByDivUrl      =   url('admin/get_address_district_by_division');
        ?>
        <select class="form-control ml-2" name="division_id" onchange="getAddressDistrictByDivision(this.value,'district_id','<?php echo $getDisByDivUrl; ?>');">
            <option value="">Select Division</option>
            <?php
            if (!$divisions->isEmpty()) {
                foreach ($divisions as $data) {
                    ?>
                    <option value="{{ $data->id }}">
                        {{ $data->name }}
                    </option>
                <?php 
                } // foreach
            }
            ?>                        
        </select>
        <?php
        if ($errors->has('division_id')) {
            echo "<div class='alert alert-danger'>Division is Required</div>";
        }
        ?>
    </div>
    <div class="form-group">
        <label for="sel1">&nbsp;District:</label>
        <?php
            $getDisByDivUrl      =   url('admin/get_address_upazila_by_district');
        ?>
        <select class="form-control ml-2" name="district_id" id="district_id" onchange="getAddressUpazialByDistrict(this.value,'upazila_id','<?php echo $getDisByDivUrl; ?>');">
            <option value="">Select District</option>                        
        </select>
        <?php
        if ($errors->has('district_id')) {
            echo "<div class='alert alert-danger'>District is Required</div>";
        }
        ?>
    </div>  
    <div class="form-group">
        <label for="sel1">&nbsp;Upazila:</label>
        <select class="form-control ml-2" name="upazila_id" id="upazila_id">
            <option value="">Select Upazila</option>                        
        </select>
        <?php
        if ($errors->has('upazila_id')) {
            echo "<div class='alert alert-danger'>Upazila is Required</div>";
        }
        ?>
    </div>  