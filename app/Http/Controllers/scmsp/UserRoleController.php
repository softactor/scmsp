<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\userRole\UserRole;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load User Role list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list   = UserRole::orderBy('user_id', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'user-role-list';
            return View('scmsp.backend.user_role.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load User Role create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.user_role.create');
	}
        /*
	Method Name	: edit
	Purpose		: load User Role edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData   = UserRole::find($request->id);
            return View('scmsp.backend.user_role.edit', compact('editData'));
	}
        /*
	Method Name	: store
	Purpose		: load User Role store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(Request $request){
		//$all    =   $request->all();
            /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
        $checkParam['table'] = "user_roles";
        $checkWhereParam = [
            ['user_id',    '=', $request->user_id],
            ['role_id',    '=', $request->role_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/user-role-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'user_id' => 'required',
                'role_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/user-role-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user_role             =   new UserRole;
            $user_role->user_id       =   $request->user_id;
            $user_role->role_id       =   $request->role_id;
            $user_role->save();
            return redirect('admin/user-role-list')->with('success', 'Data have been successfully saved.');
	}
        
        /*
	Method Name	: update
	Purpose		: load User Role update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
        
        $checkParam['table'] = "user_roles";
        $checkWhereParam = [
            ['user_id',    '=', $request->user_id],
            ['role_id',    '=', $request->role_id],
            ['id',         '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/user-role-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'user_id' => 'required',
                'role_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/user-role-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user_role                =   UserRole::find($request->edit_id);
            $user_role->user_id       =   $request->user_id;
            $user_role->role_id       =   $request->role_id;
            $user_role->save();
            return redirect('admin/user-role-list')->with('success', 'Data have been successfully saved.');
	}
        /*
	Method Name	: delete
	Purpose		: load User Role delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   UserRole::where('id',$request->del_id)->delete();
                $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
}
