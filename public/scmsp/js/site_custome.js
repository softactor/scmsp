function user_delete_operation(url, del_id) {
    swal({
        title: "Are you sure,You want to delete?",
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
                console.log(response);
                if (response.status == 'success') {
                    $('#delete_row_id_'+del_id).hide();
                    swal("Deleted!", "Data has been deleted.", "success");
                }else{
                    swal("Warning!", response.message, "error");
                }                    
            },
            async: false // <- this turns it into synchronous
        });

    });
}
function delete_operation(url, del_id) {
    swal({
        title: "Are you sure,You want to delete?",
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

/*
 *  getDepartmentByDivision
 */
function getDepartmentByDivision(divisionId, selector, url){
    if(divisionId){
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'dept_id='+divisionId,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}

/*
 *  getDepartmentByDivision
 */
function getAddressDistrictByDivision(divisionId, selector, url){
    if(divisionId){
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'division_id='+divisionId,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}
/*
 *  getDepartmentByDivision
 */
function getAddressUpazialByDistrict(districtId, selector, url){
    if(districtId){
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'district_id='+districtId,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}


/*
 *  getDepartmentByDivision
 */
function getusersByDepartment(union_id, selector, url){
    if(union_id){
        var division_id     =   $('#div_id').val();
        var department_id   =   $('#dept_id').val();
        var addr_div_id     =   $('#addr_div_id').val();
        var addr_dis_id     =   $('#addr_dis_id').val();
        var addr_up_id     =   $('#addr_upazila_id').val();
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'division_id='+division_id+'&department_id='+department_id+'&addr_div_id='+addr_div_id+'&addr_dis_id='+addr_dis_id+'&addr_up_id='+addr_up_id+'&addr_union_id='+union_id,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).append(response.data);                    
                }
            }
        });
    }
}
/*
 *  getDepartmentByDivision
 */
function getCategoryWiseComplainType(category_id,url,selector, divSelector, depSelector){
    if(category_id){
        var division_id     =   $('#'+divSelector).val();
        var department_id   =   $('#'+depSelector).val();
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'category_id='+category_id+'&division_id='+department_id+'&department_id='+division_id,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    var defaultSelector = "<option value=''>Select</option>";
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}
/*
 *   getCategoryByDepartment
 */
function getCategoryByDepartment(dept_id,divSelector,selector,url){
    if(dept_id){
        var division_id     =   $('#'+divSelector).val();
        var department_id   =   dept_id;
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'division_id='+division_id+'&department_id='+department_id,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    var defaultSelector = "<option value=''>Select</option>";
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}
/*
 *   getCategoryByDepartment
 */
function getAddressRelatedAjaxdata(id,selector,url){
    if(id){
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'id='+id,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    var defaultSelector = "<option value=''>Select</option>";
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}
function getAreaManagerByDepartment(dept_id,divSelector,selector,url){
    if(dept_id){
        var division_id     =   $('#'+divSelector).val();
        var department_id   =   dept_id;
        $.ajax({
            url         :  url,
            type        : 'GET',
            dataType    : 'json',
            data        : 'division_id='+division_id+'&department_id='+department_id,
            success     : function(response){
                if(response.status  ==  'success'){
                    $('#'+selector).html(response.data);                    
                }else{
                    var defaultSelector = "<option value=''>Select</option>";
                    $('#'+selector).html(defaultSelector);
                }
            }
        });
    }else{
        var defaultSelector = "<option value=''>Select</option>";
        $('#'+selector).html(defaultSelector);
    }
}

function getCMSReport(selector, url) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: $('#report_search_form').serialize(),
        success: function (response) {
            if (response.status == 'success') {
                $('#' + selector).html(response.data);
            }else{
                $('#' + selector).html('');
                swal("Sorry!", response.message, "error");
            }
        }
    });
}
function generatePDF(url) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: $('#report_search_form').serialize(),
        success: function (response) {
            if (response.status == 'success') {
                //window.location=response.data;
                var win = window.open(response.data, '_blank');
                win.focus();
            }else{
                $('#' + selector).html('');
                swal("Sorry!", response.message, "error");
            }
        }
    });
}

function get_all_division_service_users(division_id, url){
    if(division_id){
        $.ajax({
            url     : url,
            type    : 'GET',
            dataType: 'json',
            data    : 'division_id='+division_id,
            success: function (response) {
                if (response.status == 'success') {
                    $('#assign_to').append(response.data);
                }
            }
        });
    }
}