<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\complainStatus\ComplainStatus;
use Illuminate\Support\Facades\Auth;

class ComplainStatusController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load complain status list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
                $list   = ComplainStatus::orderBy('name', 'desc')->get();
                /* selected menue data */
                $activeMenuClass    =   'settings';   
                $subMenuClass       =   'complain-status-list';
                return View('scmsp.backend.complain_status.list', compact('list','activeMenuClass','subMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load complain status create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.complain_status.create');
	}
        /*
	Method Name	: edit
	Purpose		: load complain status edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
                $editData   = ComplainStatus::find($request->id);
                return View('scmsp.backend.complain_status.edit', compact('editData'));
	}
        /*
	Method Name	: store
	Purpose		: load complain status store
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
        $checkParam['table'] = "complain_statuses";
        $checkWhereParam = [
            ['name',    '=', $request->name],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/complain-status-create')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:complain_statuses,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-status-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complain_status             =   new ComplainStatus;
            $complain_status->name       =   $request->name;
            $complain_status->user_id    =   Auth::user()->id;
            $complain_status->save();
            return redirect('admin/complain-status-list')->with('success', 'Data have been successfully saved.');
	}
        
        /*
	Method Name	: update
	Purpose		: load complain status update
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
        $checkParam['table'] = "complain_statuses";
        $checkWhereParam = [
            ['name',    '=', $request->name],
            ['id',      '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/complain-status-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:complain_statuses,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-status-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complain_status             =   ComplainStatus::find($request->edit_id);
            $complain_status->name       =   $request->name;
            $complain_status->user_id    =   Auth::user()->id;
            $complain_status->save();
            return redirect('admin/complain-status-list')->with('success', 'Data have been successfully saved.');
	}
        /*
	Method Name	: delete
	Purpose		: load complain status delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   ComplainStatus::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
}
