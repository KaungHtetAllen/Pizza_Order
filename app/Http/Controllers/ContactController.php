<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //direct contact form page
    public function contactForm(){
        return view('user.contact.contact');
    }

    //contact send
    public function send(Request $request){
        $this->contactValidationCheck($request);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
        Contact::create($data);
        return redirect()->route('user#home')->with(['createSuccess'=>'Message sent!']);
    }

    //contact validation check (Private)
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'
        ])->validate();
    }
}
