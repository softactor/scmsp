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
           $permissionData              = [
                'user_type'             => $request->user_type,
                'isallpermission'       => $isallpermission,
                'module'                => "all",
                'isallmodulepermission' => 0,
                'addaccess'             => 0,
                'editaccess'            => 0,
                'listaccess'            => 0,
                'deleteaccess'          => 0,
                'created_at'            => '',
                'updated_at'            => '',
                'user_id'               => ''
            ];  
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
                        $permissionData             = [
                            'user_type'             => $request->user_type,
                            'isallpermission'       => $isallpermission,
                            'module'                => $module_name,
                            'isallmodulepermission' => $isallmodulepermission,
                            'addaccess'             => $addaccess,
                            'editaccess'            => $editaccess,
                            'listaccess'            => $listaccess,
                            'deleteaccess'          => $deleteaccess,
                            'created_at'            => '',
                            'updated_at'            => '',
                            'user_id'               => ''
                        ];
                  // Insert Code here
                        $checkParam['table'] = "permissions";
                        $checkWhereParam = [
                            ['user_type',            '=', $request->user_type],
                            ['isallpermission',      '=', $request->isallpermission],
                            ['module',               '=', $request->module],
                            ['isallmodulepermission','=', $request->isallmodulepermission],
                            ['addaccess',            '=', $request->addaccess],
                            ['editaccess',           '=', $request->editaccess],
                            ['listaccess',           '=', $request->listaccess],
                            ['deleteaccess',         '=', $request->deleteaccess],
                        ];
                        $checkParam['where'] = $checkWhereParam;
                        //$duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
                        // check is it duplicate or not
//                        if ($duplicateCheck) {
//                            return redirect('admin/permission-create')
//                                            ->withInput()
//                                            ->with('error', 'Failed to save data. Duplicate Entry found.');
//                        }// end of duplicate checking:
//                            $permissions  =   [
//                                'user_type' => 'required|unique:permissions,user_type'
//                            ];
//                            $validator = Validator::make($request->all(), $rules);
//
//                            if ($validator->fails()) {
//                                return redirect('admin/permission-create')
//                                            ->withErrors($validator)
//                                            ->withInput();
//                            }
 echo "I am Here";
 exit;
                            $permission                         =   new Permission;
                            $permission->user_type              =   $request->user_type;
                            $permission->isallpermission        =   $isallpermission;
                            $permission->module                 =   $module;
                            $permission->isallmodulepermission  =   $isallmodulepermission;
                            $permission->addaccess              =   $addaccess;
                            $permission->editaccess             =   $editaccess;
                            $permission->listaccess             =   $listaccess;
                            $permission->deleteaccess           =   $deleteaccess;
                            $permission->user_id                =   Auth::user()->id;
                            $permission->save();
                            
                            //print '<pre>';
                           // print_r($permission);
                           // print '</pre>';
                           // exit;
                            return redirect('admin/permission-list')->with('success', 'Data have been successfully saved.');
                    }// module permission check;
                }// end of foreach
            }
        }
    }

}
