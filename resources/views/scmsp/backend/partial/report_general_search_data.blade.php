<div class="table-responsive">
    <table class="table table-bordered complain_details_table_style list-table-custom-style" id="complainDetailsdataTable" width="100%" cellspacing="0">
        <tbody id="complain_details">
            <tr>
                <td class="text-right">
                    <a href="">
                        <img src="<?php echo asset('scmsp/icon/export_pdf_small.png') ?>">PDF
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-bordered complain_details_table_style list-table-custom-style" id="complainDetailsdataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Code</th>
                <th>Priority</th>
                <th>Complain date</th>
                <th>Complain raw date</th>
                <th>complainer</th>
                <th>Complain Type</th>
                <th>Status</th>
                <th>In-Charge</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody id="complain_details">
            <?php
            $deleteUrl = url('admin/complain-details-delete');
            if (!$report_data->isEmpty()) {
                foreach ($report_data as $data) {
                    $rawColor = get_status_wise_row_color($data->complain_status);
                    ?>
                    <tr id='delete_row_id_{{$data->id}}' class="<?php echo $rawColor; ?>">
                        <td>
                            <a href="{{ url('admin/complain-details-edit/'.$data->id) }}"> 
                                <?php echo $data->complainer_code; ?>
                            </a>
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
                            <a href="{{ url('admin/complain-details-edit/'.$data->id) }}">                                    
                                <?php
                                $res = get_data_name_by_id('complain_statuses', $data->complain_status);
                                echo (isset($res) && !empty($res) ? $res->name : 'No data found');
                                ?>
                            </a>
                        </td>
                        <td>{{ (isset($data->assign_to) && !empty($data->assign_to) ? get_data_name_by_id('users',$data->assign_to)->name : '') }}</td>
                        <td>{{ (isset($data->user_id) && !empty($data->user_id) ? get_data_name_by_id('users',$data->user_id)->name : '') }}</td>
                        
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>