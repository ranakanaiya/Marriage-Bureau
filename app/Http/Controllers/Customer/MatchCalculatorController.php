<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZodiacMatchLogic;
use App\Models\VasaaLogic;
use Validator;
use DB;

class MatchCalculatorController extends Controller
{
    public function index()
    {
        return view('customer.matchcalculator');
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'janmaksar_type'=>'required|numeric|gt:0',
            'naksatra'=>'required|numeric|gt:0',
            'zodiac_sign'=>'required|numeric|gt:0',
            'gan'=>'required|numeric|gt:0',
            'naadi'=>'required|numeric|gt:0'],[
            'janmaksar_type.gt'=>'Janmaksar Type is required.',
            'naksatra.gt'=>'Naksatra is required.',
            'zodiac_sign.gt'=>'Zodiac Sign is required.',
            'gan.gt'=>'Gan is required.',
            'naadi.gt'=>'Naadi is required.']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        $data = [
            'status'=>'0',
            'message'=>''];

        $horoscopeDetail = auth()->user()->horoscope_detail;
        if(empty($horoscopeDetail))
            return redirect()->back()->with(['status'=>'error','message'=>'Your horoscope details not found, Please fill out your horoscope details.']);

        $zodiacMatch = ZodiacMatchLogic::where('male_zodiac',$horoscopeDetail->zodiac_sign)->where('female_zodiac',$request->zodiac_sign)->first();
        if(!empty($zodiacMatch))
        {
            $data['message'] = 'Raashi '.$zodiacMatch->result.' (Not Matched)';
            return redirect()->back()->with(['status'=>'success','message'=>'Not matched','data'=>$data]);
        }

        if($horoscopeDetail->janmaksar_type==3 || $request->janmaksar_type==3 || $horoscopeDetail->janmaksar_type==$request->janmaksar_type)
        {
            $user = 'kanya';
            $otherUser = 'var';
            if(auth()->user()->personal_detail->gender==0)
            {
                $user = 'var';
                $otherUser = 'kanya';
            }
            $vasaaLogic = VasaaLogic::where($user.'_raashi',$horoscopeDetail->zodiac_sign)
                ->where($user.'_nakshatra',$horoscopeDetail->naksatra)
                ->where($otherUser.'_raashi',$request->zodiac_sign)
                ->where($otherUser.'_nakshatra',$request->naksatra)->first();

            if(empty($vasaaLogic->gun) || $vasaaLogic->gun<18)
            {
                $data['message'] = 'Janmaksar did not matched with too Low Vasaa Gun (Vasaa Gun: '.(is_null($vasaaLogic)?0:$vasaaLogic->gun).')';
                return redirect()->back()->with(['status'=>'success','message'=>'Not matched', 'data'=>$data]);
            }

            if($horoscopeDetail->naadi==$request->naadi)
            {
                $user1Raashi = array_search($horoscopeDetail->zodiac_sign,config('constants.ZODIAC_SIGN'));
                $user1Nakshatra = array_search($horoscopeDetail->naksatra,config('constants.NAKSHATRA'));
                $user1Gender = auth()->user()->personal_detail->gender;
                $user1Charan = config('constants.CHARAN')[$user1Gender][$user1Raashi][$user1Nakshatra];

                $user2Raashi = array_search($request->zodiac_sign,config('constants.ZODIAC_SIGN'));
                $user2Nakshatra = array_search($request->naksatra,config('constants.NAKSHATRA'));
                $user2Charan = config('constants.CHARAN')[!$user1Gender][$user2Raashi][$user2Nakshatra];

                if(abs($user1Charan-$user2Charan)>=2)
                {
                    $data['status'] = 1;
                    $data['message'] = 'Janmaksar Matched Successfully (Mithi Naadi) (Vasaa Gun: '.$vasaaLogic->gun.')';
                    return redirect()->back()->with(['status'=>'success','message'=>'Matched successfully','data'=>$data]);
                }

                $data['message'] = 'No Matched with Naadi Dosh (Karvi Naadi) (Vasaa Gun: '.$vasaaLogic->gun.')';
                return redirect()->back()->with(['status'=>'success','message'=>'Not matched','data'=>$data]);
            }

            $data['status'] = 1;
            $data['message'] = 'Janmaksar Matched Successfully (Vasaa Gun: '.$vasaaLogic->gun.')';
            return redirect()->back()->with(['status'=>'success','message'=>'Matched successfully','data'=>$data]);
        }
        else
        {
            $data['message'] = 'Janmaksar Type did not matched '.array_search($request->janmaksar_type,config('constants.JANMAKSAR_TYPE')).' - '.array_search($horoscopeDetail->janmaksar_type,config('constants.JANMAKSAR_TYPE'));
            return redirect()->back()->with(['status'=>'success','message'=>'Not matched','data'=>$data]);
        }

    }
}
