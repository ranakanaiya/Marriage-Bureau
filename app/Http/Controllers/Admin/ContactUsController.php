<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        $msgs = ContactUs::latest()->get();
        return view('admin.contactus',compact('msgs'));
    }
}
