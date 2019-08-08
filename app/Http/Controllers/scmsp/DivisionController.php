<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\division\Division;
use Illuminate\Support\Facades\Auth;
use App\Model\scmsp\backend\department\Department;
use Illuminate\Support\Facades\View;

class DivisionController extends Controller
{
        /*
	Method Name	: index
	Purpose		: load division list
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list   = Division::orderBy('name', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'department-list';
            return View('scmsp.backend.division.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load division create
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'department-list';
            return View('scmsp.backend.division.create', compact('activeMenuClass','subMenuClass'));
	}
        /*
	Method Name	: edit
	Purpose		: load division edit
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData   = Division::find($request->id); 
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'department-list';
            return View('scmsp.backend.division.edit',  compact('editData','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: store
	Purpose		: load division store
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
        $checkParam['table'] = "divisions";
        $checkWhereParam = [
            ['dept_id', '=', $request->dept_id],
            ['name',    '=', $request->name],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/division-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.')
                            ->with('dept_id', $request->dept_id);
        }// end of duplicate checking:

        $rules  =   [
                'name' => 'required',
                'dept_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/division-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $division             =   new Division;
            $division->dept_id    =   $request->dept_id;
            $division->name       =   $request->name;
            $division->user_id    =   Auth::user()->id;
            $division->save();
            return redirect('admin/division-list')->with('success', 'Data have been successfully saved.');
        }
        /*
	Method Name	: update
	Purpose		: load division update
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
       public function update(Request $request) {
            $checkParam['table'] = "divisions";
            $checkWhereParam = [
                ['dept_id', '=', $request->dept_id],
                ['name', '=', $request->name],
                ['id', '!=', $request->edit_id],
            ];
            $checkParam['where'] = $checkWhereParam;
            $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
            // check is it duplicate or not
            if ($duplicateCheck) {
                return redirect('admin/division-edit/'.$request->edit_id)
                                ->withInput()
                                ->with('error', 'Failed to save data. Duplicate Entry found.');
            }// end of duplicate checking:

            $rules = [
                'name' => 'required',
                'dept_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/division-edit/'.$request->edit_id)
                                ->withInput()
                                ->with('error', 'Failed to update data. Pleae fix the validation.')
                                ->withErrors($validator);
            }

            $division = Division::find($request->edit_id);
            $division->dept_id = $request->dept_id;
            $division->name = $request->name;
            $division->user_id = Auth::user()->id;
            $division->save();
            return redirect('admin/division-list')->with('success', 'Data have been successfully updated.');
        }

    /*
	Method Name	: delete
	Purpose		: load division delete
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
    */
	public function delete(Request $request){
            $res        =   Division::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
    /*
	Method Name	: get_department_by_division
	Purpose		: load department by division from an ajax call
	Param		: department id need
	Date		: 07/08/2019
	Author		: Tanveer Qureshee
    */    
    function get_department_by_division(Request $request){
        $departmentdata         =   Division::where('dept_id',$request->dept_id)->get();
        $department_view        =   View::make('scmsp.backend.partial.get_department_by_division', compact('departmentdata'));
        $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $department_view->render(),
            ];
        echo json_encode($feedback);
    }
}
