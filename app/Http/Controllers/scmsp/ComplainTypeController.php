<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\complainType\ComplainType;
use Illuminate\Support\Facades\Auth;

class ComplainTypeController extends Controller {
	
	/*
	Method Name	: index
	Purpose		: load complain type list
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
                $list   = ComplainType::orderBy('name', 'desc')->get();
                return View('scmsp.backend.complain_type.list', compact('list'));
	}
	
	
	/*
	Method Name	: create
	Purpose		: load complain type create
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.complain_type.create');
	}
	
	
	/*
	Method Name	: edit
	Purpose		: load complain type edit
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
                $editData   = ComplainType::find($request->id);
                return View('scmsp.backend.complain_type.edit', compact('editData'));
	}
	
	/*
	Method Name	: store
	Purpose		: load complain type store
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
    public function store(Request $request){
        //$all    =   $request->all();
         /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
        $checkParam['table'] = "complain_types";
        $checkWhereParam = [
            ['name',       '=', $request->name],
            ['dept_id',    '=', $request->dept_id],
            ['div_id',     '=', $request->div_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/create-complain-type')
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name' => 'required|unique:complain_types,name'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/create-complain-type')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complain_type             =   new ComplainType;
            $complain_type->name       =   $request->name;
            $complain_type->dept_id    =   $request->dept_id;
            $complain_type->div_id     =   $request->div_id;
            $complain_type->user_id    =   Auth::user()->id;
            $complain_type->save();
            return redirect('admin/complain-type-list')->with('success', 'Data have been successfully saved.');
	}
	
	/*
	Method Name	: update
	Purpose		: load complain type update
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
			//$all    =   $request->all();
            /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
        $checkParam['table'] = "complain_types";
        $checkWhereParam = [
            ['name',    '=', $request->name],
            ['dept_id', '=', $request->dept_id],
            ['div_id',  '=', $request->div_id],
            ['id',      '!=', $request->edit_id],
        ];
        $checkParam['where'] = $checkWhereParam;
        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/complain-type-edit/'.$request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }// end of duplicate checking:
            $rules  =   [
                'name'    => 'required|unique:complain_types,name',
                'dept_id' => 'required|unique:complain_types,dept_id',
                'div_id'  => 'required|unique:complain_types,div_id',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-type-edit/'.$request->edit_id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complain_type             =   ComplainType::find($request->edit_id);
            $complain_type->name       =   $request->name;
            $complain_type->dept_id    =   $request->dept_id;
            $complain_type->div_id     =   $request->div_id;
            $complain_type->user_id    =   Auth::user()->id;
            $complain_type->save();
            return redirect('admin/complain-type-list')->with('success', 'Data have been successfully saved.');
	}
        
        public function delete(Request $request){
		$res        =   ComplainType::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
}
