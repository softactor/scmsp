<div class="table-responsive">          
    <table class="table table-bordered">
        <tr>
            <th colspan="5">Complain History</th>
        </tr>
        <tr>
            <th>Details</th>
            <th>Assign To</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Date</th>
        </tr>
        <?php
            $complainHistory    =   $data['history'];
            foreach ($complainHistory as $complainHis) { ?>
            <tr>
                <td><?php echo $complainHis->descriptions; ?></td>
                <td><?php echo (isset($complainHis->assign_to) && !empty($complainHis->assign_to) ? get_data_name_by_id('users', $complainHis->assign_to)->name : ''); ?></td>
                <td><?php echo (isset($complainHis->created_by) && !empty($complainHis->created_by) ? get_data_name_by_id('users', $complainHis->created_by)->name : ''); ?></td>
                <td><?php echo (isset($complainHis->updated_by) && !empty($complainHis->updated_by) ? get_data_name_by_id('users', $complainHis->updated_by)->name : ''); ?></td>
                <td><?php echo (isset($complainHis->created_by) && !empty($complainHis->created_by) ? human_format_date($complainHis->created_at) : human_format_date($complainHis->updated_at)); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>