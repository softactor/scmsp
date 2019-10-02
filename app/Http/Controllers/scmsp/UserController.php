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
//            $list   = User::orderBy('name', 'desc')->get();
            $list = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*', 'user_roles.role_id')
            ->get();
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
                /* selected menue data */
                $activeMenuClass    =   'users';   
                $subMenuClass       =   'users-list';
		return View('scmsp.backend.user.create', compact('list','activeMenuClass','subMenuClass'));
	}
        /*
	Method Name	: edit
	Purpose		: load user edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*', 'user_roles.role_id')
                    ->where('users.id', $request->user_edit_id)
            ->first();
            /* selected menue data */
                $activeMenuClass    =   'users';   
                $subMenuClass       =   'users-list';
            return View('scmsp.backend.user.edit', compact('editData','activeMenuClass','subMenuClass'));
	}
        /*
            Method Name	: store
            Purpose		: load user store
            Param		: no param need
            Date		: 05/08/2019
            Author		: Tanveer Qureshee
	*/
	public function store(Request $request){
            $staffLocation  =   false;
            $rules  =   [
                'name'      => 'required',
                'email'     => 'required',
                'password'  => 'required',
                'role_id'   => 'required',
            ];
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
            
            $addrDiv    =   (isset($request->addr_div_id) && !empty($request->addr_div_id) ? $request->addr_div_id : false);
            $addrDis    =   (isset($request->addr_dis_id) && !empty($request->addr_dis_id) ? $request->addr_dis_id : false);
            $addrUpz    =   (isset($request->addr_upazila_id) && !empty($request->addr_upazila_id) ? $request->addr_upazila_id : false);
            $addrunion  =   (isset($request->addr_union_id) && !empty($request->addr_union_id) ? $request->addr_union_id : false);
            $areaManger =   (isset($request->area_manager_id) && !empty($request->area_manager_id) ? $request->area_manager_id : false);
            if($addrDiv || $addrDis){
                $staffLocation  =   true;
            }
            
            if($staffLocation){
                $staffLocationsData  =   [
                    'addr_div_id'   =>  $addrDiv,
                    'addr_dis_id'   =>  $addrDis,
                    'addr_up_id'    =>  $addrUpz,
                    'addr_union_id' =>  $addrunion,
                    'user_id'       =>  $user_id,
                    'area_mng_id'   =>  $areaManger,
                    'created_at'    =>  date('Y-m-d H:i:s'),
                    'created_by'    =>  1,
                ];
            //insert
            $user_id   =   DB::table('staff_locations')->insertGetId($staffLocationsData);
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
		$rules  =   [
                'name'      => 'required',
                'email'     => 'required',
                'role_id'   => 'required',
            ];
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
            return redirect('admin/user-list')->with('success', 'User have been successfully updated.');
	}
        /*
	Method Name	: delete
	Purpose		: load user delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "User Delete";
	}
        /*
            Method Name         : get_department_wise_user
            Purpose		: load user by department from an ajax call
            Param		: department id need
            Date		: 07/08/2019
            Author		: Tanveer Qureshee
        */    
        function get_department_wise_user(Request $request){
            $usersData   = DB::table('users as u')
                ->select('u.id as user_id', 'u.name as user_name', 'u.email')
                ->join('user_roles as ur', 'u.id', '=', 'ur.user_id')
                ->join('staff_locations as sl', 'u.id', '=', 'sl.user_id')
                ->where('u.division_id',$request->division_id)
                ->where('u.department_id',$request->department_id)
                ->where('sl.addr_div_id',$request->addr_div_id)
                ->where('sl.addr_dis_id',$request->addr_dis_id)
                ->where('sl.addr_up_id',$request->addr_up_id)
                ->where('sl.addr_union_id',$request->addr_union_id)
                ->where('ur.role_id',4)
                ->get();
            $users_view        =   View::make('scmsp.backend.partial.get_users_by_department', compact('usersData'));
            $feedback = [
                    'status'    => 'success',
                    'message'   => 'Data found',
                    'data'      => $users_view->render(),
                ];
            echo json_encode($feedback);
        }
}
