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
	public function index($complain_status = null){
            $role   =   getRoleNameByUserId(Auth::user()->id);
            if($role== 'Admin' || $role=='Agent'){
                if(isset($complain_status) && !empty($complain_status)){
                    $list   = ComplainDetails::where('complain_status',$complain_status)->orderBy('created_at', 'DESC')->get();
                }else{
                    $list   = ComplainDetails::orderBy('created_at', 'DESC')->get();
                }
            }else{
                if(isset($complain_status) && !empty($complain_status)){
                    $list   = ComplainDetails::where('complain_status',$complain_status)->where('assign_to',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
                }else{
                    $list   = ComplainDetails::where('assign_to',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
                }
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
            if($role== 'Admin' || $role=='Agent'){
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
                'category_id'       => 'required',
                'complain_type_id'  => 'required',
                'complainer'        => 'required',
                'complain_details'  => 'required',
                'div_id'            => 'required',
                'dept_id'           => 'required',
                'assign_to'         => 'required',
                'priority_id'       => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/complain-details-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complainerCode                        =   getComplainCode((isset($request->complain_date) && !empty($request->complain_date) ? $request->complain_date : date('Y-m-d')));
            $complain_details                      =   new ComplainDetails;
            $complain_details->complainer_code     =   $complainerCode;
            $complain_details->category_id         =   $request->category_id;
            $complain_details->complain_type_id    =   $request->complain_type_id;
            $complain_details->complainer          =   $request->complainer;
            $complain_details->name                =   $request->complainer_name;
            $complain_details->address             =   $request->complainer_address;
            $complain_details->complain_details    =   $request->complain_details;
            $complain_details->issued_date         =   (isset($request->complain_date) && !empty($request->complain_date) ? $request->complain_date : date('Y-m-d H:i:s'));
            $complain_details->division_id         =   $request->div_id;
            $complain_details->department_id       =   $request->dept_id;
            $complain_details->complain_status     =   1;
            $complain_details->user_id             =   Auth::user()->id;
            $complain_details->assign_to           =   $request->assign_to;
            $complain_details->priority_id         =   $request->priority_id;
            $complain_details->save();
            $complain_id                           =   $complain_details->id;
            
            $detailsHistoryData                    =    [
                'complain_id'   =>  $complain_id,
                'descriptions'  =>  $request->complain_details,
                'created_by'    =>  Auth::user()->id,
                'updated_by'    =>  Auth::user()->id,
                'assign_to'     =>  $request->assign_to,
                'current_status'=>  1,
                'created_at'    =>  date('Y-m-d H:i:s')
            ];           
            $lastHistoryId  =   DB::table('complain_details_history')->insertGetId($detailsHistoryData);
            if(get_settings_value('send_sms')){
                //Customer SMS Part:
                if(isset($request->complainer) && !empty($request->complainer)){
                    $cusparam       =   [
                        'complainerCode'=>  $complainerCode,
                        'contacts'      =>  $request->complainer,
                    ];
                    $cusSmsParam    =   get_customer_message($cusparam);
                    $sms_response   =   sending_sms($cusSmsParam);
                    $historyUpdateParam     =   [
                        'is_sms_send'   =>  1,
                        'sms_response'  =>  $sms_response,
                    ];
                    DB::table('complain_details_history')->where('id', $lastHistoryId)->update($historyUpdateParam);
                }else{
                    $historyUpdateParam     =   [
                        'is_sms_send'   =>  0,
                        'sms_response'  =>  'Mobile number not found',
                    ];
                    DB::table('complain_details_history')->where('id', $lastHistoryId)->update($historyUpdateParam);
                }
                //Technitian Staff SMS Part:
                $tecnitianMobile    =   get_user_mobile_number_by_id($request->assign_to);
                if(isset($tecnitianMobile) && !empty($tecnitianMobile)){
                    $staffParam       =   [
                        'complainerName'    =>  $request->complainer_name,
                        'complainerMobile'  =>  $request->complainer,
                        'complainerCode'    =>  $complainerCode,
                        'contacts'          =>  $tecnitianMobile,
                    ];
                    $staffSmsParam  =   get_service_staff_message($staffParam);
                    $sms_response   =   sending_sms($staffSmsParam);
                    $historyUpdateParam     =   [
                        'is_sms_send'   =>  1,
                        'sms_response'  =>  $sms_response,
                    ];
                    DB::table('complain_details_history')->where('id', $lastHistoryId)->update($historyUpdateParam);
                }else{
                    $historyUpdateParam     =   [
                        'is_sms_send'   =>  0,
                        'sms_response'  =>  'Mobile number not found',
                    ];
                    DB::table('complain_details_history')->where('id', $lastHistoryId)->update($historyUpdateParam);
                }                
            }
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
        $role = getRoleNameByUserId(Auth::user()->id);
        if ($role == 'Admin' || $role == 'Agent') {
            $rules = [
                'category_id' => 'required',
                'complain_type_id' => 'required',
                'complainer' => 'required',
                'complain_details' => 'required',
                'complain_date' => 'required',
                'complain_status' => 'required',
                'div_id' => 'required',
                'dept_id' => 'required',
                'assign_to' => 'required',
                'priority_id' => 'required',
            ];
        } else {
            $rules = [
                'feedback_details' => 'required',
                'complain_status' => 'required',
            ];
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/complain-details-edit/' . $request->edit_id)
                            ->withInput()
                            ->with('error', 'Failed to update data. Pleae fix the validation.')
                            ->withErrors($validator);
        }

        $complain_details = ComplainDetails::find($request->edit_id);
        $complainerCode = $complain_details->complainer_code;
        $complainerPhone = $complain_details->complainer;
        if ($role == 'Admin' || $role == 'Agent') {
            $complain_details->category_id = $request->category_id;
            $complain_details->complain_type_id = $request->complain_type_id;
            $complain_details->complainer = $request->complainer;
            $complain_details->complain_details = $request->complain_details;
            $complain_details->issued_date = $request->complain_date;
            $complain_details->division_id = $request->div_id;
            $complain_details->department_id = $request->dept_id;
            $complain_details->complain_status = $request->complain_status;
            $complain_details->assign_to = $request->assign_to;
            $complain_details->priority_id = $request->priority_id;
            $complain_details->updated_at = date('Y-m-d H:i:s');
            $descriptions = $request->complain_details;
        } else {
            $complain_details->feedback_details = $request->feedback_details;
            $complain_details->updated_at = date("Y-m-d H:i:s");
            $complain_details->complain_status = $request->complain_status;
            $descriptions = $request->feedback_details;
        }
        $complain_details->save();

        $detailsHistoryData = [
            'complain_id' => $request->edit_id,
            'descriptions' => $descriptions,
            'assign_to' => (isset($request->assign_to) && !empty($request->assign_to) ? $request->assign_to : $complain_details->assign_to),
            'updated_by' => Auth::user()->id,
            'current_status' => $request->complain_status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $lastHistoryId = DB::table('complain_details_history')->insertGetId($detailsHistoryData);
        $complain_status = get_data_name_by_id('complain_statuses', $request->complain_status)->name;
        if (get_settings_value('send_sms')) {
            if ($complain_status == 'Solved') {
                $message = '';
                $message .= "Dear Valued Customer,";
                $message .= chr(10) . "Your complain have been successfully Resolved.";
                $message .= chr(10) . "Complain ID is:";
                $message .= chr(10) . $complainerCode;
                $message .= chr(10) . "Thanks";
                $message .= chr(10) . "SAIF Powertec Ltd";
                $message .= chr(10) . "if any further queries";
                $message .= chr(10) . "call us in our";
                $message .= chr(10) . "hotline: 16650";
                $smsParam = [
                    'contacts' => $complainerPhone,
                    'msg' => $message
                ];
                $sms_response = sending_sms($smsParam);
                $historyUpdateParam = [
                    'is_sms_send' => 1,
                    'sms_response' => $sms_response,
                ];
                DB::table('complain_details_history')->where('id', $lastHistoryId)->update($historyUpdateParam);
            }
        }
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
