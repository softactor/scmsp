<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\userRole\UserRole;
use Illuminate\Support\Facades\Auth;

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
    
}