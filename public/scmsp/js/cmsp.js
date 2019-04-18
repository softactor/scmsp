/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function OpenComplainTypeEditModal(url, row_id){
    $.ajax({
        url         :   url,
        type        :   'GET',
        dataType    :  'json',
        data        : 'row_id='+row_id,
        success     : function(response){
            console.log(response);
            $('#complainTypeEdit').modal('show');
            $('#modal_body_content').html(response.data);
        }
    });
}

function updateComplainType(url){
    $.ajax({
        url         :  url,
        type        :  'POST',
        dataType    :  'json',
        headers     : {
                    'X-CSRF-Token': $('#csrf_token').val(),
                },
        data        :  $('#complain_type_update_form').serialize(),
        success     :  function(response){
            if(response.status == 'success'){
                $('.alert').hide();
                $('#success_alert').show();
                $('#success_alert').html(response.message);
                setTimeout(function(){
                    location.reload();
                }, 1000);
            }else if(response.status == 'duplicate_error'){
                $('#danger_alert').show();
                $('#danger_alert').html(response.message);
            }
        }
    });
}

function confirmDeleteOp(url, row_id){
    swal({
        title: "Are you sure?",
        text: "You want to delete it!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Confirm",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
            url         :  url,
            type        :  'GET',
            dataType    :  'json',
            data        :  'id='+row_id,
            success     :  function(response){
                $('#table_row_id_'+row_id).hide();
                swal('Deleted', response.message, 'success');
            }
        });
      });
    
}

