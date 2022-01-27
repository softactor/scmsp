<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

/**
 * Class SettingsController.
 */
class SettingsController extends Controller {

    public function sms_status_set($complain_status = null) {
        
        $send_sms_value   =   get_settings_value('send_sms');
        /* selected menue data */
        $activeMenuClass    =   'settings';   
        $subMenuClass       =   'sms-status-set';
        return View('scmsp.backend.settings.sms_settings', compact('send_sms_value','list','activeMenuClass','subMenuClass'));
    }
    public function sms_status_set_update(Request $request) {
        $smsStatusUpdateParam =   [
            'setting_value' =>  (isset($request->send_sms) && !empty($request->send_sms) ? 1 : 0)
        ];
        DB::table('settings')->where('setting_key', 'send_sms')->update($smsStatusUpdateParam);
        return redirect('admin/sms-status-set')->with('success', 'SMS Status have been successfully Updated.');
    }

    /*
      Method Name	: create
      Purpose		: load complain details create
      Param		: no param need
      Date		: 04/16/2019
      Author		: Atiqur Rahman
     */

    public function create() {
        $activeMenuClass = 'complain-details';
        return View('scmsp.backend.complain_details.create', compact('activeMenuClass'));
    }

    /*
      Method Name	: edit
      Purpose		: load complain details edit
      Param		: no param need
      Date		: 04/16/2019
      Author		: Atiqur Rahman
     */

    public function edit(Request $request) {
        $editData = ComplainDetails::find($request->id);
        $activeMenuClass = 'complain-details';
        $role = getRoleNameByUserId(Auth::user()->id);
        if ($role == 'Admin' || $role == 'Agent') {
            return View('scmsp.backend.complain_details.edit', compact('editData', 'activeMenuClass'));
        } else {
            return View('scmsp.backend.complain_details.edit_technician', compact('editData', 'activeMenuClass'));
        }
    }

    /*
      Method Name	: store
      Purpose		: load complain details store
      Param		: no param need
      Date		: 04/16/2019
      Author		: Atiqur Rahman
     */

    public function store(Request $request) {
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
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/complain-details-create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $complainerCode = getComplainCode($request->complain_date);
        $complain_details = new ComplainDetails;
        $complain_details->complainer_code = $complainerCode;
        $complain_details->category_id = $request->category_id;
        $complain_details->complain_type_id = $request->complain_type_id;
        $complain_details->complainer = $request->complainer;
        $complain_details->complain_details = $request->complain_details;
        $complain_details->issued_date = $request->complain_date;
        $complain_details->division_id = $request->div_id;
        $complain_details->department_id = $request->dept_id;
        $complain_details->complain_status = $request->complain_status;
        $complain_details->user_id = Auth::user()->id;
        $complain_details->assign_to = $request->assign_to;
        $complain_details->priority_id = $request->priority_id;
        $complain_details->save();
        $complain_id = $complain_details->id;

        $detailsHistoryData = [
            'complain_id' => $complain_id,
            'descriptions' => $request->complain_details,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'assign_to' => $request->assign_to,
            'current_status' => $request->complain_status,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $lastHistoryId = DB::table('complain_details_history')->insertGetId($detailsHistoryData);
        if (get_settings_value('send_sms')) {
            $message = '';
            $message .= "Dear Valued Customer,";
            $message .= chr(10) . "Your complain have been successfully received.";
            $message .= chr(10) . "Complain ID is:";
            $message .= chr(10) . $complainerCode;
            $message .= chr(10) . "Thanks";
            $message .= chr(10) . "SAIF Powertec Ltd";
            $smsParam = [
                'contacts' => $request->complainer,
                'msg' => $message
            ];
            $sms_response = sending_sms($smsParam);
            $historyUpdateParam = [
                'is_sms_send' => 1,
                'sms_response' => $sms_response,
            ];
            DB::table('complain_details_history')->where('id', $lastHistoryId)->update($historyUpdateParam);
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

    public function delete(Request $request) {
        $res = ComplainDetails::where('id', $request->del_id)->delete();
        $feedback = [
            'status' => 'success',
            'message' => 'Data have successfully deleted.',
            'data' => ''
        ];
        echo json_encode($feedback);
    }

    public function autocomplete(Request $request) {
        $data = Search::select("complainer")
                ->where("complainer", "LIKE", "%{$request->input('query')}%")
                ->get();

        if (count($data))
            return $data;
        else
            return ['No Result Found'];

        return response()->json($data);
    }
    
    public function address_upazila(){
        $activeMenuClass = 'address-upazila';
        $list            = getUpazilaList();
        $activeMenuClass    =   'settings';
        
        return View('scmsp.backend.settings.address_upazila_list', compact('activeMenuClass', 'list'));
    }
    
    public function address_upazila_create(){
        $activeMenuClass    =   'settings';
        $divisions      =   DB::table('addr_divisions')->orderBy('name', 'asc')->get();
        return View('scmsp.backend.settings.address_upazila_create', compact('activeMenuClass', 'divisions'));
    }
    
    public function address_upazila_edit(Request $request){
        $activeMenuClass    =   'settings';
        $divisions      =   DB::table('addr_divisions')->orderBy('name', 'asc')->get();
        $upazila                =   DB::table('addr_upazilas')->where('id', $request->id)->first();
        $selectedDivisionId     =   get_address_division_by_district_id($upazila->district_id);
        $districtData           =   DB::table('addr_districts')->where('division_id', $selectedDivisionId)->get();
        return View('scmsp.backend.settings.address_upazila_edit', compact('activeMenuClass','divisions','upazila','selectedDivisionId', 'districtData'));
    }
    
    public function get_address_district_by_division(Request $request){
        $division_id     =   $request->division_id;
        $district        =   DB::table('addr_districts')
                            ->where('division_id', $division_id)
                            ->orderBy('name', 'asc')
                            ->get();
        $department_view =   View::make('scmsp.backend.partial.get_address_district_by_division', compact('district'));
        $feedback = [
            'status'    => 'success',
            'message'   => 'Data found',
            'data'      => $department_view->render(),
        ];
        echo json_encode($feedback);
    }
    
    public function address_upazila_store(Request $request){
        $all            =   $request->all();
        $division_id    =   $request->division_id;
        $district_id    =   $request->district_id;
        $name           =   $request->name;       
        
        $insertData     =   [
            'district_id'   =>  $district_id,
            'name'          =>  $name,
        ];
        
        $duplicateCheck['where']     =  $insertData; 
        $duplicateCheck['table']     =  'addr_upazilas'; 
        
        $idDuplicate        =  check_duplicate_data($duplicateCheck);
        if($idDuplicate){
            return redirect('admin/address_upazila')
                    ->with('error', 'Failed to saved.Duplicate data found.');
        }else{
            if(isset($request->bn_name) && !empty($request->bn_name)){
                $insertData['bn_name']     =   $request->bn_name;
            }
            DB::table('addr_upazilas')->insert($insertData);
            return redirect('admin/address_upazila')
                    ->with('success', 'Data have been successfully saved.');            
        }
        
    }
    
    public function address_upazila_update(Request $request){
        $all            =   $request->all();
        $division_id    =   $request->division_id;
        $district_id    =   $request->district_id;
        $name           =   $request->name;       
        $edit_id        =   $request->edit_id;       
        
        $insertData     =   [
            'district_id'   =>  $district_id,
            'name'          =>  $name,
        ];
        
        $checkParam['table'] = "addr_upazilas";
        $checkWhereParam = [
            ['district_id',     '=', $district_id],
            ['name',            '=', $name],
            ['id',              '!=',$edit_id]
        ];
        $checkParam['where']    = $checkWhereParam;
        $duplicateCheck         = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/address_upazila_edit/'.$edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }else{
            if(isset($request->bn_name) && !empty($request->bn_name)){
                $insertData['bn_name']     =   $request->bn_name;
            }
            
            DB::table('addr_upazilas')
            ->where('id', $edit_id)
            ->update($insertData);
            return redirect('admin/address_upazila')
                    ->with('success', 'Data have been successfully updated.');            
        }
        
    }
    
    public function address_upazila_delete(Request $request){
        $res        =   DB::table('addr_upazilas')->where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
    }

    public function address_union(){
        $activeMenuClass = 'address-upazila';
        $list            = getUnionList();
        
        return View('scmsp.backend.settings.address_union_list', compact('activeMenuClass', 'list'));
    }
    
    public function address_union_create(){
        $activeMenuClass    =   'address-upazila';
        $divisions      =   DB::table('addr_divisions')->orderBy('name', 'asc')->get();
        return View('scmsp.backend.settings.address_union_create', compact('activeMenuClass', 'divisions'));
    }
    
    public function get_address_upazila_by_district(Request $request){
        $district_id     =   $request->district_id;
        $district        =   DB::table('addr_upazilas')
                            ->where('district_id', $district_id)
                            ->orderBy('name', 'asc')
                            ->get();
        $department_view =   View::make('scmsp.backend.partial.get_address_upazila_by_district', compact('district'));
        $feedback = [
            'status'    => 'success',
            'message'   => 'Data found',
            'data'      => $department_view->render(),
        ];
        echo json_encode($feedback);
    }
    public function get_upazilla_list_by_district(Request $request){
        $district_id     =   $request->district_id;
        $addr_upazilas        =   getUpazilaList($district_id);
        $view =   View::make('scmsp.backend.partial.get_upazilla_list_by_district', compact('addr_upazilas'));
        $feedback = [
            'status'    => 'success',
            'message'   => 'Data found',
            'data'      => $view->render(),
        ];
        echo json_encode($feedback);
    }
    public function address_union_list_by_upazila(Request $request){
        $upazila_id     =   $request->upazila_id;
        $addr_unions        =   getUnionList($upazila_id);
        $view =   View::make('scmsp.backend.partial.address_union_list_by_upazila', compact('addr_unions'));
        $feedback = [
            'status'    => 'success',
            'message'   => 'Data found',
            'data'      => $view->render(),
        ];
        echo json_encode($feedback);
    }
    
    public function address_union_store(Request $request){
        $all            =   $request->all();
        $division_id    =   $request->division_id;
        $district_id    =   $request->district_id;
        $upazila_id     =   $request->upazila_id;
        $name           =   $request->name;       
        
        $insertData     =   [
            'upazila_id'    =>  $upazila_id,
            'name'          =>  $name,
        ];
        
        $duplicateCheck['where']     =  $insertData; 
        $duplicateCheck['table']     =  'addr_unions'; 
        
        $idDuplicate        =  check_duplicate_data($duplicateCheck);
        if($idDuplicate){
            return redirect('admin/address_union')
                    ->with('error', 'Failed to saved.Duplicate data found.');
        }else{
            if(isset($request->bn_name) && !empty($request->bn_name)){
                $insertData['bn_name']     =   $request->bn_name;
            }
            DB::table('addr_unions')->insert($insertData);
            return redirect('admin/address_union')
                    ->with('success', 'Data have been successfully saved.');            
        }
        
    }
    
    public function address_union_edit(Request $request){
        $activeMenuClass    =   'address-upazila';
        $unionDetails           =   DB::table('addr_unions')->where('id', $request->id)->first();
        $upazila                =   DB::table('addr_upazilas')->where('id', $unionDetails->upazila_id)->first();
        $districts              =   DB::table('addr_districts')->where('id', $upazila->district_id)->first();//district_id
        $divisions              =   DB::table('addr_divisions')->orderBy('name', 'asc')->get();
        $selectedDivisionId     =   get_address_division_by_district_id($upazila->district_id);
        return View('scmsp.backend.settings.address_union_edit', compact('activeMenuClass',
                'unionDetails',
                'upazila',
                'districts',
                'divisions',
                'selectedDivisionId')
                );
    }
    
    public function address_union_update(Request $request){
        $all            =   $request->all();
        $division_id    =   $request->division_id;
        $district_id    =   $request->district_id;
        $upazila_id     =   $request->upazila_id;
        $name           =   $request->name;       
        $edit_id        =   $request->edit_id;       
        
        $insertData     =   [
            'upazila_id'   =>  $upazila_id,
            'name'          =>  $name,
        ];
        
        $checkParam['table'] = "addr_unions";
        $checkWhereParam = [
            ['upazila_id',     '=', $upazila_id],
            ['name',            '=', $name],
            ['id',              '!=',$edit_id]
        ];
        $checkParam['where']    = $checkWhereParam;
        $duplicateCheck         = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
        // check is it duplicate or not
        if ($duplicateCheck) {
            return redirect('admin/address_union_edit/'.$edit_id)
                            ->withInput()
                            ->with('error', 'Failed to save data. Duplicate Entry found.');
        }else{
            if(isset($request->bn_name) && !empty($request->bn_name)){
                $insertData['bn_name']     =   $request->bn_name;
            }
            
            DB::table('addr_unions')
            ->where('id', $edit_id)
            ->update($insertData);
            return redirect('admin/address_union')
                    ->with('success', 'Data have been successfully updated.');            
        }
        
    }
    
    public function address_union_delete(Request $request){
        $res        =   DB::table('addr_unions')->where('id',$request->del_id)->delete();
        $feedback   =   [
            'status'    => 'success',
            'message'   => 'Data have successfully deleted.',
            'data'      =>  ''
        ];
        echo json_encode($feedback);
    }
}
