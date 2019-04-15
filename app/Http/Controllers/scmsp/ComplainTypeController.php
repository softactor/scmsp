<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ComplainTypeController extends Controller {
	
	/*
	Method Name	: index
	Purpose		: load complain type list
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function index(){
		echo "list method";
	}
	
	
	/*
	Method Name	: create
	Purpose		: load complain type create
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function create(){
		return View('scmsp.backend.complain_type.create');
	}
	
	
	/*
	Method Name	: edit
	Purpose		: load complain type edit
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function edit(Request $request){
		echo "Edit Complain Type";
	}
	
	/*
	Method Name	: store
	Purpose		: load complain type store
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
    public function store(Request $request){
		echo "Store Complain Type";
	}
	
	/*
	Method Name	: update
	Purpose		: load complain type update
	Param		: no param need
	Date		: 04/09/2019
	Author		: Atiqur Rahman
	*/
	public function update(Request $request){
		echo "Update Complain Type";
	}
}
