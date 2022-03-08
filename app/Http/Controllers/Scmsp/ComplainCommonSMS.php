<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplainCommonSMS extends Controller
{
   
    public function common_sms_create_view(){
        
        /* selected menue data */
        $activeMenuClass    =   'common-sms';   
        return View('scmsp.backend.complain_details.list', compact('list','activeMenuClass', 'complain_entry_type'));
        
    }
}
