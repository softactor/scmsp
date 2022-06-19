<?php

/*
 * utilities method will be use for access frequently data from every where.
 * there will be custom method for custom result
 * @author: Tanveer Qureshee
 * Date: 28/04/2019
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

// GET TABLE DATA BY TABLE NAME:

function get_table_data_by_table($table, $order_by = null) {
    $result = DB::table($table);
    if (isset($order_by['order_by'])) {
        $result->orderBy($order_by['order_by_column'], $order_by['order_by']);
    }
    return $result->get();
}

function get_table_data_by_table_and_where($table, $where, $order_by = null) {
    $result = DB::table($table)->where($where);
    if (isset($order_by['order_by'])) {
        $result->orderBy($order_by['order_by_column'], $order_by['order_by']);
    }
    return $result->get();
}

// GET TABLE DATA BY TABLE NAME:

function get_data_name_by_id($table, $id) {
    $result     =   '';
    $result     =    DB::table($table)->where('id', '=', $id)->first();
    if(isset($result) && !empty($result)){
        return $result;
    }
    return $result;
}
function get_user_mobile_number_by_id($id) {
    $result     =   '';
    $result     =    DB::table('users')->where('id', '=', $id)->first();
    if(isset($result->mobile) && !empty($result->mobile)){
        return $result->mobile;
    }
    return $result;
}

function get_data_name_by_where($table, $where) {
    $result     =   '';
    $result     =    DB::table($table)->where($where)->first();
    if(isset($result) && !empty($result)){
        return $result;
    }
    return $result;
}

// CHECK DUPLICATE DATA ENTRY:

function check_duplicate_data($data) {
    $result = DB::table($data['table'])->where($data['where'])->first();
    if (isset($result) && !empty($result)) {
        return $result->id;
    } else {
        return false;
    }
}

// GET TABLE DATA BY TABLE NAME:

function get_table_data_by_clause($data) {
    $result = DB::table($data['table'])
            ->where($data['where']);
    if (isset($data['order_by'])) {
        $result->orderBy($data['order_by_column'], $data['order_by']);
    }
    $result_data = $result->get();
    if (isset($result_data) && !empty($result_data)) {
        return $result_data;
    } else {
        return false;
    }
}

function hasAccessPermission($role, $module, $accessType) {
    $accessAllPermission = DB::table('permissions')
            ->where('user_type', $role)
            ->where('isallpermission', 1)
            ->first();
    if (isset($accessAllPermission) && !empty($accessAllPermission)) {
        return true;
    }
    $accessmodAccPermission = DB::table('permissions')
            ->where('user_type', $role)
            ->where('module', $module)
            ->where($accessType, 1)
            ->first();
    if (isset($accessmodAccPermission) && !empty($accessmodAccPermission)) {
        return true;
    }
    $accessmodAccPermission = DB::table('permissions')
            ->where('user_type', $role)
            ->where('module', $module)
            ->where('isallmodulepermission', 1)
            ->first();
    if (isset($accessmodAccPermission) && !empty($accessmodAccPermission)) {
        return true;
    }

    return false;
}

function getUpazilaList($district_id = null) {
    $upazila_slq = DB::table('addr_upazilas as u')
            ->join('addr_districts as dis', 'u.district_id', '=', 'dis.id')
            ->join('addr_divisions as div', 'dis.division_id', '=', 'div.id')
            ->select('div.name as division_name','dis.name as district_name','u.id', 'u.name as upazila_name', 'u.bn_name as upazila_bn_name')
            ->orderBy('div.name', 'asc');
    
    if(isset($district_id) && !empty($district_id)){
        $upazila_slq->where('u.district_id', $district_id);
    }
    $upazila  =   $upazila_slq->get();
    return $upazila;
}
function getUnionList($upazila_id = null) {
    $union_sql = DB::table('addr_unions as u')
            ->join('addr_upazilas as upa', 'u.upazila_id', '=', 'upa.id')
            ->join('addr_districts as dis', 'upa.district_id', '=', 'dis.id')
            ->join('addr_divisions as div', 'dis.division_id', '=', 'div.id')
            ->select('div.name as division_name','dis.name as district_name','upa.name as upazila_name', 'u.id', 'u.name as union_name', 'u.bn_name as union_bangla_name')
            ->orderBy('div.name', 'asc');
    
    
    if(isset($upazila_id) && !empty($upazila_id)){
        $union_sql->where('u.upazila_id', $upazila_id);
    }
    $unions  =   $union_sql->get();
    return $unions;
}

function getRoleWiseUser($role_id) {
    $users = DB::table('users as u')
            ->join('model_has_roles as mhr', 'u.id', '=', 'mhr.model_id')
            ->join('roles as r', 'r.id', '=', 'mhr.role_id')
            ->where('r.id', '=', $role_id)
            ->select(DB::raw('CONCAT(u.first_name,u.last_name) AS name'), "u.id")
            ->get();
    return $users;
}

function getRoleIdByUserId($user_id) {
    $role = DB::table('model_has_roles as hr')
            ->where('hr.model_id', $user_id)
            ->first();
    return $role->role_id;
}

function getRoleNameByUserId($user_id) {
    $role = DB::table('users as u')
            ->select('r.name as role_name')
            ->join('user_roles as ur', 'ur.user_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'ur.role_id')
            ->where('u.id', $user_id)
            ->first();
    return $role->role_name;
}

function getTableTotalRows($data) {
    $field      = $data['field'];
    $total_row  = DB::table($data['table'])
            ->select(DB::raw("count($field) as total"))
            ->where($data['where'])
            ->first();
    return $total_row;
}

function get_settings_value($key) {
    $data = DB::table('settings')->where('setting_key', $key)->first();
    if (isset($data) && !empty($data)) {
        return $data->setting_value;
    }
    return 0;
}

function setActiveMenuClass($menuName, $currentMenu, $activeClass = 'active') {
    if ($menuName == $currentMenu) {
        return $activeClass;
    } else {
        return 'inactive';
    }
}

function get_status_wise_row_color($complain_status) {
    $status = get_data_name_by_id('complain_statuses', $complain_status)->name;
    switch ($status) {
        case 'Pending':
            $color = 'bg-danger';
            break;
        case 'Solved':
            $color = 'bg-success';
            break;
        case 'Processing':
            $color = 'bg-info';
            break;
        default:
            $color = 'bg-primary';
            break;
    }
    return $color;
}

function human_format_date($timestamp) {
    return date("jS M, Y h:i:a", strtotime($timestamp)); //September 30th, 2013
}

function isAgentRole($roleName) {
    if ($roleName == 'Agent') {
        return true;
    }
    return false;
}

function getTableTotalRowsByFieldValues($data) {
    $total_row = DB::table($data['table'])
            ->select(DB::raw("count(id) as total"))
            ->where($data['where'])
            ->first();
    return $total_row;
}

function generate_serial_number($data) {
    $alphanum = $data['alphanum'];
    $next_id = sprintf('%06d', $data['next_id']);
    $event = sprintf('%04d', $data['event_id']);
    $comingDigit = $event . $alphanum . $next_id;
    return $comingDigit;
}
// get Daily Assignment Import Code:
function getComplainCode($date, $prefix="C", $entry_type){
    $total_row = DB::table('complain_details')
            ->select(DB::raw("count(id) as total_row"))
            ->where('issued_date', $date)
            ->where('entry_type', $entry_type)
            ->first();
    $number             = intval($total_row->total_row) + 1;
    $dateFormatExplode  = explode('-', $date);
    $dateFormat         = $dateFormatExplode[0].$dateFormatExplode[1].$dateFormatExplode[2];
    $defaultCode        = $prefix.$dateFormat.sprintf('%03d', $number);
    return $defaultCode;

}
function sending_sms($smsData, $multiple = false, $history_id) {
    
// Set some options - we are passing in a useragent too here
    if ($multiple) {
        foreach ($smsData as $sdata) {
            
            // Send the request & save response to $resp
            $resp = execution_sms($sdata);
            $historyUpdateParam = [
                'is_sms_send' => 1,
                'sms_response' => $resp,
            ];
            DB::table('complain_details_history')->where('id', $history_id)->update($historyUpdateParam);
        }
    } else {
        // Send the request & save response to $resp
        $resp = execution_sms($smsData);
        $historyUpdateParam = [
            'is_sms_send'       => 1,
            'sms_response'      => $resp,
        ];
        DB::table('complain_details_history')->where('id', $history_id)->update($historyUpdateParam);
    }

// Close request to clear up some resources
    return $resp;
}


function execution_sms($sdata){
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER      => 1,
        CURLOPT_URL                 => 'http://users.sendsmsbd.com/smsapi',
        CURLOPT_USERAGENT           => 'SMS Process',
        CURLOPT_POST                => 1,
        CURLOPT_POSTFIELDS          => [
            'api_key'       => 'C200904161a870e1be5177.43884751', //C200904161a870e1be5177.43884751
            'type'          => 'text',
            'senderid'      => 'SAIF POWER', //SAIF POWER
            'contacts'      => '88' . $sdata['contacts'],
            'msg'           => $sdata['msg'],
        ]
    ]);
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    return $resp;
}


function short_str($str, $max = 50) {
    $str = trim($str);
    if (strlen($str) > $max) {
        $s_pos = strpos($str, ' ');
        $cut = $s_pos === false || $s_pos > $max;
        $str = wordwrap($str, $max, ';;', $cut);
        $str = explode(';;', $str);
        $str = $str[0] . '...';
    }
    return $str;
}

function get_customer_message($data){
    $message  = '';
    $message .= "Dear Valued Customer,";
    $message .= chr(10) . "Your complain have been successfully received.";
    $message .= chr(10) . "Complain ID is:";
    $message .= chr(10) . $data['complainerCode'];
    $message .= chr(10) . "Thanks";
    $message .= chr(10) . "SAIF Powertec Ltd";
    $message .= chr(10) . "if any further queries";
    $message .= chr(10) . "call us in our";
    $message .= chr(10) . "hotline: 16650";
    $smsParam   =   [
        'contacts'  =>  $data['contacts'],
        'msg'       =>  $message
    ];
    return $smsParam;
}
function get_service_staff_message($data){
    $message  = '';
    $message .= "Dear Concern,";
    $message .= chr(10) . $data['complainerType']." related complain have been assigned to you.";
    $message .= chr(10) . "Complain ID is:";
    $message .= chr(10) . $data['complainerCode'];
    $message .= chr(10) . "Name: ".$data['complainerName'];
    $message .= chr(10) . "Mobile: ".$data['complainerMobile'];
    $message .= chr(10) . "Thanks";
    $message .= chr(10) . "SAIF Powertec Ltd";   
    $smsParam   =   [
        'contacts'  =>  $data['contacts'],
        'msg'       =>  $message
    ];
    return $smsParam;
}
function get_manager_message($data){
    $message  = '';
    $message .= "Dear Concern,";
    $message .= chr(10) . $data['complainerType']." related  complain have been assigned to ".$data['contacts'];
    $message .= chr(10) . "Complain ID is:";
    $message .= chr(10) . $data['complainerCode'];
    $message .= chr(10) . "Name: ".$data['complainerName'];
    $message .= chr(10) . "Mobile: ".$data['complainerMobile'];
    $message .= chr(10) . "Thanks";
    $message .= chr(10) . "SAIF Powertec Ltd";   
    $smsParam   =   [
        'contacts'  =>  $data['mmobile'],
        'msg'       =>  $message
    ];
    return $smsParam;
}
function isSuperAdmin($user_id) {
    $role = DB::table('users as u')
            ->select('r.name as role_name')
            ->join('user_roles as ur', 'ur.user_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'ur.role_id')
            ->where('u.id', $user_id)
            ->first();
    if($role->role_name == "Admin"){
        return true;
    }
    return false;
}

function get_complain_details_by_area_manager($area_manager_id, $complain_status=false){
    if($complain_status){
        $complainDetailsData   = DB::table('complain_details as u')
                ->select('u.id', 'u.complainer_code', 'u.category_id','u.complain_type_id', 'u.complainer', 'u.name','u.address', 'u.complain_details', 'u.feedback_details','u.issued_date', 'u.division_id', 'u.department_id','u.user_id', 'u.assign_to', 'u.complain_status','u.priority_id', 'u.created_at', 'u.updated_at')
                ->join('users as ur', 'u.assign_to', '=', 'ur.id')
                ->join('staff_locations as sl', 'u.assign_to', '=', 'sl.user_id')
                ->where('sl.area_mng_id',$area_manager_id)
                ->where('u.entry_type', 1)
                ->where('u.complain_status',$complain_status)
                ->get();
    }else{
        $complainDetailsData   = DB::table('complain_details as u')
                ->select('u.id', 'u.complainer_code', 'u.category_id','u.complain_type_id', 'u.complainer', 'u.name','u.address', 'u.complain_details', 'u.feedback_details','u.issued_date', 'u.division_id', 'u.department_id','u.user_id', 'u.assign_to', 'u.complain_status','u.priority_id', 'u.created_at', 'u.updated_at')
                ->join('users as ur', 'u.user_id', '=', 'ur.id')
                ->join('staff_locations as sl', 'u.user_id', '=', 'sl.user_id')
                ->where('sl.area_mng_id',$area_manager_id)
                ->where('u.entry_type', 1)
                ->get();
    }
    return $complainDetailsData;
}

function get_complain_details_by_zonal_manager($zonal_manager_id, $complain_status=false, $complain_entry_type = 1){
    $divisionId                =    get_zonal_manager_division_by_user_id(Auth::user()->id);  
    $isAllLocation             =    user_has_all_location(Auth::user()->id, $divisionId);
    
    if($complain_status){
        $complainDetailsDataSql   = DB::table('complain_details as u')
                ->select('u.id', 'u.complainer_code', 'u.category_id','u.complain_type_id', 'u.complainer', 'u.name','u.address', 'u.complain_details', 'u.feedback_details','u.issued_date', 'u.division_id', 'u.department_id','u.user_id', 'u.assign_to', 'u.complain_status','u.priority_id', 'u.created_at', 'u.updated_at')
                ->join('users as ur', 'u.assign_to', '=', 'ur.id')                
                ->where('u.division_id',$divisionId)
                ->where('u.entry_type', 1)
                ->where('u.complain_status',$complain_status)
                ->where('u.complain_entry_type',$complain_entry_type);
        if(!$isAllLocation){
            $complainDetailsDataSql->join('staff_locations as sl', 'u.assign_to', '=', 'sl.user_id');
        }
        $complainDetailsData    =   $complainDetailsDataSql->get();
    }else{
        $complainDetailsDataSql   = DB::table('complain_details as u')
                ->select('u.id', 'u.complainer_code', 'u.category_id','u.complain_type_id', 'u.complainer', 'u.name','u.address', 'u.complain_details', 'u.feedback_details','u.issued_date', 'u.division_id', 'u.department_id','u.user_id', 'u.assign_to', 'u.complain_status','u.priority_id', 'u.created_at', 'u.updated_at')
                ->join('users as ur', 'u.user_id', '=', 'ur.id')
                ->where('u.division_id',$divisionId)
                ->where('u.entry_type', 1)
                ->where('u.complain_entry_type',$complain_entry_type);
        if(!$isAllLocation){
            $complainDetailsDataSql->join('staff_locations as sl', 'u.assign_to', '=', 'sl.user_id');
        }
        $complainDetailsData    =   $complainDetailsDataSql->get();
    }
    return $complainDetailsData;
}

function mail_execution($data){
    $emails['to']                   = 'tanveerqureshee1@gmail.com';
    $emails['from_address']         = 'mail.saifpowergroup.com';
    $emails['from_name']            = 'Saif Customer Care';
    $mail                           = Mail::send('Test', function ($message) use ($emails) {
        $message->from($emails['from_address'], $emails['from_name']);
        $message->to($emails['to']);
        $message->subject("Complain Test Mail");
    });
}
function get_report_table_data($request){
    //$all     =   $request->all();
    $filtersData['filter']      =   [];
    $query           =     DB::table('complain_details as p');
    if (isset($request->all) && !empty($request->all)) {
        $list_data = $query->select('p.*')->get();
        $filtersData['filter']['all']   =   true;
    } else {
        if (isset($request->complainer) && !empty($request->complainer)) {
            $query->where('p.complainer', '=', $request->complainer);
            $filtersData['filter']['complainer']   =   $request->complainer;
        }
        if (isset($request->from_date) && !empty($request->from_date)) {
            $from_date      =   date("Y-m-d", strtotime($request->from_date)).' 00:00:00';
            $query->where('p.created_at', '>=', $from_date);
            $filtersData['filter']['from_date']   =   $request->from_date;
        }            
        if (isset($request->to_date) && !empty($request->to_date)) {
            $to_date      =   date("Y-m-d", strtotime($request->to_date)).' 12:59:59';
            $query->where('p.created_at', '<=', $to_date);
            $filtersData['filter']['to_date']   =   $request->to_date;
        }
        if (isset($request->div_id) && !empty($request->div_id)) {
            $query->where('p.division_id', '=', $request->div_id);
            $filtersData['filter']['div_id']   =   $request->div_id;
        }
        if (isset($request->dept_id) && !empty($request->dept_id)) {
            $query->where('p.department_id', '=', $request->dept_id);
            $filtersData['filter']['dept_id']   =   $request->dept_id;
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $query->where('p.category_id', '=', $request->category_id);
            $filtersData['filter']['category_id']   =   $request->category_id;
        }
        if (isset($request->complain_type_id) && !empty($request->complain_type_id)) {
            $query->where('p.complain_type_id', '=', $request->complain_type_id);
            $filtersData['filter']['complain_type_id']   =   $request->complain_type_id;
        }
    }
    Session::put('filters', $filtersData);
    $report_data = $query->select('p.*')->get();
    return $report_data;
}

function getManagerMobileByServiceStaff($data){
    $role = DB::table('users as u')
            ->select('u.mobile as mobile')
            ->join('staff_locations as sl', 'u.id', '=', 'sl.area_mng_id')
            ->where('sl.addr_div_id', $data['addr_div_id'])
            ->where('sl.addr_dis_id', $data['addr_dis_id'])
            ->where('sl.addr_up_id', $data['addr_up_id'])
            ->where('sl.addr_union_id', $data['addr_union_id'])
            ->where('sl.user_id', $data['user_id'])
            ->first();
    if(isset($role->mobile)){
        return $role->mobile;
    }
    return false;
}
// this method is using for get all division service staff:
function get_all_division_service_staff($division_id){
    $data = DB::table('users as u')
            ->select('u.id', 'u.name')
            ->join('staff_locations as sl', 'u.id', '=', 'sl.user_id')
            ->where('sl.all_division', 1)
            ->where('u.division_id', $division_id)
            ->get();
    return $data;
}
function get_area_manager_by_department($request){
    $areaManagerdata           =   DB::table('users as u')
        ->select('u.id as user_id', 'u.name as user_name')
        ->join('user_roles as ur', 'u.id', '=', 'ur.user_id')
        ->where('u.division_id',$request->division_id)
        ->where('u.department_id',$request->department_id)
        ->where('ur.role_id',5)
        ->get();
    return $areaManagerdata;
}


function get_address_division_by_district_id($district_id){
    //addr_districts
    $data       =   DB::table('addr_districts')
            ->select('division_id')
            ->where('id', $district_id)
            ->first();
    if(isset($data) && !empty($data)){
        return $data->division_id;
    }
    
    return '';
}

function get_zonal_manager_division_by_user_id($userId){
    $data   =   DB::table('users')
            ->select('division_id')
            ->where('id', $userId)
            ->first();
    if(isset($data) && !empty($data)){
        return $data->division_id;
    }
    
    return '';
}

function get_division_name_by_id($id){
    //addr_districts
    $data       =   DB::table('departments')
            ->select('name')
            ->where('id', $id)
            ->first();
    if(isset($data) && !empty($data)){
        return $data->name;
    }
    
    return 'No Data Found';
}
function get_department_name_by_id($id){
    //addr_districts
    $data       =   DB::table('divisions')
            ->select('name')
            ->where('id', $id)
            ->first();
    if(isset($data) && !empty($data)){
        return $data->name;
    }
    
    return 'No Data Found';
}

function user_has_all_location($userId, $divisionId){
    $data           =   DB::table('staff_locations as s')
        ->select('s.all_division as all_location')
        ->join('users as u', 'u.id', '=', 's.user_id')
        ->where('u.division_id',$divisionId)
        ->where('u.id',$userId)
        ->first();
    if(isset($data) && !empty($data)){
        return $data->all_location;
    }
    return 0;
}

function get_address_division(){
    $order_by['order_by_column']    =   'name';
    $order_by['order_by']           =   'ASC';
    $divisions                      = get_table_data_by_table('addr_divisions', $order_by);
    return $divisions;
}
function get_all_division(){
    $order_by['order_by_column']    =   'name';
    $order_by['order_by']           =   'ASC';
    $divisions                      = get_table_data_by_table('departments', $order_by);
    return $divisions;
}
function get_all_role(){
    $order_by['order_by_column']    =   'name';
    $order_by['order_by']           =   'ASC';
    $divisions                      = get_table_data_by_table('roles', $order_by);
    return $divisions;
}

function get_dynamic_division(){
    $list   =   "";
    $role   =   getRoleNameByUserId(Auth::user()->id);
    if($role== 'Admin' || $role=='Agent'){
        $list = get_table_data_by_table('departments');
    }else{
        $divisionId                =    get_zonal_manager_division_by_user_id(Auth::user()->id);
        $table          =   "departments";
        $where          =   [
            'id'        =>  $divisionId
        ];
        $list           =   get_table_data_by_table_and_where($table, $where);
    }    
    return $list;
}