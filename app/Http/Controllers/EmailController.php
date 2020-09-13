<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(Request $request)
	{
		$this->validate($request,[
			'name'=>'required|min:2',
			'email'=>'required|email|max:255',
			'message'=>'required|min:4'
		]);		
        $name = $request->get('name');
        $email = $request->get('email');
		$msg = $request->get('message');
		
        \Mail::send('emails.send', ['name' => $name,  'content' => $msg,'email'=>$email], function ($message) use ($request)
        {
			$message->to('marketing@transpartnerlogistics.co.zw');
            $message->from($request->get('email'), $request->get('name'));
			$message->bcc('issachute@gmail.com');
			 $message->subject('From Web Contact Page');

        });
		flash()->success('Send successful','Message was successfully sent');
        	return redirect('/contact-us');			
	}
}
