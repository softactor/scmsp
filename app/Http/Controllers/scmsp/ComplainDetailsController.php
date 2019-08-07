<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\complainDetails\ComplainDetails;
use Illuminate\Support\Facades\Auth;
use App\Model\scmsp\backend\complainType\ComplainType;
use App\Model\scmsp\backend\complainStatus\ComplainStatus;
use Illuminate\Support\Facades\DB;

class ComplainDetailsController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load complain details list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $role   =   getRoleNameByUserId(Auth::user()->id);
            if($role== 'Admin' || $role=='Moderator'){
                $list   = ComplainDetails::orderBy('created_at', 'desc')->get();
            }else{
                $list   = ComplainDetails::where('assign_to',Auth::user()->id)->orderBy('created_at', 'desc')->get();
            }
            /* selected menue data */
            $activeMenuClass    =   'complain-details';   
            return View('scmsp.backend.complain_details.list', compact('list','activeMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load complain details create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
            $activeMenuClass    =   'complain-details';
            return View('scmsp.backend.complain_details.create', compact('activeMenuClass'));
	}
        /*
	Method Name	: edit
	Purpose		: load complain details edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
            $editData   = ComplainDetails::find($request->id);
            $activeMenuClass    =   'complain-details';
            $role   =   getRoleNameByUserId(Auth::user()->id);
            if($role== 'Admin' || $role=='Moderator'){
                return View('scmsp.backend.complain_details.edit',  compact('editData','activeMenuClass'));
            }else{
                return View('scmsp.backend.complain_details.edit_technician',  compact('editData','activeMenuClass'));
            }
            
                
	}
        /*
	Method Name	: store
	Purpose		: load complain details store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(Request $request){
            $rules  =   [
                'complain_type_id'  => 'required',
                'complainer'        => 'required',
                'complain_details'  => 'required',
                'complain_date'     => 'required',
                'complain_status'   => 'required',
                'div_id'            => 'required',
                'dept_id'           => 'required',
                'assign_to'         => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-details-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complain_details                      =   new ComplainDetails;
            $complain_details->complain_type_id    =   $request->complain_type_id;
            $complain_details->complainer          =   $request->complainer;
            $complain_details->complain_details    =   $request->complain_details;
            $complain_details->issued_date         =   $request->complain_date;
            $complain_details->division_id         =   $request->div_id;
            $complain_details->department_id       =   $request->dept_id;
            $complain_details->complain_status     =   $request->complain_status;
            $complain_details->user_id             =   Auth::user()->id;
            $complain_details->assign_to           =   $request->assign_to;
            $complain_details->save();
            $complain_id                           =   $complain_details->id;
            
            $detailsHistoryData                    =    [
                'complain_id'   =>  $complain_id,
                'descriptions'  =>  $request->complain_details,
                'created_by'    =>  Auth::user()->id,
                'assign_to'     =>  $request->assign_to,
                'current_status'=>  $request->complain_status,
                'created_at'    =>  date('Y-m-d h:i:s')
            ];
            DB::table('complain_details_history')->insert($detailsHistoryData);
            return redirect('admin/complain-details-list')->with('success', 'Complain have been successfully created.');
	}
        
        /*
	Method Name	: update
	Purpose		: load complain details update
	Param		: no param need
	Date		: 07/08/2019
	Author		: Tanveer Qureshee
	*/
       public function update(Request $request) {
            $rules = [
                'complain_type_id'  => 'required',
                'complainer'        => 'required',
                'complain_details'  => 'required',
                'complain_date'     => 'required',
                'complain_status'   => 'required',
                'div_id'            => 'required',
                'dept_id'           => 'required',
                'assign_to'         => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-details-edit/' . $request->edit_id)
                                ->withInput()
                                ->with('error', 'Failed to update data. Pleae fix the validation.')
                                ->withErrors($validator);
            }

            $complain_details                       = ComplainDetails::find($request->edit_id);
            $complain_details->complain_type_id     = $request->complain_type_id;
            $complain_details->complainer           = $request->complainer;
            $complain_details->complain_details     = $request->complain_details;
            $complain_details->issued_date          = $request->complain_date;
            $complain_details->division_id          = $request->div_id;
            $complain_details->department_id        = $request->dept_id;
            $complain_details->complain_status      = $request->complain_status;
            $complain_details->assign_to            = $request->assign_to;
            $complain_details->save();
            
            $detailsHistoryData                    =    [
                'complain_id'   =>  $request->edit_id,
                'descriptions'  =>  $request->complain_details,
                'assign_to'     =>  $request->assign_to,
                'current_status'=>  $request->complain_status,
                'created_at'    =>  date('Y-m-d h:i:s'),
                'updated_at'    =>  date('Y-m-d h:i:s')
            ];
            DB::table('complain_details_history')->insert($detailsHistoryData);
            return redirect('admin/complain-details-list')->with('success', 'Complain have been successfully Updated.');
        }

    /*
	Method Name	: delete
	Purpose		: load complain details delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
		$res        =   ComplainDetails::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
        
        public function autocomplete(Request $request)
        {
            $data = Search::select("complainer")
                    ->where("complainer","LIKE","%{$request->input('query')}%")
                    ->get();
            
            if(count($data))
                return $data;
            else
                return ['No Result Found'];

            return response()->json($data);
        }
}
