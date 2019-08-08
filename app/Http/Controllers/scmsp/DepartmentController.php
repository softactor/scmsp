<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\department\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load department list
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list               =   Department::orderBy('name', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'division-list';
            return View('scmsp.backend.department.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load department create
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'division-list';
            return View('scmsp.backend.department.create', compact('activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: edit
	Purpose		: load department edit
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData   = Department::find($request->id);
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'division-list';
            return View('scmsp.backend.department.edit', compact('editData','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: store
	Purpose		: load department store
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function store(Request $request){
            //$all    =   $request->all();
            /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
        $checkParam['table'] = "departments";
        $checkWhereParam = [
            ['name',    '=', $request->name],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/department-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:departments,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/department-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $department             =   new Department;
            $department->name       =   $request->name;
            $department->user_id    =   Auth::user()->id;
            $department->save();
            return redirect('admin/department-list')->with('success', 'Data have been successfully saved.');
	}
        
        /*
	Method Name	: update
	Purpose		: load department update
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
		//$all    =   $request->all();
            /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
        $checkParam['table'] = "departments";
        $checkWhereParam = [
            ['name',    '=', $request->name],
            ['id', '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/department-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:departments,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/department-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $department             =   Department::find($request->edit_id);
            $department->name       =   $request->name;
            $department->user_id    =   Auth::user()->id;
            $department->save();
            return redirect('admin/department-list')->with('success', 'Data have been successfully updated.');
	}
        
         /*
	Method Name	: delete
	Purpose		: load department delete
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   Department::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
}
