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

// GET TABLE DATA BY TABLE NAME:

function get_table_data_by_table($table, $order_by  =   null){
    $result     =    DB::table($table);
    if(isset($order_by['order_by'])){
        $result->orderBy($order_by['order_by_column'], $order_by['order_by']);
    }
    return $result->get();
}

// GET TABLE DATA BY TABLE NAME:

function get_data_name_by_id($table,$id){
    return DB::table($table)->where('id', '=', $id)->first();
}

function get_data_name_by_where($table,$where){
    return DB::table($table)->where($where)->first();
}

// CHECK DUPLICATE DATA ENTRY:

function check_duplicate_data($data){
    $result     =    DB::table($data['table'])->where($data['where'])->first();
    if(isset($result) && !empty($result)){
        return $result->id;
    }else{
        return false;
    }
}
// GET TABLE DATA BY TABLE NAME:

function get_table_data_by_clause($data){
    $result     =    DB::table($data['table'])
            ->where($data['where']);
    if(isset($data['order_by'])){
        $result->orderBy($data['order_by_column'], $data['order_by']);
    }
    $result_data    =   $result->get();
    if(isset($result_data) && !empty($result_data)){
        return $result_data;
    }else{
        return false;
    }
} 

function hasAccessPermission($user_id, $page_id, $accessType){
    $return =   false;
    $access = DB::table('page_access as pa')
            ->join('model_has_roles as mhr', 'pa.role_id', '=', 'mhr.role_id')
            ->where('mhr.model_id','=',$user_id)
            ->where('pa.page_id','=',$page_id)
            ->where('pa.'.$accessType,'=',1)
            ->select('pa.*')
            ->get();
    
    if($access->first()){
        $return =   true;
    }
    
    return $return;
}
function getRoleWiseUser($role_id){
    $users = DB::table('users as u')
            ->join('model_has_roles as mhr', 'u.id', '=', 'mhr.model_id')
            ->join('roles as r', 'r.id', '=', 'mhr.role_id')
            ->where('r.id','=',$role_id)
            ->select(DB::raw('CONCAT(u.first_name,u.last_name) AS name'), "u.id")
            ->get();
    return $users;
}

function getRoleIdByUserId($user_id){
    $role   =   DB::table('model_has_roles as hr')
                ->where('hr.model_id',$user_id)
                ->first();
    return  $role->role_id;
}

function getTableTotalRows($data){
    $field  =   $data['field'];
    $total_row   =   DB::table($data['table'])
                            ->select(DB::raw("count($field) as total"))
                            ->where($data['where'])
                            ->first();
    return $total_row;
}
    
    function get_settings_value($key){
        $data     = DB::table('settings')->where('name', $key)->first();
        if(isset($data) && !empty($data)){
            switch($data->data_type){
                case 'csv':
                    $get_values = explode(',', $data->values);
                    break;
            }
            return $get_values;
        }
        
    }
    function setActiveMenuClass($menuName,  $currentMenu, $activeClass='active'){
        if($menuName == $currentMenu){
            return $activeClass;
        }else{
            return 'inactive';
        }
    }