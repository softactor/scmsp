<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Report PDF Example</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('scmsp/css/pdfprint.css') }}" rel="stylesheet">
    </head>
    <body>
        <header id="header">
            <h1>Saif Powertec Limited</h1>
        </header>
        <footer id="footer">
            <address>
                CORPORATE OFFICE
                72, Mohakhali C/A, (8th Floor), Rupayan Center, Dhaka-1212, Bangladesh.
                Tel.: (88-02) 9825705, 9891562, 9891597, 9856358-9, 9857902, 9852454, 9854423,
                Fax: (88-02) 9855949,
                E-mail: info@saifpowertec.com
            </address>
        </footer>
        <div class="data_container">
            <h3>Customer care Report PDF</h3>
            <table class="content">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Priority</th>
                        <th>Complain date</th>
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
                                    <?php echo $data->complainer_code; ?>
                                </td>
                                <td>
                                    <?php
                                    $res = get_data_name_by_id('complain_priorites', $data->priority_id);
                                    echo (isset($res) && !empty($res) ? $res->name : 'No data found');
                                    ?>
                                </td>
                                <td><?php echo human_format_date($data->created_at); ?></td>
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
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>