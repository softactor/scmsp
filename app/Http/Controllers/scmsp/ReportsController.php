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

/**
 * Class SettingsController.
 */
class ReportsController extends Controller {
    public function index(Request $request){
        $role   =   getRoleNameByUserId(Auth::user()->id);
        $activeMenuClass    =   'report-list';   
        return View('scmsp.backend.reports.index', compact('activeMenuClass'));
    }
    public function get_general_report_data(Request $request){
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
    
    public function generate_general_report_pdf(Request $request){
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
    public function testPDF(Request $request){
        $data['report_data']     =   get_report_table_data($request);
        $pdf = PDF::loadView('scmsp.backend.reports.prints.general_pdf', $data);
        return $pdf->download('report.pdf');
    }
    public function download_complain_excel_file(Request $request)
    {
        $report_data     =   get_excel_report_data();
        Excel::create('registration_export', function($excel) use ($report_data){
            $excel->sheet('event_export', function($sheet) use ($report_data){
                $sheet->loadView('scmsp.backend.reports.excel_complain_list')->with('report_data',$report_data);
                $sheet->setOrientation('landscape');
            });
        })->export('xlsx');
    }
}
