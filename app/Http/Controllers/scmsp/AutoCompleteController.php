<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\userRole\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AutoCompleteController extends Controller
{
    
    public function index(){
        return view('autocomplete.index');
   }
    public function autoComplete(Request $request) {
        $query = $request->get('term','');
        
        $products=Product::where('name','LIKE','%'.$query.'%')->get();
        
        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->name,'id'=>$product->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
    
    public function get_district_by_division(Request $request){
        $districtdata           =   DB::table('addr_districts')->where('division_id',$request->id)->get();
        $department_view        =   View::make('scmsp.backend.partial.get_addr_related_data', compact('districtdata'));
        $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $department_view->render(),
            ];
        echo json_encode($feedback);
    }
    public function get_upozila_by_district(Request $request){
        $districtdata           =   DB::table('addr_upazilas')->where('district_id',$request->id)->get();
        $department_view        =   View::make('scmsp.backend.partial.get_addr_related_data', compact('districtdata'));
        $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $department_view->render(),
            ];
        echo json_encode($feedback);
    }
    public function get_union_by_upozila(Request $request){
        $districtdata           =   DB::table('addr_unions')->where('upazila_id',$request->id)->get();
        $department_view        =   View::make('scmsp.backend.partial.get_addr_related_union_data', compact('districtdata'));
        $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $department_view->render(),
            ];
        echo json_encode($feedback);
    }
    
    
    public function get_area_manager_by_department(Request $request){
        $areaManagerdata           =   DB::table('users as u')
                ->select('u.id as user_id', 'u.name as user_name')
                ->join('user_roles as ur', 'u.id', '=', 'ur.user_id')
                ->where('u.division_id',$request->division_id)
                ->where('u.department_id',$request->department_id)
                ->where('ur.role_id',5)
                ->get();
        $department_view        =   View::make('scmsp.backend.partial.get_area_manager_data', compact('areaManagerdata'));
        $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $department_view->render(),
            ];
        echo json_encode($feedback);
    }
    
    
    public function more_address_row(Request $request){
        $row_id         =   $request->num_of_row + 1;
        $view           =   View::make('scmsp.backend.partial.more_address_row', compact('row_id'));
        $feedback = [
                'status'    => 'success',
                'message'   => 'Data found',
                'data'      => $view->render(),
            ];
        echo json_encode($feedback);
    }
    
}