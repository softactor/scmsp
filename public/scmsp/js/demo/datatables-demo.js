// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#user_list_data_table').DataTable();
    $('#complainDetailsdataTable').DataTable({
        order: [
            [3, 'desc']
        ],
        "columnDefs": [{
                "targets": [5],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [0],
                "searchable": false
            }
        ]
    });
});