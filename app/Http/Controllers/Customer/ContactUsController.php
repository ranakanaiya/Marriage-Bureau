<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Validator;

class ContactUsController extends Controller
{
    public function contactUsLanding()
    {
        return view('customer.landing-contactus');
    }
    public function contactUsLandingPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'contact'=>'required',
            'message'=>'required']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        $contact = ContactUs::create([
            'first_name'=>$request->firstName,
            'last_name'=>$request->lastName,
            'email'=>$request->email,
            'contact_no'=>$request->contact,
            'message'=>$request->message]);

        return redirect()->route('home')->with(['status'=>'success','message'=>'We just got message from you, We will contact you soon!']);
    }

    public function contactUs()
    {
        return view('customer.contactus');
    }

    public function contactUsPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'contact'=>'required',
            'message'=>'required']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        $contact = ContactUs::create([
            'first_name'=>$request->firstName,
            'last_name'=>$request->lastName,
            'email'=>$request->email,
            'contact_no'=>$request->contact,
            'message'=>$request->message]);

        return redirect()->route('dashboard')->with(['status'=>'success','message'=>'We just got message from you, We will contact you soon!']);
    }



}
