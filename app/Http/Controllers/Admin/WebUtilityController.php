<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebUtility;
use Validator;

class WebUtilityController extends Controller
{
    public function terms()
    {
        $terms = WebUtility::firstOrCreate(['slug'=>'terms']);
        return view('admin.termsandconditions',compact('terms'));
    }

    public function termsPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'terms'=>'required']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        $terms = WebUtility::firstOrCreate(['slug'=>'terms']);
        $terms->update(['data'=>$request->terms]);

        return redirect()->back()->with(['status'=>'success','message'=>'Terms and Conditions Updated Successfully']);

    }

    public function privacy()
    {
        $privacy = WebUtility::firstOrCreate(['slug'=>'privacy']);
        return view('admin.privacypolicy',compact('privacy'));
    }

    public function privacyPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'privacy'=>'required']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        $privacy = WebUtility::firstOrCreate(['slug'=>'privacy']);
        $privacy->update(['data'=>$request->privacy]);

        return redirect()->back()->with(['status'=>'success','message'=>'Privacy Policy Updated Successfully']);

    }
}
