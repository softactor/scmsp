<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\feedbackDetails\FeedbackDetails;
use Illuminate\Support\Facades\Auth;
use App\Model\scmsp\backend\complainDetails\ComplainDetails;

class FeedbackDetailsController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load feedback details list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list   = FeedbackDetails::orderBy('id', 'desc')->get();
            /* selected menue data */
            $activeMenuClass    =   'feedback-details'; 
            return View('scmsp.backend.feedback_details.list', compact('list','activeMenuClass'));
	}
        
        /*
	Method Name	: create
	Purpose		: load feedback details create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.feedback_details.create');
	}
        /*
	Method Name	: edit
	Purpose		: load feedback details edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
                $editData   = FeedbackDetails::find($request->id);
		return View('scmsp.backend.feedback_details.edit',  compact('editData'));
	}
        /*
	Method Name	: store
	Purpose		: load feedback details store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(Request $request){
	$rules  =   [
                'complain_id'       => 'required',
                'eng_feedback'      => 'required',
                'customer_feedback' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/feedback-details-create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $complain_feedbacks                    =   new FeedbackDetails;
            $complain_feedbacks->complain_id       =   $request->complain_id;
            $complain_feedbacks->eng_feedback      =   $request->eng_feedback;
            $complain_feedbacks->customer_feedback =   $request->customer_feedback;
            
            $complain_feedbacks->user_id           =   Auth::user()->id;
            $complain_feedbacks->save();
            return redirect('admin/feedback-details-list')->with('success', 'Data have been successfully saved.');
	}
        
        /*
	Method Name	: update
	Purpose		: load feedback details update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
		$rules  =   [
                'complain_id'       => 'required',
                'eng_feedback'      => 'required',
                'customer_feedback' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect('admin/feedback-details-edit')
                            ->withInput()
                            ->with('error', 'Failed to update data. Pleae fix the validation.')
                            ->withErrors($validator);
            }
            
            $complain_feedbacks                    =   FeedbackDetails::find($request->edit_id);
            $complain_feedbacks->complain_id       =   $request->complain_id;
            $complain_feedbacks->eng_feedback      =   $request->eng_feedback;
            $complain_feedbacks->customer_feedback =   $request->customer_feedback;
            
            $complain_feedbacks->user_id           =   Auth::user()->id;
            $complain_feedbacks->save();
            return redirect('admin/feedback-details-list')->with('success', 'Data have been successfully Updated.');
	}
        /*
	Method Name	: delete
	Purpose		: load feedback details delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(Request $request){
            $res        =   FeedbackDetails::where('id',$request->del_id)->delete();
            $feedback   =   [
                'status'    => 'success',
                'message'   => 'Data have successfully deleted.',
                'data'      =>  ''
            ];
            echo json_encode($feedback);
	}
}
