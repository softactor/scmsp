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
function getComplainCode($date, $prefix="C"){
    $total_row = DB::table('complain_details')
            ->select(DB::raw("count(id) as total_row"))
            ->where('issued_date', $date)
            ->first();
    $number             = intval($total_row->total_row) + 1;
    $dateFormatExplode  = explode('-', $date);
    $dateFormat         = $dateFormatExplode[0].$dateFormatExplode[1].$dateFormatExplode[2];
    $defaultCode        = $prefix.$dateFormat.sprintf('%03d', $number);
    return $defaultCode;

}
function sending_sms($smsData, $multiple = false, $history_id) {
    $curl = curl_init();
// Set some options - we are passing in a useragent too here
    if ($multiple) {
        foreach ($smsData as $sdata) {
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://users.sendsmsbd.com/smsapi',
                CURLOPT_USERAGENT => 'SMS Process',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => [
                    'api_key' => 'C20042245d5bcca0a4bc54.80275636',
                    'type' => 'text',
                    'senderid' => '8804445629107',
                    'contacts' => '88' . $sdata['contacts'],
                    'msg' => $sdata['msg'],
                ]
            ]);
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            $historyUpdateParam = [
                'is_sms_send' => 1,
                'sms_response' => $resp,
            ];
            DB::table('complain_details_history')->where('id', $history_id)->update($historyUpdateParam);
        }
    } else {
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://users.sendsmsbd.com/smsapi',
            CURLOPT_USERAGENT => 'SMS Process',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => [
                'api_key' => 'C20042245d5bcca0a4bc54.80275636',
                'type' => 'text',
                'senderid' => '8804445629107',
                'contacts' => '88' . $smsData['contacts'],
                'msg' => $smsData['msg'],
            ]
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        $historyUpdateParam = [
            'is_sms_send' => 1,
            'sms_response' => $resp,
        ];
        DB::table('complain_details_history')->where('id', $history_id)->update($historyUpdateParam);
    }

// Close request to clear up some resources
    curl_close($curl);
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
                ->where('u.complain_status',$complain_status)
                ->get();
    }else{
        $complainDetailsData   = DB::table('complain_details as u')
                ->select('u.id', 'u.complainer_code', 'u.category_id','u.complain_type_id', 'u.complainer', 'u.name','u.address', 'u.complain_details', 'u.feedback_details','u.issued_date', 'u.division_id', 'u.department_id','u.user_id', 'u.assign_to', 'u.complain_status','u.priority_id', 'u.created_at', 'u.updated_at')
                ->join('users as ur', 'u.user_id', '=', 'ur.id')
                ->join('staff_locations as sl', 'u.user_id', '=', 'sl.user_id')
                ->where('sl.area_mng_id',$area_manager_id)
                ->get();
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
    $ll     =   $request->all();
    $query           =     DB::table('complain_details as p');
    if (isset($request->all) && !empty($request->all)) {
        $list_data = $query->select('p.*')->get();
    } else {
        if (isset($request->complainer) && !empty($request->complainer)) {
            $query->where('p.complainer', '=', $request->complainer);
        }
        if (isset($request->from_date) && !empty($request->from_date)) {
            $from_date      =   date("Y-m-d", strtotime($request->from_date)).' 00:00:00';
            $query->where('p.created_at', '>=', $from_date);
        }            
        if (isset($request->to_date) && !empty($request->to_date)) {
            $to_date      =   date("Y-m-d", strtotime($request->to_date)).' 12:59:59';
            $query->where('p.created_at', '<=', $to_date);
        }
        if (isset($request->div_id) && !empty($request->div_id)) {
            $query->where('p.division_id', '=', $request->division_id);
        }
        if (isset($request->dept_id) && !empty($request->dept_id)) {
            $query->where('p.department_id', '=', $request->department_id);
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $query->where('pa.category_id', '=', $request->category_id);
        }
        if (isset($request->complain_type_id) && !empty($request->complain_type_id)) {
            $query->where('p.complain_type_id', '=', $request->complain_type_id);
        }
        if (isset($request->addr_div_id) && !empty($request->addr_div_id)) {
            $query->where('p.subsector_id', '=', $request->subsector_id);
        }
        if (isset($request->addr_dis_id) && !empty($request->addr_dis_id)) {
            $progress_type  =   true;
            $query->where('pp.progresstype', '=', $request->progress_type);
        }   
        if (isset($request->addr_upazila_id) && !empty($request->addr_upazila_id)) {
            $progress_type  =   true;
            $query->where('pp.progresstype', '=', $request->progress_type);
        }   
        if (isset($request->addr_union_id) && !empty($request->addr_union_id)) {
            $progress_type  =   true;
            $query->where('pp.progresstype', '=', $request->progress_type);
        }
    }
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