<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class SettingsController.
 */
class ReportsController extends Controller {
    public function index(Request $request){
        $role   =   getRoleNameByUserId(Auth::user()->id);
            if($role== 'Admin' || $role=='Agent'){
                if(isset($complain_status) && !empty($complain_status)){
                    $list   = ComplainDetails::where('complain_status',$complain_status)->orderBy('created_at', 'DESC')->get();
                }else{
                    $list   = ComplainDetails::orderBy('created_at', 'DESC')->get();
                }
            }else if($role  ==   'Area Manager'){
                if(isset($complain_status) && !empty($complain_status)){
                    $list   = get_complain_details_by_area_manager(Auth::user()->id, $complain_status);
                }else{
                    $list   = get_complain_details_by_area_manager(Auth::user()->id);
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
}
