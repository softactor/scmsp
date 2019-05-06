<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplainDetailsController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load complain details list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.complain_details.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load complain details create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.complain_details.create');
	}
        /*
	Method Name	: edit
	Purpose		: load complain details edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.complain_details.edit');
	}
        /*
	Method Name	: store
	Purpose		: load complain details store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "complain details Store";
	}
        
        /*
	Method Name	: update
	Purpose		: load complain details update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "complain details Update";
	}
        /*
	Method Name	: delete
	Purpose		: load complain details delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "complain details Delete";
	}
}
