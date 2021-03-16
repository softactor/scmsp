<?php
    $sl = 1;
    $deleteUrl = url('admin/user-delete');
    if (!$usersData->isEmpty()) {
        foreach ($usersData as $data) {
            ?>
            <tr id='delete_row_id_{{$data->id}}'>
                <td><?php echo $sl++; ?></td>
                <td>
                    <?php
                    if (isset($data->division_id) && !empty($data->division_id)) {
                        $divname = get_data_name_by_id('departments', $data->division_id);
                        if (isset($divname) && !empty($divname)) {
                            echo $divname->name;
                        }
                    }
                    ?>
                </td>
                <td><a href="{{ url('admin/user-edit/'.$data->id) }}" title="Click here to edit">{{ $data->name }}</a></td>
                <td>{{ $data->email }}</td>
                <td><?php echo (isset($data->role_id) && !empty($data->role_id) ? get_data_name_by_id('roles', $data->role_id)->name : 'Role unassigned!') ?></td>
                <td><?php echo (isset($data->mobile) && !empty($data->mobile) ? $data->mobile : 'No Data') ?></td>
                <td>
                    <a title="Edit" href="{{ url('admin/user-edit/'.$data->id) }}">
                        <i class="fa fa-edit text-success"></i>
                    </a>
                    <?php
                    $loggedinUser = Auth::user()->id;
                    if ($loggedinUser != $data->id) {
                        ?>
                        <a title="Delete" href="javascript:void(0)" onclick="user_delete_operation('{{ $deleteUrl }}', '{{ $data->id }}');">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php }
    }else{ ?>
            <tr>
                <td colspan="7">
                    <div class="alert alert-warning">
                        <strong>Sorry!</strong> No records.
                    </div>
                </td>
            </tr>
    <?php }
    ?>