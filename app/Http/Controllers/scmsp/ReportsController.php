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
class ReportsController extends Controller {
    public function index(Request $request){
        $role   =   getRoleNameByUserId(Auth::user()->id);
        $activeMenuClass    =   'report-list';   
        return View('scmsp.backend.reports.index', compact('list','activeMenuClass'));
    }
    public function get_general_report_data(Request $request){
        $query      =     DB::table('complain_details as p');
        if (isset($request->all) && !empty($request->all)) {
            $list_data = $query->select('p.*')->get();
        } else {
            if (isset($request->complainer) && !empty($request->complainer)) {
                $query->where('p.complainer', '=' . $request->complainer . '%');
            }
            if (isset($request->from_date) && !empty($request->from_date)) {
                $from_date      =   date("Y-m-d", strtotime($request->from_date)).' 00:00:00';
                $query->where('p.created_at', '>=', $from_date);
            }            
            if (isset($request->to_date) && !empty($request->to_date)) {
                $to_date      =   date("Y-m-d", strtotime($request->to_date)).' 12:59:59';
                $query->where('p.created_at', '<=', $to_date);
            }
            if (isset($request->div_id) && !empty($request->div_id)) {
                $query->where('p.division_id', '=', $request->division_id);
            }
            if (isset($request->dept_id) && !empty($request->dept_id)) {
                $query->where('p.department_id', '=', $request->department_id);
            }
            if (isset($request->category_id) && !empty($request->category_id)) {
                $query->where('pa.category_id', '=', $request->category_id);
            }
            if (isset($request->complain_type_id) && !empty($request->complain_type_id)) {
                $query->where('p.complain_type_id', '=', $request->complain_type_id);
            }
            if (isset($request->addr_div_id) && !empty($request->addr_div_id)) {
                $query->where('p.subsector_id', '=', $request->subsector_id);
            }
            if (isset($request->addr_dis_id) && !empty($request->addr_dis_id)) {
                $progress_type  =   true;
                $query->where('pp.progresstype', '=', $request->progress_type);
            }   
            if (isset($request->addr_upazila_id) && !empty($request->addr_upazila_id)) {
                $progress_type  =   true;
                $query->where('pp.progresstype', '=', $request->progress_type);
            }   
            if (isset($request->addr_union_id) && !empty($request->addr_union_id)) {
                $progress_type  =   true;
                $query->where('pp.progresstype', '=', $request->progress_type);
            }
        }
        $report_data = $query->select('p.*')->get();
        if (!$report_data->isEmpty()) {
            $report_data_view   =   View::make('scmsp.backend.partial.report_general_search_data', compact('report_data'));

            $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $report_data_view->render(),
            ];
            echo json_encode($feedback);
        }else{
            $feedback = [
                'status'    => 'error',
                'message'   => 'No Data Found',
                'data'      => '',
            ];
            echo json_encode($feedback);
        }
    }
}
