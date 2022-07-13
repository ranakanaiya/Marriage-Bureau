<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UtilityController extends Controller
{
    public function getStates($country,$flg=0)
    {
        $states = [];
        if($flg==0)
            $states = State::where('country_id',$country)->orderBy('name')->get(['id','name']);
        else
            $states = State::whereIn('country_id',explode(',',$country))->orderBy('name')->get(['id','name']);
        return response()->json(['status'=>1,'message'=>'Data retrived successfully', 'data'=>$states]);
    }

    public function getCities($state,$flg=0)
    {
        $cities = [];

        if($flg==0)
            $cities = City::where('state_id',$state)->orderBy('name')->get(['id','name']);
        else
            $cities = City::whereIn('state_id',explode(',',$state))->orderBy('name')->get(['id','name']);
        return response()->json(['status'=>1,'message'=>'Data retrived successfully','data'=>$cities]);
    }
}
