<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\user\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load user list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
        $role           =   getRoleNameByUserId(Auth::user()->id);        
        if($role== 'Admin'){
            $list = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*', 'user_roles.role_id')
            ->get();
        }elseif($role== 'Area Manager'){
            $userDetails    =   DB::table('users')->where('id', Auth::user()->id)->first();
            $list = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.role_id')
            ->where('division_id' , $userDetails->division_id)
            ->get();
        }
        /* selected menue data */
        $activeMenuClass    =   'users';   
        $subMenuClass       =   'users-list';
        return View('scmsp.backend.user.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load user create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
            $role           =   getRoleNameByUserId(Auth::user()->id);
            $userDetails    =   DB::table('users')->where('id', Auth::user()->id)->first();
            /* selected menue data */
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'users-list';
            return View('scmsp.backend.user.create', compact('activeMenuClass','subMenuClass', 'role', 'userDetails'));
	}
        /*
	Method Name	: edit
	Purpose		: load user edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
        $role           =   getRoleNameByUserId(Auth::user()->id);
        $userDetails    =   DB::table('users')->where('id', Auth::user()->id)->first();
        $editData = DB::table('users')
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->select('users.*', 'user_roles.role_id')
                ->where('users.id', $request->user_edit_id)
        ->first();
        /* selected menue data */
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'users-list';
        return View('scmsp.backend.user.edit', compact('editData','activeMenuClass','subMenuClass', 'role', 'userDetails'));
	}
        /*
            Method Name	: store
            Purpose		: load user store
            Param		: no param need
            Date		: 05/08/2019
            Author		: Tanveer Qureshee
	*/
	public function store(Request $request){
            
            $created_by =   Auth::user()->id;
            
            
            
            $staffLocation  =   false;
            if (isset($request->role_id) && !empty($request->role_id)) {
                $userRoll = get_data_name_by_id('roles', $request->role_id)->name;
                if ($userRoll == 'Service Staff') {
                    $rules = [
                        'name'              => 'required',
                        'email'             => 'required',
                        'password'          => 'required',
                        'role_id'           => 'required',
                        'div_id'            => 'required',
                        'dept_id'           => 'required',
                        'addr_div_id'       => 'required',
                        'addr_dis_id'       => 'required',
                        'addr_upazila_id'   => 'required',
                        'addr_union_id'     => 'required',
                        'mobile'            => 'required',
                    ];
                } else if($userRoll == 'Area Manager') {
                    $rules = [
                        'name'      => 'required',
                        'email'     => 'required',
                        'password'  => 'required',
                        'role_id'   => 'required',
                        'mobile'    => 'required',
                        'div_id'    => 'required',
                        'dept_id'   => 'required',
                    ];
                } else {
                    $rules = [
                        'name'      => 'required',
                        'email'     => 'required',
                        'password'  => 'required',
                        'role_id'   => 'required',
                        'mobile'   => 'required',
                    ];
                }
            }else{
                $rules = [
                        'name'      => 'required',
                        'email'     => 'required',
                        'password'  => 'required',
                        'role_id'   => 'required',
                        'mobile'   => 'required',
                    ];
            }

        $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('admin/user-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $userData  =   [
                'name'          =>  $request->name,
                'email'         =>  $request->email,
                'division_id'   =>  (isset($request->div_id) && !empty($request->div_id) ? $request->div_id : 0),
                'department_id' =>  (isset($request->dept_id) && !empty($request->dept_id) ? $request->dept_id : 0),
                'mobile'        =>  (isset($request->mobile) && !empty($request->mobile) ? $request->mobile : 0),
                'password'      =>  Hash::make($request->password),
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            //insert
            $user_id   =   DB::table('users')->insertGetId($userData);
            $roleData  =   [
                'user_id'   =>  $user_id,
                'role_id'   =>  $request->role_id,
                'created_at'=>  date('Y-m-d H:i:s'),
                'updated_at'=>  date('Y-m-d H:i:s'),
            ];
            $user_roles_id   =   DB::table('user_roles')->insert($roleData);
            
            
            
            
            
            // If Service Staff Then the following code block will execute:
            
            $addrDiv        =   (isset($request->addr_div_id) && !empty($request->addr_div_id) ? $request->addr_div_id : false);
            $addrDis        =   (isset($request->addr_dis_id) && !empty($request->addr_dis_id) ? $request->addr_dis_id : false);
            $addrUpz        =   (isset($request->addr_upazila_id) && !empty($request->addr_upazila_id) ? $request->addr_upazila_id : false);
            $addrunion      =   (isset($request->addr_union_id) && !empty($request->addr_union_id) ? $request->addr_union_id : false);
            $areaManger     =   (isset($request->area_manager_id) && !empty($request->area_manager_id) ? $request->area_manager_id : false);
            $is_all_location=   (isset($request->all_division) && !empty($request->all_division) ? $request->all_division : 0);
            if($addrDiv || $addrDis){
                $staffLocation  =   true;
            }
            
            if($staffLocation){
                $created_at         =   date('Y-m-d H:i:s');                
                if($is_all_location){
                    $staffLocationsData  =   [
                        'all_division'      =>  $is_all_location,
                        'user_id'           =>  $user_id,
                        'area_mng_id'       =>  $areaManger,
                        'created_at'        =>  $created_at,
                        'created_by'        =>  $created_by,
                    ];
                    //insert
                    DB::table('staff_locations')->insertGetId($staffLocationsData);
                }else{                
                    $num_of_address     =   count($addrDiv); 
                    for($nofadd = 0; $nofadd < $num_of_address; $nofadd++){
                        $staffLocationsData  =   [
                            'all_division'      =>  $is_all_location,
                            'addr_div_id'       =>  $addrDiv[$nofadd],
                            'addr_dis_id'       =>  $addrDis[$nofadd],
                            'addr_up_id'        =>  $addrUpz[$nofadd],
                            'addr_union_id'     =>  $addrunion[$nofadd],
                            'user_id'           =>  $user_id,
                            'area_mng_id'       =>  $areaManger,
                            'created_at'        =>  $created_at,
                            'created_by'        =>  $created_by,
                        ];
                        //insert
                        DB::table('staff_locations')->insertGetId($staffLocationsData);
                    }
                }
            }
            
            
            
            
            
            
            return redirect('admin/user-list')->with('success', 'User have been successfully created.');
	}
        
        /*
	Method Name	: update
	Purpose		: load user update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
            
            $created_by =   Auth::user()->id;
            $staffLocation  =   false;
            if (isset($request->role_id) && !empty($request->role_id)) {
                $userRoll = get_data_name_by_id('roles', $request->role_id)->name;
                if ($userRoll == 'Service Staff') {
                    $rules = [
                        'name'              => 'required',
                        'email'             => 'required',
                        'role_id'           => 'required',
                        'div_id'            => 'required',
                        'dept_id'           => 'required',
                        'addr_div_id'       => 'required',
                        'addr_dis_id'       => 'required',
                        'addr_upazila_id'   => 'required',
                        'addr_union_id'     => 'required',
                        'mobile'            => 'required',
                    ];
                } else if($userRoll == 'Area Manager') {
                    $rules = [
                        'name'      => 'required',
                        'email'     => 'required',
                        'role_id'   => 'required',
                        'mobile'    => 'required',
                        'div_id'    => 'required',
                        'dept_id'   => 'required',
                    ];
                } else {
                    $rules = [
                        'name'      => 'required',
                        'email'     => 'required',
                        'role_id'   => 'required',
                        'mobile'   => 'required',
                    ];
                }
            }else{
                $rules = [
                        'name'      => 'required',
                        'email'     => 'required',
                        'role_id'   => 'required',
                        'mobile'   => 'required',
                    ];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('admin/user-edit/'.$request->user_update_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $userData  =   [
                'name'          =>  $request->name,
                'email'         =>  $request->email,
                'division_id'   =>  (isset($request->div_id) && !empty($request->div_id) ? $request->div_id : 0),
                'department_id' =>  (isset($request->dept_id) && !empty($request->dept_id) ? $request->dept_id : 0),
                'mobile'        =>  (isset($request->mobile) && !empty($request->mobile) ? $request->mobile : 0),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            //user update
            $dbResult   =   DB::table('users')->where('id',$request->user_update_id)->update($userData);
            $password   =   $request->password;
            if(isset($password) && !empty($password)){
                $userPasswordData  =   [
                    'password'  =>  Hash::make($request->password),
                    'updated_at'=>  date('Y-m-d h:i:s'),
                ];
                //user update
                DB::table('users')->where('id',$request->user_update_id)->update($userPasswordData);
            }            
            $roleData  =   [
                'role_id'   =>  $request->role_id,
                'updated_at'=>  date('Y-m-d h:i:s'),
            ];
            DB::table('user_roles')->where('user_id',$request->user_update_id)->update($roleData);
            
            // If Service Staff Then the following code block will execute:
            $is_all_location=   (isset($request->all_division) && !empty($request->all_division) ? $request->all_division : 0);
            $addrDiv        =   (isset($request->addr_div_id) && !empty($request->addr_div_id) ? $request->addr_div_id : false);
            $addrDis        =   (isset($request->addr_dis_id) && !empty($request->addr_dis_id) ? $request->addr_dis_id : false);
            $addrUpz        =   (isset($request->addr_upazila_id) && !empty($request->addr_upazila_id) ? $request->addr_upazila_id : false);
            $addrunion      =   (isset($request->addr_union_id) && !empty($request->addr_union_id) ? $request->addr_union_id : false);
            $areaManger     =   (isset($request->area_manager_id) && !empty($request->area_manager_id) ? $request->area_manager_id : false);
            $is_all_location=   (isset($request->all_division) && !empty($request->all_division) ? $request->all_division : 0);
            if($addrDiv || $addrDis){
                $staffLocation  =   true;
            }
            
            if($staffLocation){  
                $user_id    =   $request->user_update_id;
                DB::table('staff_locations')->where('user_id',$user_id)->delete();
                $created_at         =   date('Y-m-d H:i:s');                
                if($is_all_location){
                    $staffLocationsData  =   [
                        'all_division'      =>  $is_all_location,
                        'user_id'           =>  $user_id,
                        'area_mng_id'       =>  $areaManger,
                        'created_at'        =>  $created_at,
                        'created_by'        =>  $created_by,
                    ];
                    //insert
                    DB::table('staff_locations')->insertGetId($staffLocationsData);
                }else{                
                    $num_of_address     =   count($addrDiv); 
                    for($nofadd = 0; $nofadd < $num_of_address; $nofadd++){
                        $staffLocationsData  =   [
                            'all_division'      =>  $is_all_location,
                            'addr_div_id'       =>  $addrDiv[$nofadd],
                            'addr_dis_id'       =>  $addrDis[$nofadd],
                            'addr_up_id'        =>  $addrUpz[$nofadd],
                            'addr_union_id'     =>  $addrunion[$nofadd],
                            'user_id'           =>  $user_id,
                            'area_mng_id'       =>  $areaManger,
                            'created_at'        =>  $created_at,
                            'created_by'        =>  $created_by,
                        ];
                        //insert
                        DB::table('staff_locations')->insertGetId($staffLocationsData);
                    }
                }                
            }
            
            return redirect('admin/user-list')->with('success', 'User have been successfully updated.');
	}
        /*
	Method Name	: delete
	Purpose		: load user delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
            $all        =   $request->all();
            $user_id    =   $request->del_id;
            $userRoll   =   getRoleNameByUserId($user_id);            
            switch($userRoll){
                case 'Agent':
                    $whereParam['table']    =   'complain_details';
                    $whereParam['field']    =   'id';
                    $whereParam['where']    =   [
                        'user_id'   =>  $user_id
                    ];
                    $totalRows              =   getTableTotalRows($whereParam);
                    if($totalRows->total){
                        $feedbackdata           =   [
                            'status'    =>  'error',               
                            'message'   =>  $userRoll. ' have data in complain details. First need to remove Complain Details.',               
                        ];
                    }else{
                        $feedbackdata           =   [
                            'status'    =>  'success',               
                        ];
                    }
                    break;
                case 'Area Manager':
                    $whereParam['table']    =   'staff_locations';
                    $whereParam['field']    =   'id';
                    $whereParam['where']    =   [
                        'area_mng_id'   =>  $user_id
                    ];
                    $totalRows              =   getTableTotalRows($whereParam);
                    if($totalRows->total){
                        $feedbackdata           =   [
                            'status'    =>  'error',               
                            'message'   =>  $userRoll. ' have Service Agency.First need to remove Service Agency.',               
                        ];
                    }else{
                        $feedbackdata           =   [
                            'status'    =>  'success',               
                        ];
                    }
                    break;
                case 'Service Staff':
                    $whereParam['table']    =   'complain_details';
                    $whereParam['field']    =   'id';
                    $whereParam['where']    =   [
                        'assign_to'   =>  $user_id
                    ];
                    $totalRows              =   getTableTotalRows($whereParam);
                    if($totalRows->total){
                        $feedbackdata           =   [
                            'status'    =>  'error',               
                            'message'   =>  $userRoll. ' have data in complain details. First need to remove Complain Details.',                
                        ];
                    }else{
                        $feedbackdata           =   [
                            'status'    =>  'success',               
                        ];
                    }
                    break;
                default :
                    $feedbackdata           =   [
                            'status'    =>  'success',               
                        ];
            }
            if($feedbackdata['status']  ==  'success'){
                $res        =   User::where('id',$request->del_id)->delete();
                if($userRoll    ==  'Service Staff'){
                    $res        =   DB::table('staff_locations')->where('user_id',$request->del_id)->delete();
                }
                if($userRoll    ==  'Area Manager'){
                    $res        =   DB::table('staff_locations')->where('area_mng_id',$request->del_id)->delete();
                }
                $feedback   =   [
                    'status'    => 'success',
                    'message'   => 'Data have successfully deleted.',
                    'data'      =>  ''
                ];
                echo json_encode($feedback);
            }else{
                echo json_encode($feedbackdata);
            }
	}
        /*
            Method Name         : get_department_wise_user
            Purpose		: load user by department from an ajax call
            Param		: department id need
            Date		: 07/08/2019
            Author		: Tanveer Qureshee
        */    
        function get_department_wise_user(Request $request){
            
            
            $user_ids    =   [];
            $user_datas  =   [];
            
            
            
            //Get all location users:
            
            $allLocationUsers = DB::table('users as u')
                ->select('u.id as user_id', 'u.name as user_name', 'u.email')
                ->join('user_roles as ur', 'u.id', '=', 'ur.user_id')
                ->join('staff_locations as sl', 'u.id', '=', 'sl.user_id')
                ->where('u.division_id',$request->division_id)
                ->where('sl.all_division',1)
                ->get();
            
            
            $usersData   = DB::table('users as u')
                ->select('u.id as user_id', 'u.name as user_name', 'u.email')
                ->join('user_roles as ur', 'u.id', '=', 'ur.user_id')
                ->join('staff_locations as sl', 'u.id', '=', 'sl.user_id')
                ->where('u.division_id',$request->division_id)
                ->where('u.department_id',$request->department_id)
                ->where('sl.addr_div_id',$request->addr_div_id)
                ->where('sl.addr_dis_id',$request->addr_dis_id)
                ->where('sl.addr_up_id',$request->addr_up_id)
                ->where('ur.role_id',4)
                ->get();
            
            
            if(!$usersData->isEmpty()){
                
                foreach($usersData as $udata){
                    
                    array_push($user_ids, $udata->id);                   
                    array_push($user_datas, $udata);                 
                        
                }
                
            }
            
            
            if(!$allLocationUsers->isEmpty()){
                
                foreach($allLocationUsers as $udata){
                    
                    if(!in_array($udata->id, $user_ids)){
                        array_push($user_ids, $udata->id);
                        array_push($user_datas, $udata);   
                    
                    } 
                    
                }
                
            }
            
            
            
            $users_view        =   View::make('scmsp.backend.partial.get_users_by_department', compact('user_datas'));
            $feedback = [
                    'status'    => 'success',
                    'message'   => 'Data found',
                    'data'      => $users_view->render(),
                ];
            echo json_encode($feedback);
        }
        
        
        /*
            Method Name         : get_user_data_by_division_role
            Purpose		: load user by department from an ajax call
            Param		: department id need
            Date		: 16/03/2021
            Author		: Tanveer Qureshee
        */    
        function get_user_data_by_division_role(Request $request){
            $usersDataSql   = DB::table('users as u')
                ->join('user_roles as ur', 'u.id', '=', 'ur.user_id')
                ->select('u.*', 'ur.role_id');
            
            if(isset($request->division_id) && !empty($request->division_id)){
                $usersDataSql->where('u.division_id',$request->division_id);
            }
            if(isset($request->role_id) && !empty($request->role_id)){
                $usersDataSql->where('ur.role_id',$request->role_id);
            }
            
            $usersData          =   $usersDataSql->get();
            
            $users_view        =   View::make('scmsp.backend.partial.user_data_view_by_division_role', compact('usersData'));
            $feedback = [
                    'status'    => 'success',
                    'message'   => 'Data found',
                    'data'      => $users_view->render(),
                ];
            echo json_encode($feedback);
        }
        
        public function user_profile(){
            $usersData          =   "";
            $staffLocations     =   "";
            $role   =   getRoleNameByUserId(Auth::user()->id);
            if($role== 'Admin' || $role=='Agent'){
                $user_id        =   Auth::user()->id;
                $usersData      =   DB::table('users')->where('id', $user_id)->first();
                $staffLocations =   DB::table('staff_locations')->where('user_id', $user_id)->first();
                
            }else{
                $user_id        =   Auth::user()->id;
                $usersData      =   DB::table('users')->where('id', $user_id)->first();
                $staffLocations =   DB::table('staff_locations')->where('user_id', $user_id)->first();
                
            }
            
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'user-profile';
            return View('scmsp.backend.general_user_profile', compact('usersData','staffLocations','subMenuClass', 'role'));
            
        }
        
        public function general_user_update(Request $request){
            $all    =   $request->all();
            $updated    =   false;
            if(isset($request->mobile) && !empty($request->mobile)){
                $userData  =   [
                    'mobile'        =>  $request->mobile,
                    'updated_at'    =>  date('Y-m-d H:i:s'),
                ];
                //user update
                $dbResult   =   DB::table('users')->where('id',$request->user_update_id)->update($userData);
                $updated    =   true;
            }
            
            $password   =   $request->password;
            if(isset($password) && !empty($password)){
                $userPasswordData  =   [
                    'password'  =>  Hash::make($request->password),
                    'updated_at'=>  date('Y-m-d h:i:s'),
                ];
                //user update
                DB::table('users')->where('id',$request->user_update_id)->update($userPasswordData);
                $updated    =   true;
            }    
            
            if($updated){
                $status     =   'success';
                $message    =   'Data have been successfully Updated';
            }else{
                $status     =   'error';
                $message    =   'Noting there to update';
            }
            
            return redirect('admin/user-profile')->with($status, $message);
        }
}
