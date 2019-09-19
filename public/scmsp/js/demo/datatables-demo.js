// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
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
