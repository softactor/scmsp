<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
        /*
	Method Name	: index
	Purpose		: load role list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.role.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load role create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.role.create');
	}
        /*
	Method Name	: edit
	Purpose		: load role edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.role.edit');
	}
         /*
	Method Name	: store
	Purpose		: load role store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "Role Store";
	}
          /*
	Method Name	: update
	Purpose		: load role update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "Role Update";
	}
         /*
	Method Name	: delete
	Purpose		: load role delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "Role Delete";
	}
        
        
}
