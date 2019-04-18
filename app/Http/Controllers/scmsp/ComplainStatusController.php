<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplainStatusController extends Controller
{
     /*
	Method Name	: index
	Purpose		: load complain status list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.complain_status.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load complain status create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.complain_status.create');
	}
        /*
	Method Name	: edit
	Purpose		: load complain status edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.complain_status.edit');
	}
        /*
	Method Name	: store
	Purpose		: load complain status store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "complain status Store";
	}
        
        /*
	Method Name	: update
	Purpose		: load complain status update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "complain status Update";
	}
        /*
	Method Name	: delete
	Purpose		: load complain status delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "complain status Delete";
	}
}
