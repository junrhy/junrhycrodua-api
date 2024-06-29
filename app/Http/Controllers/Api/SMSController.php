<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index()
    {
        
    }
 
    public function show($id)
    {
        
    }

    public function store(Request $request)
    {
        if ($request->gateway == "twilio") {
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_AUTH_TOKEN");
            $twilio_number = env("TWILIO_NUMBER");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($request->ecipients, 
                    ['from' => $twilio_number, 'body' => $request->message] );
        }
    }
}
