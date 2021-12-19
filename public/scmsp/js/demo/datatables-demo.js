// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#user_list_data_table').DataTable();
  $('#complainDetailsdataTable').DataTable({
    order: [[3, 'desc']],
    "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
                "searchable": false
            }
        ]
  });
});
