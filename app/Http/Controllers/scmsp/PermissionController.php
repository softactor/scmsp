<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\permission\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load prmission list
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
            $list   = Permission::orderBy('module', 'desc')->get();
            return View('scmsp.backend.permission.list', compact('list'));
	}
        
        /*
	Method Name	: create
	Purpose		: load permission create
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.permission.create');
	}
        
        /*
	Method Name	: store
	Purpose		: load permission store
	Param		: no param need
	Date		: 06/11/2019
	Author		: Atiqur Rahman
	*/
	public function store(Request $request){
		 $all    =   $request->all();
            /* ----------------------------------------------------------
         * check duplicate entry
         * ---------------------------------------------------------
         */
           
       
                print '<pre>';
                print_r($all);
                print '</pre>';
                exit;
	}
}
