<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\scmsp\backend\permission\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller {
    /*
      Method Name	: index
      Purpose		: load prmission list
      Param		: no param need
      Date		: 06/11/2019
      Author		: Atiqur Rahman
     */

    public function index() {
        $list = Permission::orderBy('module', 'desc')->get();
        return View('scmsp.backend.permission.list', compact('list'));
    }

    /*
      Method Name	: create
      Purpose		: load permission create
      Param		: no param need
      Date		: 06/11/2019
      Author		: Atiqur Rahman
     */

    public function create() {
        return View('scmsp.backend.permission.create');
    }

    /*
      Method Name	: store
      Purpose		: load permission store
      Param		: no param need
      Date		: 06/11/2019
      Author		: Atiqur Rahman
     */

    public function store(Request $request) {
        $all = $request->all();
        $isallpermission = $request->isallpermission;
        if (isset($isallpermission) && !empty($isallpermission)) {
            
        } else {
            $isallpermission = 0;
            $modules = get_table_data_by_table('modules');
            if (isset($modules) && !empty($modules)) {
                foreach ($modules as $module) {
                    // mp =  module permission
                    $mp = false;
                    $addaccess = 0;
                    $editaccess = 0;
                    $listaccess = 0;
                    $deleteaccess = 0;
                    $module_name = $module->name;

                    // check module have all access;
                    if ($all['module'][$module->id]['all']) {
                        $isallmodulepermission = 1; // all module access identifier;
                    } else {
                        $isallmodulepermission = 0;
                        if (isset($all['module'][$module->id]['add']) && !empty($all['module'][$module->id]['add'])) {
                            $mp = true;
                            $addaccess = 1;
                        }
                        if (isset($all['module'][$module->id]['edit']) && !empty($all['module'][$module->id]['edit'])) {
                            $mp = true;
                            $editaccess = 1;
                        }
                        if (isset($all['module'][$module->id]['listaccess']) && !empty($all['module'][$module->id]['listaccess'])) {
                            $mp = true;
                            $listaccess = 1;
                        }
                        if (isset($all['module'][$module->id]['deleteaccess']) && !empty($all['module'][$module->id]['deleteaccess'])) {
                            $mp = true;
                            $deleteaccess = 1;
                        }
                    }
                    if ($mp) {
                        $permissionData = [
                            'user_type' => $request->user_type,
                            'isallpermission' => $isallpermission,
                            'module' => $module_name,
                            'isallmodulepermission' => $isallmodulepermission,
                            'addaccess' => $addaccess,
                            'editaccess' => $editaccess,
                            'listaccess' => $listaccess,
                            'deleteaccess' => $deleteaccess,
                            'created_at' => '',
                            'updated_at' => '',
                            'user_id' => ''
                        ];

                        // from down there, we need to insert command;
                    }// module permission check;
                }// end of foreach
            }
        }
    }

}
