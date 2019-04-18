<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load department list
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.department.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load department create
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.department.create');
	}
        
        /*
	Method Name	: edit
	Purpose		: load department edit
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.department.edit');
	}
        
        /*
	Method Name	: store
	Purpose		: load department store
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "Department Store";
	}
        
        /*
	Method Name	: update
	Purpose		: load department update
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "Department Update";
	}
        
         /*
	Method Name	: delete
	Purpose		: load department delete
	Param		: no param need
	Date		: 04/15/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "Department Delete";
	}
}
