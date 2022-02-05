<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use \PDF as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

/**
 * Class SettingsController.
 */
class ReportsController extends Controller {
    public function staff_location_veiw(Request $request)
    {
        $role   =   getRoleNameByUserId(Auth::user()->id);
        $activeMenuClass    =   'report-list';   
        return View('scmsp.backend.reports.staff_location', compact('activeMenuClass'));
    }
    public function index(Request $request)
    {
        $role   =   getRoleNameByUserId(Auth::user()->id);
        $activeMenuClass    =   'report-list';   
        return View('scmsp.backend.reports.index', compact('activeMenuClass'));
    }
    public function get_general_report_data(Request $request)
    {
        $report_data     =   get_report_table_data($request);        
        if (!$report_data->isEmpty()) {
            $report_data_view   =   View::make('scmsp.backend.partial.report_general_search_data', compact('report_data'));

            $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $report_data_view->render(),
            ];            
        }else{
            $feedback = [
                'status'    => 'error',
                'message'   => 'No Data Found',
                'data'      => '',
            ];
        }
        echo json_encode($feedback);
    }
    
    public function generate_general_report_pdf(Request $request)
    {
        $data['report_data']        =   get_report_table_data($request);
        $pdf                        =   PDF::loadView('scmsp.backend.reports.prints.general_pdf', $data);
        $pdf_file                   =   'download.pdf';
        $pdf_path                   =   'public/scmsp/pdf/'.$pdf_file;
        $pdf->save($pdf_path);
        $feedback   =   [
            'status'    => 'success',
            'data'      => asset($pdf_path)
        ];
        return $feedback;
        //return $pdf->download('report.pdf');
    }
    public function testPDF(Request $request)
    {
        $data['report_data']     =   get_report_table_data($request);
        $pdf = PDF::loadView('scmsp.backend.reports.prints.general_pdf', $data);
        return $pdf->download('report.pdf');
    }
    
    public function get_staff_location_report_by_filter_data(Request $request) {
        
        $sql = DB::table('users as u')
            ->select('u.id','u.name','u.email','u.mobile','u.division_id','u.department_id')
            ->join('staff_locations as sl', 'u.id', '=', 'sl.user_id');
        
        if(isset($request->div_id) && !empty($request->div_id)){
            $sql->where('u.division_id', $request->div_id);
        }
        
        if(isset($request->dept_id) && !empty($request->dept_id)){
            $sql->where('u.department_id', $request->dept_id);
        }
        
        if(isset($request->addr_div_id) && !empty($request->addr_div_id)){
            $sql->where('sl.addr_div_id', $request->addr_div_id);
        }
        
        if(isset($request->addr_dis_id) && !empty($request->addr_dis_id)){
            $sql->where('sl.addr_dis_id', $request->addr_dis_id);
        }
        
        if(isset($request->addr_upazila_id) && !empty($request->addr_upazila_id)){
            $sql->where('sl.addr_up_id', $request->addr_upazila_id);
        }
        
        $report_data   =   $sql->get();       
        
        
        $data_view   =   View::make('scmsp.backend.reports.report_staff_locations_data', compact('report_data'));
        
        $feedback = [
            'data'      => $data_view->render(),
        ];
        
        
        echo json_encode($feedback);
        
    }
    
    public function download_complain_excel_file(Request $request)
    {
        $filtersData        =   Session::get('filters');
        $filters            =   (object)$filtersData['filter'];
        session()->forget('filters');
        Session::forget('filters');
        
        $report_data        =   get_report_table_data($filters);
        Excel::create('exportcomplain_list', function($excel) use ($report_data){
            $excel->sheet('event_export', function($sheet) use ($report_data){
                $sheet->loadView('scmsp.backend.reports.excel_complain_list')->with('report_data',$report_data);
                $sheet->setOrientation('landscape');
            });
        })->export('xlsx');
    }
}
