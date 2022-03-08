<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class CommonSMSController extends Controller
{
    
    public function sms_from_view(){
        
        /* selected menue data */
        $activeMenuClass    =   'common-sms';   
        return View('scmsp.backend.sms.sms_form_view', compact('activeMenuClass'));
        
    }
    
    
    public function sms_process(Request $request){
        
        $contact_number     =   trim($request->contact_number);
        $header_title       =   $request->header_title;
        $description        =   $request->description;
        $footer_title       =   $request->footer_title;
        
        
        
        $message = '';
        $message .= $header_title;
        $message .= chr(10) . $description;
        $message .= chr(10) . $footer_title;
        $smsParam = [
            'contacts'  => $contact_number,
            'msg'       => $message
        ];
        $multiple       =   false;
        $sms_response   = execution_sms($smsParam);
        
        $sms_history = [
            'sms_status'        => (isset($sms_response) && !empty($sms_response) ? 1 : 0),
            'sms_response'      => $sms_response,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => Auth::user()->id,
            'details_sms'       => $message,
            'contact_number'    => $contact_number,
        ];
        DB::table('sms_history')->insert($sms_history);
        
        
        $view        =   View::make('scmsp.backend.sms.sms_sent_view', compact('sms_history'));
        $feedback = [
                'status'    => $sms_history['sms_status'],
                'message'   => (($sms_history['sms_status']) ? 'SMS has been successfully send' : 'Failed to send SMS'),
                'data'      => (($sms_history['sms_status']) ? $view->render() : ''),
            ];
        echo json_encode($feedback);
        
        
    }
    
}
