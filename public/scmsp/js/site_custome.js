function delete_operation(url, del_id) {
    swal({
        title: "Are you sure,You want to delete this?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Confirm!",
        closeOnConfirm: false
    },
        function () {
            $.ajax({
                url     : url,
                type    : 'POST',
                dataType: 'json',
                data    : 'del_id='+del_id,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if (response.status == 'success') {
                        $('#delete_row_id_'+del_id).hide();
                        swal("Deleted!", "Data has been deleted.", "success");
                    }else{
                    }                    
                },
                async: false // <- this turns it into synchronous
            });
            
        });
    }