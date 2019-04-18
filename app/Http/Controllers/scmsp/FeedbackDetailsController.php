<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackDetailsController extends Controller
{
    /*
	Method Name	: index
	Purpose		: load feedback details list
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		return View('scmsp.backend.feedback_details.list');
	}
        
        /*
	Method Name	: create
	Purpose		: load feedback details create
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.feedback_details.create');
	}
        /*
	Method Name	: edit
	Purpose		: load feedback details edit
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function edit(){
		return View('scmsp.backend.feedback_details.edit');
	}
        /*
	Method Name	: store
	Purpose		: load feedback details store
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function store(){
		echo "feedback details Store";
	}
        
        /*
	Method Name	: update
	Purpose		: load feedback details update
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function update(){
		echo "feedback details Update";
	}
        /*
	Method Name	: delete
	Purpose		: load feedback details delete
	Param		: no param need
	Date		: 04/16/2019
	Author		: Atiqur Rahman
	*/
	public function delete(){
		echo "feedback details Delete";
	}
}
