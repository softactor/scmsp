<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\role\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
        /*
	Method Name	: index
	Purpose		: load role list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list   = Role::orderBy('name', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'role-list';
            return View('scmsp.backend.role.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load role create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
            /* selected menue data */
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'role-list';
            return View('scmsp.backend.role.create', compact('activeMenuClass','subMenuClass'));
	}
        /*
	Method Name	: edit
	Purpose		: load role edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData   = Role::find($request->id);
            /* selected menue data */
            $activeMenuClass    =   'users';   
            $subMenuClass       =   'role-list';
            return View('scmsp.backend.role.edit', compact('editData','activeMenuClass','subMenuClass'));
	}
         /*
	Method Name	: store
	Purpose		: load role store
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
            return redirect('admin/role-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:roles,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/role-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $role             =   new Role;
            $role->name       =   $request->name;
            $role->user_id    =   Auth::user()->id;
            $role->save();
            return redirect('admin/role-list')->with('success', 'Data have been successfully saved.');
	}
          /*
	Method Name	: update
	Purpose		: load role update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
		 //$all    =   $request->all();
            /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
        $checkParam['table'] = "roles";
        $checkWhereParam = [
            ['name',    '=', $request->name],
            ['id', '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/role-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:roles,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/role-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $role             =   Role::find($request->edit_id);
            $role->name       =   $request->name;
            $role->user_id    =   Auth::user()->id;
            $role->save();
            return redirect('admin/role-list')->with('success', 'Data have been successfully saved.');
	}
        /*
	Method Name	: delete
	Purpose		: load role delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   Role::where('id',$request->del_id)->delete();
                $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
        
        
}
