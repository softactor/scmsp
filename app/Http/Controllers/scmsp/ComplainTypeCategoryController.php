<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\complainTypeCategory\ComplainTypeCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ComplainTypeCategoryController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load department list
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list               =   ComplainTypeCategory::orderBy('name', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'complain-type-category-list';
            return View('scmsp.backend.complain_type_category.list', compact('list','activeMenuClass','subMenuClass'));
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
            $subMenuClass       =   'complain-type-category-list';
            return View('scmsp.backend.complain_type_category.create', compact('activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: edit
	Purpose		: load department edit
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData           = ComplainTypeCategory::find($request->id);
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'complain-type-category-list';
            return View('scmsp.backend.complain_type_category.edit', compact('editData','activeMenuClass','subMenuClass'));
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
        $checkParam['table'] = "complain_type_categories";
        $checkWhereParam = [
            ['dept_id', '=', $request->dept_id],
            ['div_id',  '=', $request->div_id],
            ['name',    '=', $request->name],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/complain-type-category-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name'      => 'required',
                'dept_id'   => 'required',
                'div_id'    => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-type-category-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $department             =   new ComplainTypeCategory;
            $department->dept_id    =   $request->dept_id;
            $department->div_id     =   $request->div_id;
            $department->name       =   $request->name;
            $department->user_id    =   Auth::user()->id;
            $department->save();
            return redirect('admin/complain-type-category-list')->with('success', 'Data have been successfully saved.');
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
        $checkParam['table'] = "complain_type_categories";
        $checkWhereParam = [
            ['dept_id', '=', $request->dept_id],
            ['div_id',  '=', $request->div_id],
            ['name',    '=', $request->name],
            ['id', '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/complain-type-category-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name'      => 'required',
                'dept_id'   => 'required',
                'div_id'    => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-type-category-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $department             =   ComplainTypeCategory::find($request->edit_id);
            $department->name       =   $request->name;
            $department->dept_id    =   $request->dept_id;
            $department->div_id     =   $request->div_id;
            $department->user_id    =   Auth::user()->id;
            $department->save();
            return redirect('admin/complain-type-category-list')->with('success', 'Data have been successfully updated.');
	}
        
         /*
	Method Name	: delete
	Purpose		: load department delete
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   ComplainTypeCategory::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}      
        
        /*
            Method Name         : get_department_wise_user
            Purpose		: load user by department from an ajax call
            Param		: department id need
            Date		: 07/08/2019
            Author		: Tanveer Qureshee
        */    
        function get_category_by_department(Request $request){
            $categoryData   = DB::table('complain_type_categories')
                    ->where('dept_id', $request->division_id)
                    ->where('div_id', $request->department_id)
                    ->get();
            $category_view        =   View::make('scmsp.backend.partial.get_category_by_department', compact('categoryData'));
            $feedback = [
                    'status'    => 'success',
                    'message'   => 'Data found',
                    'data'      => $category_view->render(),
                ];
            echo json_encode($feedback);
        }
}
