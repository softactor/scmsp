<table>
    <thead>
        <tr>
            <th style="text-align: center;">Code</th>
            <th style="text-align: center;">Priority</th>
            <th style="text-align: center;">Complain date</th>
            <th style="text-align: center;">Complain raw date</th>
            <th style="text-align: center;">complainer</th>
            <th style="text-align: center;">Complain Type</th>
            <th style="text-align: center;">Status</th>
            <th style="text-align: center;">In-Charge</th>
            <th style="text-align: center;">Created By</th>
        </tr>
    </thead>
    <tbody id="complain_details">
        <?php
        if (!$report_data->isEmpty()) {
            foreach ($report_data as $data) {
                ?>
                <tr>
                    <td>
                        <?php echo $data->complainer_code; ?>
                    </td>
                    <td>
                        <?php
                        $res = get_data_name_by_id('complain_priorites', $data->priority_id);
                        echo (isset($res) && !empty($res) ? $res->name : 'No data found');
                        ?>
                    </td>
                    <td><?php echo human_format_date($data->created_at); ?></td>
                    <td><?php echo $data->created_at; ?></td>
                    <td>{{ $data->complainer }}</td>                            
                    <td>
                        <?php
                        $res = get_data_name_by_id('complain_types', $data->complain_type_id);
                        echo (isset($res) && !empty($res) ? short_str($res->name) : 'No data found');
                        ?>
                    </td>                            
                    <td>
                        <?php
                            $res = get_data_name_by_id('complain_statuses', $data->complain_status);
                            echo (isset($res) && !empty($res) ? $res->name : 'No data found');
                            ?>
                    </td>
                    <td>{{ (isset($data->assign_to) && !empty($data->assign_to) ? get_data_name_by_id('users',$data->assign_to)->name : '') }}</td>
                    <td>{{ (isset($data->user_id) && !empty($data->user_id) ? get_data_name_by_id('users',$data->user_id)->name : '') }}</td>

                </tr>
            <?php }
        }
        ?>
    </tbody>
</table>