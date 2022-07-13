<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Validator;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('customer.landingpage');
    }

    public function aboutus()
    {
        return view('customer.landing-aboutus');
    }

    public function customerRegister(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=> 'required|unique:users,email',
            'password'=>'required|same:password_confirmation|min:6']);

        if($validator->fails())
        {
            return redirect()->back()->with(['status'=>'error','message'=>$validator->errors()->first()]);
        }

        $user = User::create([
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'step'=>0]);

        if(auth()->attempt($request->only(['email','password'])))
        {
            return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Time to build you presence, Just need little more details!']);
        }

        return redirect()->back()->with(['status'=>'success','message'=>'Time to build you presence, Just need little more details, Login and continue!']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required']);

        if($validator->fails())
        {
            return back()->with(['status'=>'error','message'=>$validator->errors()->first(),'errors'=>$validator->errors()]);
        }

        if(auth()->attempt($request->only(['email','password'])))
        {
            session()->put(['dashboardOrder',rand(1,999999)]);
            $this->initSession();
            return redirect()->route('dashboard')->with(['status'=>'success','
                message'=>'Login Successful']);
        }

        return back()->with(['status'=>'error','message'=>'Credentials did not matched']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home')->with(['status'=>'success','Signed Out successfull']);
    }

    public function forgotpassword()
    {
        return view('customer.forgotpassword');
    }

    public function forgotpasswordPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email'],[
            'email.exists'=>'Email not registered, Please register with us']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }

        try {
            $response = Password::sendResetLink($request->only('email'));
            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return redirect()->back()->with(["status" => 'success', "message" => trans($response)]);
                // case Password::INVALID_USER:
                //     return redirect()->back()->with(["status" => 'error', "message" => trans($response)]);
                default:
                    return redirect()->back()->with(['status'=>'error','message'=>trans($response)]);
            }
        } catch (\Swift_TransportException $ex) {
            $arr = ["status" => 'error', "message" => $ex->getMessage()];
        } catch (Exception $ex) {
            $arr = ["status" => 'error', "message" => $ex->getMessage()];
        }
        return redirect()->back()->with($arr);
    }

    public function passwordReset($token)
    {
        return view('customer.passwordreset',compact('token'));
    }

    public function passwordResetPost(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('home')->with(['status'=>'success', 'message'=>__($status)])
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
