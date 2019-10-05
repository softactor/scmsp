<?php

namespace App\Http\Controllers\scmsp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index(){
        /* selected menue data */
        $activeMenuClass    =   'dashboard';   
        return View('scmsp.backend.dashboard', compact('activeMenuClass'));
    }
    
    public function test_mail() {
        $emails['to'] = 'tanveerqureshee1@gmail.com';
        $emails['from_address'] = 'mail.saifpowergroup.com';
        $emails['from_name'] = 'Saif Customer Care';
        print '<pre>';
        print_r($emails);
        print '</pre>';
        
        $mail = Mail::send('Test', ['title' => 'Title', 'content' => 'Content'], function ($message) use ($emails) {
                    $message->from($emails['from_address'], $emails['from_name']);
                    $message->to($emails['to']);
                    $message->subject("Complain Test Mail");
                });
                print '<pre>';
                print_r($mail);
                print '</pre>';
                exit;
                
    }
}
