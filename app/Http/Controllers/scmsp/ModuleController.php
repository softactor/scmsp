<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\module\Module;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load role list
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list   = Module::orderBy('name', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'settings';   
            $subMenuClass       =   'module-list';
            return View('scmsp.backend.module.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load role create
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.module.create');
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
        $checkParam['table'] = "modules";
        $checkWhereParam = [
            ['name',    '=', $request->name],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/module-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:modules,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/module-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $module             =   new Module;
            $module->name       =   $request->name;
            $module->user_id    =   Auth::user()->id;
            $module->save();
            return redirect('admin/module-list')->with('success', 'Data have been successfully saved.');
	}
        
        /*
	Method Name	: edit
	Purpose		: load role edit
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData   = Module::find($request->id);
            return View('scmsp.backend.module.edit', compact('editData'));
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
        $checkParam['table'] = "modules";
        $checkWhereParam = [
            ['name',    '=', $request->name],
            ['id', '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/module-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:modules,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/module-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $module             =   Module::find($request->edit_id);
            $module->name       =   $request->name;
            $module->user_id    =   Auth::user()->id;
            $module->save();
            return redirect('admin/module-list')->with('success', 'Data have been successfully saved.');
	}
        
        
        /*
	Method Name	: delete
	Purpose		: load role delete
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   Module::where('id',$request->del_id)->delete();
                $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
}
