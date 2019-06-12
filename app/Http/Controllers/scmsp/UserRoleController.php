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
		return View('scmsp.backend.user_role.list');
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
	public function edit(){
		return View('scmsp.backend.user_role.edit');
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
        $checkParam['table'] = "roles";
        $checkWhereParam = [
            ['name',    '=', $request->name],
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
                'name' => 'required|unique:roles,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/user-role-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user_role             =   new UserRole;
            $user_role->name       =   $request->name;
            $user_role->user_id    =   Auth::user()->id;
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
	public function update(){
		echo "User Role Update";
	}
        /*
	Method Name	: delete
	Purpose		: load User Role delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "User Role Delete";
	}
}
