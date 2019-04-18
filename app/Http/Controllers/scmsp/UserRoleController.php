<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load User Role list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.user_role.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load User Role create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.user_role.create');
	}
        /*
	Method Name	: edit
	Purpose		: load User Role edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.user_role.edit');
	}
        /*
	Method Name	: store
	Purpose		: load User Role store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "User Role Store";
	}
        
        /*
	Method Name	: update
	Purpose		: load User Role update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "User Role Update";
	}
        /*
	Method Name	: delete
	Purpose		: load User Role delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "User Role Delete";
	}
}
