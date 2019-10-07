<?php

namespace App\Http\Controllers\Scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class SettingsController.
 */
class ReportsController extends Controller {
    public function index(Request $request){
        $role   =   getRoleNameByUserId(Auth::user()->id);
        $activeMenuClass    =   'report-list';   
        return View('scmsp.backend.reports.index', compact('list','activeMenuClass'));
    }
}
