<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function test_mail() {
        $emails['to'] = 'tanveerqureshee1@gmail.com';
        $emails['from_address'] = 'mail.saifpowergroup.com';
        $emails['from_name'] = 'Saif Customer Care';
        $mail = Mail::send('Test', function ($message) use ($emails) {
                    $message->from($emails['from_address'], $emails['from_name']);
                    $message->to($emails['to']);
                    $message->subject("Complain Test Mail");
                });
    }

}
