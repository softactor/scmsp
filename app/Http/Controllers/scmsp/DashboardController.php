<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class DashboardController extends Controller
{
    public function index(){
        return View('scmsp.backend.dashboard');
    }
}
