<?php
if (!$report_data->isEmpty()) {
    ?>

    <div class="table-responsive">          
        <table class="table table-bordered list-table-custom-style">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Division</th>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    
                </tr>
            </thead>
            <tbody>

    <?php
    $sl     =   1;
    foreach ($report_data as $data) {
        ?>

                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo get_division_name_by_id($data->division_id); ?></td>
                        <td><?php echo get_department_name_by_id($data->department_id); ?></td>
                        <td><?php echo $data->name; ?></td>
                        <td><?php echo $data->email; ?></td>
                        <td><?php echo $data->mobile; ?></td>
                        
                    </tr>


        <?php
    }
    ?>


            </tbody>
        </table>
    </div>


    <?php
}else{
?>

<div class="alert alert-warning">
    <strong>Sorry, No data found</strong>
</div>

<?php } ?>
