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
    
function allcheck() {
    if ($('#isallpermission').is(":checked")) {
        $('.module_common_class').prop('checked', true);
    } else {
        $('.module_common_class').prop('checked', false);
    }
}


function toggleIndividualModuleChecked(classSelector) {
    if ($('#ind_module_all_selector_'+classSelector).is(":checked")) {
        $('.module_type_'+classSelector).prop('checked', true);
    } else {        
        $('#isallpermission').prop('checked', false);
        $('.module_type_'+classSelector).prop('checked', false);
    }
}

function permission_operation(){
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
}


function autosearch(){
   $(document).ready(function() {
     $("#search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: url,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   
                }
            });
        },
        minLength: 3,
       
    });
});
}

/*
 *   select previous permission details
 */

function getRoleWisePermission(url, roleId){
    if(roleId){
        $.ajax({
            url         : url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'role_id='+roleId,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#permission_access_section').html(response.data);                    
                }else{
                    $('#permission_access_section').html(response.data);
                }
            }
        });
    }
}