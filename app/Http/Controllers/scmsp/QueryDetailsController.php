<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QueryDetailsController extends Controller
{
    
    public function query_details_list() 
    {
        $role   =   getRoleNameByUserId(Auth::user()->id);
        $list   =   ComplainDetails::where('complain_status',10)->orderBy('created_at', 'DESC')->get();;
        /* selected menue data */
        $activeMenuClass    =   'query-details';   
        return View('scmsp.backend.querys.query_details_list', compact('list','activeMenuClass'));
    }
    public function query_create() 
    {
        $activeMenuClass    =   'query-details';
        return View('scmsp.backend.querys.query_create_form', compact('activeMenuClass'));
    }
}
