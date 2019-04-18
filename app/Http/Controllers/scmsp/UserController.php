<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load user list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.user.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load user create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.user.create');
	}
        /*
	Method Name	: edit
	Purpose		: load user edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.user.edit');
	}
        /*
	Method Name	: store
	Purpose		: load user store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "User Store";
	}
        
        /*
	Method Name	: update
	Purpose		: load user update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "User Update";
	}
        /*
	Method Name	: delete
	Purpose		: load user delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "User Delete";
	}
}
