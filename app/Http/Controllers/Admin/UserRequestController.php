<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRequest;

class UserRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::latest()->get();
        return view('admin.userrequest',compact('requests'));
    }
}
