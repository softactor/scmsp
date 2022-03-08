<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
            <tr>
                <th>Contact</th>
                <th>SMS</th>
                <th>Date</th>
                <th>SMS Response</th>
                <th>Status</th>
            </tr>
            <tr>
                <td><?php echo $sms_history['contact_number'] ?></td>
                <td><?php echo $sms_history['details_sms'] ?></td>
                <td><?php echo $sms_history['created_at'] ?></td>
                <td><?php echo $sms_history['sms_response'] ?></td>
                <td>
                    <?php if($sms_history['sms_status']){ ?>
                    
                    <span class="label label-success">Sent</span>
                    
                    <?php }else{ ?>
                    
                    <span class="label label-danger">Failed to send</span>
                    
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>