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
        print '<pre>';
        print_r($all);
        print '</pre>';
        exit;
        
        // assigning default param:
        $user_type              =   $request->user_type;
        $isallpermission        =   0;
        $module                 =   'all';
        $isallmodulepermission  =   1;
        $addaccess              =   1;
        $editaccess             =   1;
        $listaccess             =   1;
        $deleteaccess           =   1;
        $user_id                =   Auth::user()->id;
        
        $isallpermission = $request->isallpermission;
        if (isset($isallpermission) && !empty($isallpermission)) {
            $permission                         = new Permission;
            $permission->user_type              = $user_type;
            $permission->isallpermission        = $isallpermission;
            $permission->module                 = $module;
            $permission->isallmodulepermission  = $isallmodulepermission;
            $permission->addaccess              = $addaccess;
            $permission->editaccess             = $editaccess;
            $permission->listaccess             = $listaccess;
            $permission->deleteaccess           = $deleteaccess;
            $permission->user_id                = $user_id;
            $permission->save();
            return redirect('admin/permission-list')->with('success', 'Data have been successfully saved.');  
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
                    if (isset($all['module'][$module->id]['all']) && !empty($all['module'][$module->id]['all'])) {
                        $mp = true;
                        $isallmodulepermission = 1; // all module access identifier;
                    } else {
                        $isallmodulepermission = 0; 
                        if (isset($all['module'][$module->id]['add']) && $all['module'][$module->id]['add'] == 1) {
                            $mp = true;
                            $addaccess = 1;
                        }
                        if (isset($all['module'][$module->id]['edit']) && !empty($all['module'][$module->id]['edit'])) {
                            $mp = true;
                            $editaccess = 1;
                        }
                        if (isset($all['module'][$module->id]['list']) && !empty($all['module'][$module->id]['list'])) {
                            $mp = true;
                            $listaccess = 1;
                        }
                        if (isset($all['module'][$module->id]['del']) && !empty($all['module'][$module->id]['del'])) {
                            $mp = true;
                            $deleteaccess = 1;
                        }
                    }
                    if ($mp) {
                            // take dicision for update or insert
                            //                        $checkParam['table'] = "permissions";
                        $checkWhereParam = [
                            ['user_type',            '=', $user_type],
                            ['module',               '=', $module_name],
                        ];
                        
                        $checkParam['where'] = $checkWhereParam;
                        $checkParam['table'] = 'permissions';
                        $duplicateCheck = check_duplicate_data($checkParam); //check_duplicate_data is a helper method:
                        if ($duplicateCheck) {
                            // update the records
                            $permission                         = Permission :: find($duplicateCheck);
                            $permission->user_type              = $user_type;
                            $permission->isallpermission        = $isallpermission;
                            $permission->module                 = $module_name;
                            $permission->isallmodulepermission  = $isallmodulepermission;
                            $permission->addaccess              = $addaccess;
                            $permission->editaccess             = $editaccess;
                            $permission->listaccess             = $listaccess;
                            $permission->deleteaccess           = $deleteaccess;
                            $permission->user_id                = $user_id;
                            $permission->save();
                        }else
                            $permission                         = new Permission;
                            $permission->user_type              = $user_type;
                            $permission->isallpermission        = $isallpermission;
                            $permission->module                 = $module_name;
                            $permission->isallmodulepermission  = $isallmodulepermission;
                            $permission->addaccess              = $addaccess;
                            $permission->editaccess             = $editaccess;
                            $permission->listaccess             = $listaccess;
                            $permission->deleteaccess           = $deleteaccess;
                            $permission->user_id                = $user_id;
                            $permission->save();
                            
                    }// module permission check;
                }// end of foreach
                return redirect('admin/permission-list')->with('success', 'Data have been successfully saved.');
            }
        } // end of else:
    }

}
