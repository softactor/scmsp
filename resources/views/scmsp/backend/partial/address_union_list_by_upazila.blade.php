<?php
$deleteUrl = url('admin/complain-type-delete');
if (!$addr_unions->isEmpty()) {
    foreach ($addr_unions as $data) {
        ?>
        <tr id="delete_row_id_<?php echo $data->id; ?>">
            <td>
                <?php echo $data->division_name; ?>
            </td>
            <td>
                <?php echo $data->district_name; ?>
            </td>
            <td>
                <?php echo $data->upazila_name; ?>
            </td>
            <td>
                <?php echo $data->union_name . ' (' . $data->union_bangla_name . ')'; ?>
            </td>
            <td style="text-align: center;">
                <?php
                $editUrl = url('admin/address_union_edit/' . $data->id);
                $deleteUrl = url('admin/address_upazila_delete');
                ?>
                <a href="<?php echo $editUrl; ?>">
                    <i class="fa fa-edit text-grey-darker"></i>
                </a>
                <?php
                if (isSuperAdmin(Auth::user()->id)) {
                    ?>
                    <a href="#" onclick="delete_operation('{{ $deleteUrl }}', '{{ $data->id }}');">
                        <i class="fa fa-trash text-danger"></i>
                    </a>
                <?php } ?>
            </td>
        </tr>
    <?php }
}else{ ?>
        <tr>
            <td colspan="5">
                <div class="alert alert-info"><strong>Sorry, no data found</strong></div>
            </td>
        </tr>
        
<?php }?>