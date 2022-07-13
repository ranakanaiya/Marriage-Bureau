<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Api;
use App\Models\ActiveSession;
use Validator;
use Hash;
use Str;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed']);

        if($validator->fails())
        {
            return response()->json(['status'=>0,'message'=>$validator->errors()->first(),'errors'=>$validator->errors()],200);
        }

        $user = User::create([
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->input('password'))]);
        $apiToken = uniqid(base64_encode(Str::random(60)));

        Api::create([ 
         'user_id' => $user->id,
         'api_key' => $apiToken,
        ]);
        ActiveSession::create([
         'user_id' => $user->id,
         'active' => '1']);

        $data = [
            'id'=>$user->id,
            'email'=>$user->email,
            'api_key'=>$apiToken
        ];

        return response()->json(['status'=>1,'message'=>'Registration successfully!','data'=>$data],200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email']);

        if($validator->fails())
        {
            return response()->json(['status'=>0,'message'=>$validator->errors()->first(),'errors'=>$validator->errors()],200);
        }

        $apiToken = uniqid(base64_encode(Str::random(60)));
        $user = User::where('email',$request->input('email'))->first();
        if(empty($user))
        {
            return response()->json(['status'=>0,'message' => 'Credential Did not Matched'],200);
        }
        else if(Hash::check($request->input('password'),$user->password)) 
        {
            $session = ActiveSession::where('user_id',$user->id)->orderBy('created_at','desc')->first();

            if(!empty($session))
            {
                if($session->active==1)
                {
                    $old_api = Api::where('user_id',$user->id)->orderBy('created_at','desc')->first();
                    ActiveSession::create([
                        'user_id' => $user->id,
                        'active' => '0']);
                    sleep(1);
                    ActiveSession::create([
                        'user_id' => $user->id,
                        'active' => '1']);
                    $old_api->update([ 
                        'api_key' => $apiToken,
                    ]);
                    $data = [
                        'id'=>$user->id,
                        'email'=>$user->email,
                        'api_key'=>$apiToken
                    ];

                    return response()->json(['status'=>1,'message'=>'Login Successfully','data'=>$data],200);
                }
            }
            ActiveSession::create([
              'user_id' => $user->id,
              'active' => '1']);
            Api::create([ 
                 'user_id' => $user->id,
                 'api_key' => $apiToken,
            ]);
            $data = [
                'id'=>$user->id,
                'email'=>$user->email,
                'api_key'=>$apiToken
            ];

            return response()->json(['status'=>1,'message'=>'Login Successfully','data'=>$data],200);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'Credential Did not Matched'],200);
        }
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|string'
        ]);
        if($validator->fails())
        {
            return response()->json(['status'=>0,'message'=>$validator->errors()->first(),'errors'=>$validator->errors()]);
        }
        $user = User::where('email',$request->input('email'))->first();
        if(empty($user))
        {
            return response()->json(['status'=>0,'message' => 'Credential Did not Matched'],200);
        }
        $session = ActiveSession::where('user_id',$user->id)->orderBy('created_at','desc')->first();
        if(!empty($session))
        {
            if($session->active==0)
            {
                return response()->json(['status'=>1,'message'=>'Already Logged Out'],200);
            }
            else
            {
                ActiveSession::create([
                 'user_id' => $user->id,
                 'active' => '0']);
                Api::where('user_id',$user->id)->delete();
                return response()->json(['status'=>1,'message'=>'Logout successful'],200);
            }
        }
        else
        {
           return response()->json(['status'=>1,'message'=>'Already Logged Out'],200);
        }
    }
}
