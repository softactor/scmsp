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
            $list   = Department::orderBy('name', 'desc')->get();
            return View('scmsp.backend.department.list', compact('list'));
	}
        
        /*
	Method Name	: create
	Purpose		: load department create
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.department.create');
	}
        
        /*
	Method Name	: edit
	Purpose		: load department edit
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.department.edit');
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
            return redirect('admin/department-list');
	}
        
        /*
	Method Name	: update
	Purpose		: load department update
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "Department Update";
	}
        
         /*
	Method Name	: delete
	Purpose		: load department delete
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "Department Delete";
	}
}
